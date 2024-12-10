<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'address_id',
        'phone_number',
        'full_name',
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }
}
