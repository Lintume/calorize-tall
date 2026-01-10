<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $feedbackTitle,
        public string $feedbackBody,
        public string $feedbackType,
        public string $userEmail,
        public int $issueNumber,
        public string $issueUrl,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $typeEmoji = match ($this->feedbackType) {
            'bug' => '🐛',
            'feature' => '💡',
            'question' => '❓',
            default => '📝',
        };

        return new Envelope(
            subject: "{$typeEmoji} Новий feedback #{$this->issueNumber}: {$this->feedbackTitle}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.feedback-submitted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
