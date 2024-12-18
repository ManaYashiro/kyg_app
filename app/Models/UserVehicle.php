<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class UserVehicle extends Model
{
    use HasFactory, SoftDeletes;

    const MAX_NO_OF_CARS = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'sequence_no',
        'car_name',
        'car_katashiki',
        'car_number',
        'car_class',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasOne(Appointments::class);
    }

    /**
     * Register any authentication / authorization services.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userVehicle) {
            if (!$userVehicle->sequence_no) {
                $last_sequence_no = DB::table('user_vehicles')
                    ->where('user_id', $userVehicle->user_id)
                    ->max('sequence_no');
                $userVehicle->sequence_no = $last_sequence_no ? $last_sequence_no + 1 : 1;
            }
        });
    }
}
