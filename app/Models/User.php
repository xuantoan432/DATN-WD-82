<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Seller;
use App\Models\AttributeValue;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'default_address_id',
        'remember_token',
        'phone',
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
        'is_default' => 'boolean',
    ];

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'user_address')->with('details');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
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
        return $this->roles()->where('id', $role)->exists();
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function attributes()
    {
        return $this->hasOne(Attribute::class);
    }

    public function attributeValues()
    {
        return $this->hasOne(AttributeValue::class);
    }

    public function defaultAddress()
    {
        return $this->belongsTo(Address::class, 'default_address_id')->with('details');
    }

    public function userVouchers()
    {
        return $this->belongsToMany(Voucher::class, 'user_voucher')
            ->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
