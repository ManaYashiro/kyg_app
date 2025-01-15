<?php

namespace App\Models;

use App\Helpers\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointments extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const TITLE = '予約';

    // テーブル名を明示的に指定
    protected $table = 'appointments';

    // 複数代入可能なフィールドの定義
    protected $fillable = [
        'user_id',
        'reservation_number',
        'reservation_datetime',
        'customer_name',
        'store',
        'inspection_type',
        'work_type',
        'customer_type',
        'reservation_task_id',
        'additional_services',
        'inspection_due_date',
        'past_service_history',
        'remarks',
        'reservation_status',
        'admin_notes',
    ];

    // ステータスの定数を定義
    const STATUS_CANCELLED = 0;
    const STATUS_TEMPORARY = 1;
    const STATUS_CONFIRMED = 2;

    // ステータスと表示テキストの対応を定義
    const STATUS_TEXTS = [
        self::STATUS_CANCELLED => '予約取り消し/キャンセル',
        self::STATUS_TEMPORARY => '仮予約',
        self::STATUS_CONFIRMED => '本予約'
    ];

    // ステータステキストを取得するアクセサ
    public function getStatusTextAttribute()
    {
        return self::STATUS_TEXTS[$this->reservation_status] ?? '不明';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userVehicle()
    {
        return $this->belongsTo(UserVehicle::class);
    }

    /**
     * Register any authentication / authorization services.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . '登録中', $appointment);
            }

            // 登録するとreservation_status を 1
            $appointment->reservation_status = 1;

            if (!$appointment->reservation_number) {
                $lastReservationNumber = DB::table('appointments')->max('reservation_number');
                $appointment->reservation_number = $lastReservationNumber ? $lastReservationNumber + 1 : config('database.starting_reservation_no');
            }
        });

        static::deleting(function ($appointment) {
            if (config('app.env') !== 'testing') {
                Log::info(self::TITLE . 'キャンセル中', $appointment);
            }

            //キャンセルするとreservation_status` を 0
            $appointment->update(['reservation_status' => 0]);
        });
    }
}
