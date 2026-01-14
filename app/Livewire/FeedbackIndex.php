<?php

namespace App\Livewire;

use App\Services\GitHubFeedbackService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FeedbackIndex extends Component
{
    public bool $showForm = false;

    public string $title = '';

    public string $description = '';

    public string $type = 'bug';

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
        $this->errorMessage = '';
    }

    public function submit(): void
    {
        $this->validate();

        $this->submitting = true;

        $service = app(GitHubFeedbackService::class);
        $user = Auth::user();

        $result = $service->createIssue(
            $this->title,
            $this->description,
            $this->type,
            $user->id,
            $user->email
        );

        $this->submitting = false;

        if ($result) {
            $this->successMessage = __('feedback.submitted_successfully');
            $this->showForm = false;
            $this->resetForm();

            // Refresh the issues list to include the new one
            $this->loadIssues();

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
