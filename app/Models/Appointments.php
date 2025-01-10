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
    //修正予定
    const TASK_MAPPING = [
        1 => '★個人★車検ラビット４５（00分開始）（60分）',
        2 => '☆法人☆ご来店型クイック車検（00分開始）（60分）',
        3 => '★個人★車検ラビット４５（30分開始）（60分）',
        4 => '☆法人☆ご来店型クイック車検（30分開始）（60分）',
        5 => '★個人★車検ラビット４５（60分）',
        6 => '☆法人☆ご来店型クイック車検（60分）',
        7 => '★個人★車検見積り（30分）',
        8 => '☆法人☆スケジュール点検（30分）',
        9 => '☆法人☆ユニカー点検（30分）',
        10 => '☆法人☆スケジュール点検＋タイヤ付替え（60分）',
        11 => '★個人★12ヶ月点検（60分）',
        12 => '☆法人☆12ヶ月点検（60分）',
        13 => '☆法人☆6ヶ月点検（60分）',
        14 => '★個人★タイヤ付替え[ホイール付](30分)',
        15 => '★法人★タイヤ付替え[ホイール付](30分)',
        16 => '★個人★タイヤ付替え[タイヤのみ](60分)',
        17 => '★個人★エンジンオイル交換（30分）',
        18 => '☆法人☆エンジンオイル交換（30分）',
        19 => 'メンテパック6ヶ月点検（30分）',
        20 => 'メンテパック12ヶ月点検（60分）',
        21 => 'メンテパック18ヶ月点検（30分）',
        22 => 'メンテパック24ヶ月点検（60分）',
        23 => 'メンテパック30ヶ月点検（30分）'
    ];

    // 予約タスク名を取得するアクセサ
    public function getReservationTaskNameAttribute()
    {
        return self::TASK_MAPPING[$this->reservation_task_id] ?? '不明';
    }

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
