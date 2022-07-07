<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;


class VerificationNoticeNotification extends VerifyEmailNotification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {

        $verificationUrl = str_replace(
            env('APP_URL'),
            env('SPA_URL'),
            $this->verificationUrl($notifiable)
        );

        return (new MailMessage)
            ->subject('Verify Email Address')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email Address', $verificationUrl)
            ->line('If you did not create an account, no further action is required.');
    }
}
