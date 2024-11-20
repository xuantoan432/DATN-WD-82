<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'province_id',
        'district_id',
        'ward_id',
        'address_line',  // Thêm trường này vào để cho phép mass assignment
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_address');
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'seller_address');
    }

    public function userWithThisAsDefault()
    {
        return $this->hasOne(User::class, 'default_address_id');
    }
    public function details()
    {
        return $this->hasOne(AddressDetail::class);
    }
}
