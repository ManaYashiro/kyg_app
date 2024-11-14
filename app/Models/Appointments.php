<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    // テーブル名を明示的に指定
    protected $table = 'appointments';

    // 複数代入可能なフィールドの定義
    protected $fillable = [
        'user_id',
        'sort_number',
        'reservation_datetime',
        'vehicle_name',
        'registration_number',
        'vehicle_type',
        'license_plate',
        'inspection_due_date',
        'additional_services',
        'past_service_history',
        'message',
    ];
}
