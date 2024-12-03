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
    const DELIVERED = 'Delivered';
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
}
