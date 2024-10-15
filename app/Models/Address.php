<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_address');
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'seller_address');
    }
}
