<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueuedResetPassword extends ResetPassword implements ShouldQueue
{
    use Queueable;

    /**
     * Generate a reset URL that includes the locale prefix (when non-default).
     *
     * Why override? Because this notification is queued, and in a queue worker
     * context the localized route definitions may not match the user's locale.
     * By generating the path directly, we keep the link stable and correctly localized.
     */
    protected function resetUrl($notifiable)
    {
        $locale = $this->locale ?? app()->getLocale();
        $defaultLocale = config('app.locale');

        // This app uses locale prefixes only for non-default locales.
        $path = ($locale && $locale !== $defaultLocale)
            ? "{$locale}/reset-password/{$this->token}"
            : "reset-password/{$this->token}";

        $email = $notifiable->getEmailForPasswordReset();

        return url($path.'?email='.urlencode($email));
    }
}
