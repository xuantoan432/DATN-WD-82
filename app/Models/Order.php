<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDING = 'Pending';
    const PROCESSING = 'Processing';
    const SHIPPING = 'Shipping';
    const DELIVERED = 'Delivered';
    const CANCELLED = 'Cancelled';

    protected $fillable = [
        'payment_method_id',
        'payment_status_id',
        'user_id',
        'address_id',
        'order_code',
        'total_price',
        'note',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->order_code = self::generateOrderID();
        });
    }
    private static function generateOrderID()
    {
        $date = now()->format('Ymd');
        $randomString = \Str::upper(\Str::random(6));
        return 'ORD-' . $date . '-' . $randomString;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }
}
