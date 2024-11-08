<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'user_id'
    ];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function productVariantAttributes()
    {
        return $this->hasMany(ProductVariantAttribute::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
