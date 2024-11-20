<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
        'discount_type',
        'discount_value',
        'max_discount_amount',
        'min_order_value',
        'start_date',
        'end_date',
        'usage_limit',
        'usage_type',
        'usage_per_customer',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isValid()
    {
        return $this->usage_limit > 0 &&
            now()->between($this->start_date, $this->end_date);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_voucher')
            ->withTimestamps();
    }
}
