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

    public function hasUserRated($userId)
    {
        return $this->reviews()->where('user_id', $userId)->exists();
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

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['min-value'], $filters['max-value'])) {
            $query->whereBetween('price', [$filters['min-value'], $filters['max-value']]);
        }
        if (!empty($filters['categories_id'])) {
            $query->whereIn('category_id', $filters['categories_id']);
        }
        if (!empty($filters['sellers_id'])) {
            $query->whereIn('seller_id', $filters['sellers_id']);
        }
        if (!empty($filters['searchProduct'])) {
            $query->where('name', 'like', '%' . $filters['searchProduct'] . '%');
        }
    }

    public function scopeSort($query, $sortOrder)
    {
        switch ($sortOrder) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderByDesc('reviews_avg_star');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    }
}
