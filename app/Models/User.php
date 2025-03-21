<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'address', 'email', 'password', 'phone', 'role',
        'avatar', 'email_verified_at', 'verification_code', 
        'verification_code_sent_at', 'verification_code_expires_at',
        'password_reset_sent_at', 'password_reset_expires_at'
    ];

    protected $attributes = [
        'role' => 'user',  // Sử dụng dấu `=>` để gán giá trị mặc định
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verification_code_sent_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'password_reset_sent_at' => 'datetime',
        'password_reset_expires_at' => 'datetime',
    ];
    public function getAvataUrlAttribute()
    {
        return $this->avatar ? asset('storage/avatar/' . $this->avatar) : asset('images/default-avatar.png');
    }
}
