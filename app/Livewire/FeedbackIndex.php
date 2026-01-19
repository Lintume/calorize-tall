<?php

namespace App\Livewire;

use App\Services\GitHubFeedbackService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FeedbackIndex extends Component
{
    use WithFileUploads;

    public bool $showForm = false;

    public string $title = '';

    public string $description = '';

    public string $type = 'bug';

    public array $attachments = [];

    public ?int $viewingIssue = null;

    public array $issueDetails = [];

    public array $issueComments = [];

    public string $newComment = '';

    public bool $submitting = false;

    public string $successMessage = '';

    public string $errorMessage = '';

    // Cached issues list - loaded once, not on every render
    public array $issues = ['issues' => [], 'total' => 0];

    public bool $loadingIssues = true;

    public bool $loadingIssueDetails = false;

    protected $rules = [
        'title' => 'required|min:5|max:255',
        'description' => 'required|min:10|max:5000',
        'type' => 'required|in:bug,feature,question',
        'attachments.*' => 'image|max:5120', // 5MB max per image
    ];

    public function mount(): void
    {
        $this->loadIssues();
    }

    public function loadIssues(): void
    {
        $this->loadingIssues = true;

        $service = app(GitHubFeedbackService::class);
        $this->issues = $service->getUserIssues(Auth::id());

        $this->loadingIssues = false;
    }

    public function openForm(): void
    {
        $this->showForm = true;
        $this->resetForm();
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->title = '';
        $this->description = '';
        $this->type = 'bug';
        $this->attachments = [];
        $this->errorMessage = '';
    }

    public function removeAttachment(int $index): void
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function submit(): void
    {
        $this->validate();

        $this->submitting = true;

        $service = app(GitHubFeedbackService::class);
        $user = Auth::user();

        // Upload attachments to GitHub repository
        $attachmentUrls = [];

        foreach ($this->attachments as $attachment) {
            // Store temporarily
            $tempPath = $attachment->store('temp-feedback', 'local');
            $fullPath = Storage::disk('local')->path($tempPath);

            // Upload to GitHub repository
            $githubUrl = $service->uploadImageToRepository(
                $fullPath,
                $attachment->getClientOriginalName()
            );

            if ($githubUrl) {
                $attachmentUrls[] = $githubUrl;
            }

            // Clean up temporary file
            Storage::disk('local')->delete($tempPath);
        }

        $result = $service->createIssue(
            $this->title,
            $this->description,
            $this->type,
            $user->id,
            $user->email,
            $attachmentUrls
        );

        $this->submitting = false;

        if ($result) {
            $this->successMessage = __('feedback.submitted_successfully');
            $this->showForm = false;
            $this->resetForm();

            // Add the new issue to the list immediately (GitHub search has indexing delay)
            $newIssue = [
                'number' => $result['number'],
                'title' => $result['title'],
                'body' => $this->description,
                'images' => $attachmentUrls,
                'state' => $result['state'],
                'status' => $result['state'],
                'project_status' => null,
                'type' => $this->type,
                'created_at' => $result['created_at'],
                'updated_at' => $result['updated_at'],
                'comments_count' => 0,
                'html_url' => $result['html_url'],
                'labels' => $result['labels'] ?? [],
            ];

            // Add to the beginning of the issues list
            array_unshift($this->issues['issues'], $newIssue);
            $this->issues['total']++;

            // Clear success message after 5 seconds
            $this->dispatch('clear-success');
        } else {
            $this->errorMessage = __('feedback.submission_error');
        }
    }

    public function viewIssue(int $issueNumber): void
    {
        $this->loadingIssueDetails = true;
        $this->viewingIssue = $issueNumber;
        $this->newComment = '';

        $service = app(GitHubFeedbackService::class);

        $this->issueDetails = $service->getIssue($issueNumber) ?? [];
        $this->issueComments = $service->getIssueComments($issueNumber);

        $this->loadingIssueDetails = false;
    }

    public function closeIssueView(): void
    {
        // Just reset local state - no API calls, instant close
        $this->viewingIssue = null;
        $this->issueDetails = [];
        $this->issueComments = [];
        $this->newComment = '';
    }

    public function addComment(): void
    {
        if (empty(trim($this->newComment))) {
            return;
        }

        $service = app(GitHubFeedbackService::class);
        $user = Auth::user();

        $commentBody = $this->newComment."\n\n---\n*Comment from: {$user->email}*";

        $result = $service->addComment($this->viewingIssue, $commentBody);

        if ($result) {
            $this->issueComments = $service->getIssueComments($this->viewingIssue);
            $this->newComment = '';
        }
    }

    public function clearSuccess(): void
    {
        $this->successMessage = '';
    }

    public function getIsConfiguredProperty(): bool
    {
        return app(GitHubFeedbackService::class)->isConfigured();
    }

    public function render()
    {
        return view('livewire.feedback-index', [
            'isConfigured' => $this->isConfigured,
        ]);
    }
}
