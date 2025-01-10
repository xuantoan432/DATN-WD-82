<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'province_id',
        'district_id',
        'ward_id',
        'address_line',  // Thêm trường này vào để cho phép mass assignment
    ];

    public function user()
    {
        return $this->belongsTo(User::class);  // Mỗi địa chỉ thuộc về một user
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
        return $this->hasOne(AddressDetail::class, 'address_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function getFullAddressAttribute()
    {
        return $this->address_line . ', '
            . ($this->ward->name ?? '') . ', '
            . ($this->district->name ?? '') . ', '
            . ($this->province->name ?? '');
    }

}
