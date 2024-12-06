<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVehicles extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'car1_name',
        'car1_katashiki',
        'car1_number',
        'car1_class',
        'car2_name',
        'car2_katashiki',
        'car2_number',
        'car2_class',
        'car3_name',
        'car3_katashiki',
        'car3_number',
        'car3_class',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
