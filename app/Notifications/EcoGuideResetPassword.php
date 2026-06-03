<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EcoGuideResetPassword extends Notification
{
    use Queueable;

    public function __construct(public string $token)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset your EcoGuide password')
            ->greeting('Hello, ' . $notifiable->name . ' 🌿')
            ->line('We received a request to reset the password for your EcoGuide account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire soon.')
            ->line('If you did not request this, you can safely ignore this email.')
            ->salutation('EcoGuide Team');
    }
}