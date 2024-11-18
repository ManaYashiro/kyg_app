<?php

namespace App\Notifications;

use App\Helpers\Log;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class RegisteredUserNotification extends Notification
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
        Log::info(User::TITLE . 'にメール送信中', $this->user->name);
        $verificationUrl = $this->verificationUrl($notifiable, $this->user);
        return (new MailMessage)
            ->subject('ご登録いただきありがとうございます。')
            ->greeting($this->user->name . '様')
            ->line('下のボタンをクリックしてメールアドレスを確認してください。')
            ->markdown('emails.auth.verifyemail', [
                'url' => $verificationUrl,
                'user' => $this->user,
                'salutation' => '宜しくお願い致します。',
                'actionText' => 'メールアドレスの確認',
                'displayableActionUrl' => $verificationUrl,
                'actionUrl' => $verificationUrl,
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

    protected function verificationUrl($notifiable, $user)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($user->email)]
        );
    }
}
