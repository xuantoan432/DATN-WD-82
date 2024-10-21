<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name',
        'dob',
        'avatar',
        'gender',
        'email_verified_at',
        'email',
        'password',
        'remember_token',
        'phone',
        'email',
        'password',

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
        'password' => 'hashed',
    ];
    public function address()
    {
        return $this->belongsToMany(Address::class, 'user_address');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function chatsSent()
    {
        return $this->hasMany(Chat::class, 'user_send_id');
    }

    public function chatsReceived()
    {
        return $this->hasMany(Chat::class, 'user_receive_id');
    }

    public function hasRole($role)
{
    return $this->roles()->where('role_id', $role)->exists();
}
}
