<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'address',
        'email',
        'password',
        'phone',
        'avatar',
        'email_verified_at',
        'verification_code',
        'verification_code_sent_at',
        'verification_code_expires_at',
        'password_reset_sent_at',
        'password_reset_expires_at',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
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

    public function role()
    {
        return $this->belongsTo(Role::class,);
    }
    // Kiểm tra user có phải admin không

    public function isAdmin()
    {
        return $this->role_id == 1; // Vai trò 1 là Admin
    }


    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites', 'user_id', 'product_id');
    }
}
