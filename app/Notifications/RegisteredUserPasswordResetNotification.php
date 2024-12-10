<?php

namespace App\Notifications;

use App\Helpers\Log;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredUserPasswordResetNotification extends Notification
{
    use Queueable;

    protected $user;
    public $token;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
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
        Log::info(User::TITLE . 'にパスワード再設定メール送信中', $this->user->name);
        $passwordResetURL = $this->passwordResetURL();

        return (new MailMessage)
            ->subject('パスワード再設定のお知らせ')
            ->greeting($this->user->name . '様')
            ->line('以下のボタンをクリックすると、パスワード再設定画面にリダイレクトされます。')
            ->markdown('emails.auth.reset-password', [
                'url' => $passwordResetURL,
                'user' => $this->user,
                'salutation' => '宜しくお願い致します。',
                'actionText' => 'パスワード再設定',
                'displayableActionUrl' => $passwordResetURL,
                'actionUrl' => $passwordResetURL,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function passwordResetURL()
    {
        return route('password.reset', $this->token);
    }
}
