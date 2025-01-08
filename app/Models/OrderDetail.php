<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    const PENDING = 'Pending';
    const PROCESSING = 'Processing';
    const SHIPPING = 'Shipping';
    const COMPLETED = 'Completed';
    const CANCELLED = 'Cancelled';

    protected $fillable = [
        'order_id',
        'seller_id',
        'product_variant_id',
        'quantity',
        'name',
        'image',
        'price',
        'variant_name',
        'status'
    ];

    protected static $validTransitions = [
        self::PENDING => [self::PROCESSING, self::CANCELLED],
        self::PROCESSING => [self::SHIPPING, self::CANCELLED],
        self::SHIPPING => [self::COMPLETED],
        self::COMPLETED => [],
        self::CANCELLED => [],
    ];

    public static function canTransition(string $from, string $to): bool
    {
        return in_array($to, static::$validTransitions[$from] ?? []);
    }

    public function transitionTo(string $newStatus): bool
    {
        if (self::canTransition($this->status, $newStatus)) {
            $this->status = $newStatus;
            $this->save();
            return true;
        }
        return false;
    }

    public static function getStatuses(): array
    {
        return [
            self::PENDING => 'Đang chờ xử lý',
            self::PROCESSING => 'Đang xử lý',
            self::SHIPPING => 'Đang giao',
            self::COMPLETED => 'Hoàn thành',
            self::CANCELLED => 'Đã hủy',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function status(){
        return $this->belongsTo(OrderStatus::class);
    }

    public function isCancelled(){
        return $this->status == self::CANCELLED;
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
