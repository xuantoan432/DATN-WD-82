<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'seller_id',
        'final_fee_percentage',
        'name',
        'short_description',
        'sku',
        'content',
        'price',
        'image',
        'views',
        'quantity',
        'is_verified',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_has_attribute');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::now()->locale('vi')->format('d, \T\h\á\ng m, h:i A'); 
    }
}
