<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_name',
        'store_email',
        'store_description'


    ];
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
