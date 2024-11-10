<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    public function address()
    {
        return $this->belongsToMany(Address::class, 'seller_address');
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
