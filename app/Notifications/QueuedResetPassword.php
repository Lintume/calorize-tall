<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QueuedResetPassword extends ResetPassword implements ShouldQueue
{
    use Queueable;

    /**
     * The locale to use when sending the notification.
     */
    public ?string $locale = null;

    /**
     * Create a new notification instance.
     */
    public function __construct(#[\SensitiveParameter] string $token)
    {
        parent::__construct($token);

        // Capture the current locale when the notification is created
        $this->locale = app()->getLocale();
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Set locale for queued job
        if ($this->locale) {
            app()->setLocale($this->locale);
        }

        $url = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject(__('passwords.reset_notification_subject'))
            ->greeting(__('Hello!'))
            ->line(__('passwords.reset_notification_line1'))
            ->action(__('passwords.reset_notification_action'), $url)
            ->line(__('passwords.reset_notification_line2', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(__('passwords.reset_notification_line3'))
            ->salutation(__('Regards,') . "\n" . config('app.name'));
    }
}
