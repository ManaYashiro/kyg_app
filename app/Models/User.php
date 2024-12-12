<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\IsNewsletterEnum;
use App\Enums\IsNotificationEnum;
use App\Enums\PrefectureEnum;
use App\Exceptions\SendEmailFailedException;
use App\Helpers\Log;
use App\Notifications\NotifyAdminOfRegisteredUserNotification;
use App\Notifications\RegisteredUserNotification;
use App\Notifications\RegisteredUserPasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        'name_furigana',
        'email',
        'password',
        'zipcode',
        'prefecture',
        'address1',
        'address2',
        'phone_number',
        'gender',
        'birthday',
        'reg_device',
        'reg_ipaddr',
        'call_time',
        'questionnaire',
        'manager',
        'department',
        'remarks',
        'is_receive_newsletter',
        'is_receive_notification',
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
            'questionnaire' => 'array',
            'gender' => GenderEnum::class,
            'prefecture' => PrefectureEnum::class,
            'is_receive_newsletter' => IsNewsletterEnum::class,
            'is_receive_notification' => IsNotificationEnum::class,
        ];
    }

    /**
     * Register any authentication / authorization services.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '登録中', $user->name);
            }
            if (!$user->customer_no) {
                $lastCustomerNo = DB::table('users')->max('customer_no');
                $user->customer_no = $lastCustomerNo ? $lastCustomerNo + 1 : config('database.starting_customer_no');
            }
        });

        static::created(function ($user) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '登録が完了しました', $user->name, true);
                try {
                    // 管理者にお知らせ
                    $authUsers = User::where('role', User::ADMIN)->get();
                    foreach ($authUsers as $key => $authUser) {
                        $authUser->notify(new NotifyAdminOfRegisteredUserNotification($user));
                    }
                } catch (SendEmailFailedException $e) {
                    Log::info('管理者に' . self::TITLE . 'の登録のお知らせ', $this->user->name);
                    throw new SendEmailFailedException('管理者に' . self::TITLE . 'の登録のお知らせが失敗です。');
                }
            }
        });

        static::updating(function ($user) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '保存中', $user->name, true);
            }
        });

        static::updated(function ($user) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '保存が完了しました', $user->name, true);
            }
        });

        static::deleting(function ($user) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '保存中', $user->name, true);
            }
        });

        static::deleted(function ($user) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '保存が完了しました', $user->name, true);
            }
        });
    }

    public function userVehicles()
    {
        return $this->hasMany(UserVehicle::class);
    }

    public function findUserAnkets()
    {
        if ($this->questionnaire && count($this->questionnaire)) {
            $ankets = Anket::whereIn('id', $this->questionnaire)->pluck('short_name');
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
        // if (config('app.env') !== 'testing') {
        $user = $this;
        try {
            // ユーザー登録メール送信
            $this->notify(new RegisteredUserNotification($user));
        } catch (SendEmailFailedException $e) {
            throw new SendEmailFailedException(self::TITLE . 'のメールの送信に失敗しました。');
        }
        // }
    }

    public function sendPasswordResetNotification($token)
    {
        $user = $this;
        // if (config('app.env') !== 'testing') {
        try {
            // ユーザーパスワード再設定メール送信
            $this->notify(new RegisteredUserPasswordResetNotification($user, $token));
        } catch (SendEmailFailedException $e) {
            throw new SendEmailFailedException(self::TITLE . 'のパスワード再設定メールの送信に失敗しました。');
        }
        // }
    }
}
