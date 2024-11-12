<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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

    public function jsonToString($data)
    {
        return json_decode($data, true);
    }

    public function stringToJson($data)
    {
        return json_encode($data);
    }
}
