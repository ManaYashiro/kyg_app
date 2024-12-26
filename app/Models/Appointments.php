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
        'main_menu',
        'sub_menu',
        'store',
        'taskcategory',
        'reservationtask',
        'user_vehicle_id',
        'additional_services',
        'inspection_due_date',
        'past_service_history',
        'requirement',
        'reservation_count',
        'remarks',
        'reservation_status',
        'admin_notes',
    ];

    // モデルイベントを登録
    protected static function boot()
    {
        parent::boot();
        // 登録するとreservation_statusを 1
        static::creating(function ($appointment) {
            $appointment->reservation_status = 1;
        });

        //キャンセルするとreservation_status` を 0
        static::deleting(function ($appointment) {
            // `reservation_status` を 0
            $appointment->update(['reservation_status' => 0]);
        });
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

            if (!$appointment->reservation_number) {
                $lastReservationNumber = DB::table('appointments')->max('reservation_number');
                $appointment->reservation_number = $lastReservationNumber ? $lastReservationNumber + 1 : config('database.starting_reservation_no');
            }
        });
    }
}
