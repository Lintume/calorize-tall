<?php

namespace App\Services;

use App\Mail\FeedbackSubmitted;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GitHubFeedbackService
{
    private ?string $token;

    private ?string $owner;

    private ?string $repo;

    private ?string $projectId;

    private ?string $notifyEmail;

    private string $baseUrl = 'https://api.github.com';

    private string $graphqlUrl = 'https://api.github.com/graphql';

    public function __construct()
    {
        $this->token = config('services.github.token');
        $this->owner = config('services.github.owner');
        $this->repo = config('services.github.repo');
        $this->projectId = config('services.github.project_id');
        $this->notifyEmail = config('services.github.notify_email');
    }

    /**
     * Check if the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->token) && ! empty($this->owner) && ! empty($this->repo);
    }

    /**
     * Send email notification about new feedback.
     */
    private function sendNotificationEmail(array $issue, string $title, string $body, string $type, ?string $userEmail): void
    {
        if (empty($this->notifyEmail)) {
            return;
        }

        try {
            Mail::to($this->notifyEmail)->send(new FeedbackSubmitted(
                feedbackTitle: $title,
                feedbackBody: $body,
                feedbackType: $type,
                userEmail: $userEmail ?? 'Unknown',
                issueNumber: $issue['number'],
                issueUrl: $issue['html_url'],
            ));

            Log::info('Feedback notification email sent', [
                'issue_number' => $issue['number'],
                'to' => $this->notifyEmail,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send feedback notification email', [
                'message' => $e->getMessage(),
                'issue_number' => $issue['number'],
            ]);
        }
    }

    /**
     * Create a new GitHub issue.
     */
    public function createIssue(string $title, string $body, string $type = 'bug', ?int $userId = null, ?string $userEmail = null): ?array
    {
        if (! $this->isConfigured()) {
            Log::warning('GitHub Feedback Service is not configured');

            return null;
        }

        $labels = $this->getLabelsForType($type);

        // Add metadata to body
        $fullBody = $this->buildIssueBody($body, $userId, $userEmail);

        try {
            $response = Http::withToken($this->token)
                ->withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                ->post("{$this->baseUrl}/repos/{$this->owner}/{$this->repo}/issues", [
                    'title' => $title,
                    'body' => $fullBody,
                    'labels' => $labels,
                ]);

            if ($response->successful()) {
                $issue = $response->json();

                // Add to GitHub Project if configured
                $this->addIssueToProject($issue['node_id']);

                // Send email notification
                $this->sendNotificationEmail($issue, $title, $body, $type, $userEmail);

                return $issue;
            }

            Log::error('GitHub API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('GitHub API exception', ['message' => $e->getMessage()]);

            return null;
        }
    }

    /**
     * Add an issue to a GitHub Project V2.
     */
    public function addIssueToProject(string $issueNodeId): bool
    {
        if (empty($this->projectId)) {
            return false;
        }

        // Note: GitHub renamed this mutation from addProjectV2ItemByContentId to addProjectV2ItemById
        $query = <<<'GRAPHQL'
            mutation($projectId: ID!, $contentId: ID!) {
                addProjectV2ItemById(input: {
                    projectId: $projectId
                    contentId: $contentId
                }) {
                    item {
                        id
                    }
                }
            }
        GRAPHQL;

        try {
            $response = Http::withToken($this->token)
                ->withHeaders([
                    'Accept' => 'application/vnd.github+json',
                ])
                ->post($this->graphqlUrl, [
                    'query' => $query,
                    'variables' => [
                        'projectId' => $this->projectId,
                        'contentId' => $issueNodeId,
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['errors'])) {
                    Log::warning('GitHub GraphQL errors', ['errors' => $data['errors']]);

                    return false;
                }

                Log::info('Issue added to GitHub Project', [
                    'issue_node_id' => $issueNodeId,
                    'project_id' => $this->projectId,
                ]);

                return true;
            }

            Log::error('GitHub GraphQL API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('GitHub GraphQL API exception', ['message' => $e->getMessage()]);

            return false;
        }
    }

    /**
     * Get issues created by a specific user (by searching in issue body).
     */
    public function getUserIssues(int $userId, int $page = 1, int $perPage = 10): array
    {
        if (! $this->isConfigured()) {
            return ['issues' => [], 'total' => 0];
        }

        try {
            // Search for issues containing the user marker
            $searchQuery = "repo:{$this->owner}/{$this->repo} is:issue \"<!-- user_id:{$userId} -->\" in:body";

            $response = Http::withToken($this->token)
                ->withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                ->get("{$this->baseUrl}/search/issues", [
                    'q' => $searchQuery,
                    'per_page' => $perPage,
                    'page' => $page,
                    'sort' => 'created',
                    'order' => 'desc',
                ]);

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'issues' => collect($data['items'] ?? [])->map(fn ($issue) => $this->formatIssue($issue))->toArray(),
                    'total' => $data['total_count'] ?? 0,
                ];
            }

            return ['issues' => [], 'total' => 0];
        } catch (\Exception $e) {
            Log::error('GitHub API search exception', ['message' => $e->getMessage()]);

            return ['issues' => [], 'total' => 0];
        }
    }

    /**
     * Get a single issue by number.
     */
    public function getIssue(int $issueNumber): ?array
    {
        if (! $this->isConfigured()) {
            return null;
        }

        try {
            $response = Http::withToken($this->token)
                ->withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                ->get("{$this->baseUrl}/repos/{$this->owner}/{$this->repo}/issues/{$issueNumber}");

            if ($response->successful()) {
                return $this->formatIssue($response->json());
            }

            return null;
        } catch (\Exception $e) {
            Log::error('GitHub API get issue exception', ['message' => $e->getMessage()]);

            return null;
        }
    }

    /**
     * Get comments for an issue.
     */
    public function getIssueComments(int $issueNumber): array
    {
        if (! $this->isConfigured()) {
            return [];
        }

        try {
            $response = Http::withToken($this->token)
                ->withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                ->get("{$this->baseUrl}/repos/{$this->owner}/{$this->repo}/issues/{$issueNumber}/comments");

            if ($response->successful()) {
                return collect($response->json())->map(fn ($comment) => [
                    'id' => $comment['id'],
                    'body' => $comment['body'],
                    'created_at' => $comment['created_at'],
                    'author' => $comment['user']['login'] ?? 'Unknown',
                ])->toArray();
            }

            return [];
        } catch (\Exception $e) {
            Log::error('GitHub API comments exception', ['message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Add a comment to an issue.
     */
    public function addComment(int $issueNumber, string $body): ?array
    {
        if (! $this->isConfigured()) {
            return null;
        }

        try {
            $response = Http::withToken($this->token)
                ->withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                ->post("{$this->baseUrl}/repos/{$this->owner}/{$this->repo}/issues/{$issueNumber}/comments", [
                    'body' => $body,
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        } catch (\Exception $e) {
            Log::error('GitHub API add comment exception', ['message' => $e->getMessage()]);

            return null;
        }
    }

    private function getLabelsForType(string $type): array
    {
        $labels = ['user-feedback'];

        return match ($type) {
            'bug' => [...$labels, 'bug'],
            'feature' => [...$labels, 'enhancement'],
            'question' => [...$labels, 'question'],
            default => $labels,
        };
    }

    private function buildIssueBody(string $body, ?int $userId, ?string $userEmail): string
    {
        $metadata = [];

        if ($userId) {
            $metadata[] = "<!-- user_id:{$userId} -->";
        }

        $parts = [];

        // User description
        $parts[] = $body;

        // Separator
        $parts[] = "\n---\n";

        // Metadata section
        $metaLines = ['**Submitted via Calorize Feedback**'];

        if ($userEmail) {
            $metaLines[] = "- User: {$userEmail}";
        }

        if ($userId) {
            $metaLines[] = "- User ID: {$userId}";
        }

        $metaLines[] = '- Date: '.now()->toDateTimeString();
        $metaLines[] = '- Locale: '.app()->getLocale();

        $parts[] = implode("\n", $metaLines);

        // Hidden markers for search
        if (! empty($metadata)) {
            $parts[] = "\n\n".implode(' ', $metadata);
        }

        return implode("\n", $parts);
    }

    /**
     * Get the project status for an issue from GitHub Project V2.
     */
    public function getProjectStatus(string $issueNodeId): ?string
    {
        if (empty($this->projectId)) {
            return null;
        }

        $query = <<<'GRAPHQL'
            query($nodeId: ID!) {
                node(id: $nodeId) {
                    ... on Issue {
                        projectItems(first: 10) {
                            nodes {
                                project {
                                    id
                                }
                                fieldValueByName(name: "Status") {
                                    ... on ProjectV2ItemFieldSingleSelectValue {
                                        name
                                    }
                                }
                            }
                        }
                    }
                }
            }
        GRAPHQL;

        try {
            $response = Http::withToken($this->token)
                ->withHeaders(['Accept' => 'application/vnd.github+json'])
                ->post($this->graphqlUrl, [
                    'query' => $query,
                    'variables' => ['nodeId' => $issueNodeId],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $projectItems = $data['data']['node']['projectItems']['nodes'] ?? [];

                // Find the item in our project
                foreach ($projectItems as $item) {
                    if (($item['project']['id'] ?? '') === $this->projectId) {
                        return $item['fieldValueByName']['name'] ?? null;
                    }
                }
            }

            return null;
        } catch (\Exception $e) {
            Log::error('GitHub GraphQL get status exception', ['message' => $e->getMessage()]);

            return null;
        }
    }

    private function formatIssue(array $issue): array
    {
        $labels = collect($issue['labels'] ?? []);

        $type = 'feedback';
        if ($labels->contains(fn ($l) => ($l['name'] ?? $l) === 'bug')) {
            $type = 'bug';
        } elseif ($labels->contains(fn ($l) => ($l['name'] ?? $l) === 'enhancement')) {
            $type = 'feature';
        } elseif ($labels->contains(fn ($l) => ($l['name'] ?? $l) === 'question')) {
            $type = 'question';
        }

        // Determine status: first check project status, then labels, then issue state
        $status = $issue['state'];
        $projectStatus = null;

        // Try to get status from project if we have node_id
        if (! empty($issue['node_id'])) {
            $projectStatus = $this->getProjectStatus($issue['node_id']);
        }

        if ($projectStatus) {
            // Map project status names to our status codes
            $status = $this->mapProjectStatus($projectStatus);
        } elseif ($labels->contains(fn ($l) => ($l['name'] ?? $l) === 'in-progress')) {
            $status = 'in_progress';
        }

        return [
            'number' => $issue['number'],
            'title' => $issue['title'],
            'body' => $this->cleanIssueBody($issue['body'] ?? ''),
            'state' => $issue['state'],
            'status' => $status,
            'project_status' => $projectStatus,
            'type' => $type,
            'created_at' => $issue['created_at'],
            'updated_at' => $issue['updated_at'],
            'comments_count' => $issue['comments'] ?? 0,
            'html_url' => $issue['html_url'],
            'labels' => $labels->pluck('name')->toArray(),
        ];
    }

    /**
     * Map GitHub Project status names to our internal status codes.
     */
    private function mapProjectStatus(string $projectStatus): string
    {
        // Common status names in GitHub Projects (including your Calorize project)
        $mapping = [
            // Your project statuses
            'backlog' => 'open',
            'ready' => 'open',
            'in progress' => 'in_progress',
            'in review' => 'in_progress',
            'done' => 'closed',
            // Common alternatives
            'todo' => 'open',
            'to do' => 'open',
            'completed' => 'closed',
            // Ukrainian
            'зробити' => 'open',
            'в роботі' => 'in_progress',
            'на перевірці' => 'in_progress',
            'готово' => 'closed',
            'виконано' => 'closed',
        ];

        $normalized = strtolower(trim($projectStatus));

        return $mapping[$normalized] ?? 'open';
    }

    private function cleanIssueBody(string $body): string
    {
        // Remove the metadata section for display
        $parts = explode("\n---\n", $body);

        return trim($parts[0] ?? $body);
    }
}
