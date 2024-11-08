<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'code', 'discount_type', 'discount_value', 
        'max_discount_amount', 'min_order_value','start_date','end_date',
         'usage_limit', 'usage_type', 'usage_per_customer'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
