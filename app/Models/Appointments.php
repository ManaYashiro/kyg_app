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
        'reservation_number',
        'reservation_datetime',
        'customer_name',
        'main_menu',
        'sub_menu',
        'store',
        'taskcategory',
        'reservationtask',
        'vehicle',
        'additional_services',
        'inspection_due_date',
        'past_service_history',
        'requirement',
        'reservation_count',
        'remarks',
        'reservation_status',
        'admin_notes',
    ];
}
