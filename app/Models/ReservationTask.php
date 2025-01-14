<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationTask extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    public const TITLE = '予約する作業';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inspection_type',
        'work_type',
        'customer_type',
        'management_flag',
        'maintenance_flag',
        'reservation_name',
        'has_tire_storage',
        'deadline',
        'site_flag_inazawa',
        'site_flag_nagoyakita',
        'site_flag_kariya',
        'site_flag_nishiki',
        'site_flag_toyota_kamigo',
        'site_flag_inuyama',
    ];
}
