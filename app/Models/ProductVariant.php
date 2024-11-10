<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
            'product_id' ,
            'sku',
            'price' ,
            'price_sale' ,
            'image' ,
            'stock_quantity',
            'is_verified',
            'status',
            'date_start',
            'date_end',
    ] ;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_variant_attributes');
    }
}
