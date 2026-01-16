<?php

namespace App\Livewire;

use App\Mail\NewReviewSubmitted;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Reviews extends Component
{
    public bool $showForm = false;

    public string $firstName = '';

    public string $lastName = '';

    public string $instagram = '';

    public int $rating = 5;

    public string $text = '';

    public bool $submitting = false;

    public string $successMessage = '';

    public ?Review $userReview = null;

    protected $rules = [
        'firstName' => 'required|min:2|max:50',
        'lastName' => 'required|min:2|max:50',
        'instagram' => 'nullable|max:30',
        'rating' => 'required|integer|min:1|max:5',
        'text' => 'required|min:20|max:2000',
    ];

    public function mount(): void
    {
        if (Auth::check()) {
            $this->userReview = Auth::user()->review;

            // Pre-fill name from user if available
            if (! $this->userReview && Auth::user()->name) {
                $nameParts = explode(' ', Auth::user()->name, 2);
                $this->firstName = $nameParts[0] ?? '';
                $this->lastName = $nameParts[1] ?? '';
            }
        }
    }

    public function openForm(): void
    {
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->resetValidation();
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function submit(): void
    {
        $user = Auth::user();

        if (! $user) {
            return;
        }

        // Check if email is verified
        if (! $user->hasVerifiedEmail()) {
            $this->addError('text', __('reviews.verify_email_first'));

            return;
        }

        // Check if user already has a review
        if ($user->review) {
            $this->addError('text', __('reviews.already_submitted'));

            return;
        }

        $this->validate();

        $this->submitting = true;

        $review = Review::create([
            'user_id' => $user->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'instagram' => $this->instagram ?: null,
            'rating' => $this->rating,
            'text' => $this->text,
        ]);

        // Send notification to admin
        $notifyEmail = config('services.feedback.notify_email');
        if ($notifyEmail) {
            Mail::to($notifyEmail)->queue(new NewReviewSubmitted($review));
        }

        $this->submitting = false;
        $this->showForm = false;
        $this->userReview = $review;
        $this->successMessage = __('reviews.submitted_success');

        $this->dispatch('clear-success');
    }

    public function clearSuccess(): void
    {
        $this->successMessage = '';
    }

    public function resendVerification(): void
    {
        $user = Auth::user();

        if ($user && ! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            $this->successMessage = __('reviews.verification_sent');
            $this->dispatch('clear-success');
        }
    }

    public function render()
    {
        $approvedReviews = Review::approved()
            ->verified()
            ->with('user:id,email')
            ->latest()
            ->get();

        $stats = [
            'count' => $approvedReviews->count(),
            'average' => $approvedReviews->count() > 0
                ? round($approvedReviews->avg('rating'), 1)
                : 0,
        ];

        return view('livewire.reviews', [
            'reviews' => $approvedReviews,
            'stats' => $stats,
        ]);
    }
}
