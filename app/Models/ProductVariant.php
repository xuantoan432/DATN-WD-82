<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_variant_attributes');
    }
    public function getCurrentPrice()
    {
        $now = Carbon::now();

        if ($this->price_sale && $this->date_start && $this->date_end) {
            if ($now->between($this->date_start, $this->date_end)) {
                return $this->price_sale;
            }
        }

        return $this->price;
    }
}
