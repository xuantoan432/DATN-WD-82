<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerAddress extends Model
{
    use HasFactory;
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
