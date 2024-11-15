<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    public const ADMIN = 'admin';
    public const USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'furigana',
        'email',
        'password',
        'phone_number',
        'post_code',
        'address',
        'building',
        'preferred_contact_time',
        'how_did_you_hear',
        'is_newsletter_subscription',
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
            'how_did_you_hear' => 'array',
        ];
    }

    function findUserAnkets()
    {
        if ($this->how_did_you_hear && count($this->how_did_you_hear)) {
            $ankets = Anket::whereIn('id', $this->how_did_you_hear)->pluck('short_name');
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
}
