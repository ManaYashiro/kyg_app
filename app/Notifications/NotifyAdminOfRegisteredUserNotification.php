<?php

namespace App\Notifications;

use App\Helpers\Log;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyAdminOfRegisteredUserNotification extends Notification
{
    use Queueable;

    protected $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        Log::info('管理者に' . User::TITLE . 'の登録のお知らせ', $this->user->name);
        return (new MailMessage)
            ->subject('ユーザー登録!')
            ->greeting('Hello Admin!')
            ->line('A new user has registered.')
            ->line('Name: ' . $this->user->name)
            ->line('Email: ' . $this->user->email)
            ->line('Thank you!');
    }
}
