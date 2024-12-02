<?php

namespace App\Models;

use App\Exceptions\SendEmailFailedException;
use App\Helpers\Log;
use App\Notifications\NotifyAdminOfRegisteredUserNotification;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    public const TITLE = 'ユーザー';

    public const ADMIN = 'admin';
    public const USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'loginid',
        'name',
        'furigana',
        'email',
        'password',
        'phone_number',
        'post_code',
        'address',
        'building',
        'preferred_contact_time',
        'how_did_you_hear',
        'is_newsletter_subscription',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'how_did_you_hear' => 'array',
        ];
    }

    public function findUserAnkets()
    {
        if ($this->how_did_you_hear && count($this->how_did_you_hear)) {
            $ankets = Anket::whereIn('id', $this->how_did_you_hear)->pluck('short_name');
            $anketsData = "";
            foreach ($ankets as $key => $anket) {
                if ($anketsData !== "") {
                    $anketsData .= "；";
                }
                $anketsData .= $anket;
            }
            return $anketsData;
        }
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $user = $this;
        try {
            // ユーザー登録メール送信
            $this->notify(new RegisteredUserNotification($user));
        } catch (SendEmailFailedException $e) {
            throw new SendEmailFailedException(self::TITLE . 'のメールの送信に失敗しました。');
        }
    }

    /**
     * Register any authentication / authorization services.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            Log::info(self::TITLE . '登録中', $user->name);

            try {
                // 管理者にお知らせ
                $authUsers = User::where('role', User::ADMIN)->get();
                foreach ($authUsers as $key => $authUser) {
                    $authUser->notify(new NotifyAdminOfRegisteredUserNotification($user));
                }
            } catch (SendEmailFailedException $e) {
                Log::info('管理者に' . User::TITLE . 'の登録のお知らせ', $this->user->name);
                throw new SendEmailFailedException('管理者に' . User::TITLE . 'の登録のお知らせが失敗です。');
            }
        });

        static::created(function ($user) {
            Log::info(self::TITLE . '登録が完了しました', $user->name, true);
        });

        static::updating(function ($user) {
            Log::info(self::TITLE . '保存中', $user->name, true);
        });

        static::updated(function ($user) {
            Log::info(self::TITLE . '保存が完了しました', $user->name, true);
        });

        static::deleting(function ($user) {
            Log::info(self::TITLE . '保存中', $user->name, true);
        });

        static::deleted(function ($user) {
            Log::info(self::TITLE . '保存が完了しました', $user->name, true);
        });
    }
}
