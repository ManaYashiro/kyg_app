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
            ->subject('パスワード再設定URLのお知らせ')
            ->line('------------------------------')
            ->line('このメールは配信専用のため返信できません')
            ->line('------------------------------')
            ->line('キムラユニティーグループ にて会員登録された方へのパスワード再設定URLのご案内です。')
            ->line('以下のURLに2時間以内にアクセスしてパスワードの再設定を行ってください。')
            ->action('パスワード再設定', $passwordResetURL)  // ここでURLをボタンとして表示
            ->line(' ')
            ->line('■■□―――！！明治14年創業！！――――□■■')
            ->line('━－━－━－━－━－━－━－━－━－━－━－━')
            ->line('キムラユニティー株式会社')
            ->line('カーライフサービス　https://carlife-service.com/')
            ->line('各店舗のお問合せ先　https://carlife-service.com/store.html')
            ->line('----------------------------------------------------')
            ->line('企業ホームページ　https://www.kimura-unity.co.jp/')
            ->salutation('');  // 丁寧な挨拶の代わりにカスタムサルーテーションを使用しない
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
