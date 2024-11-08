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
        'vehicle_name',
        'registration_number',
        'vehicle_type',
        'license_plate',
        'additional_services',
        'past_service_history',
        'message',
    ];
}
