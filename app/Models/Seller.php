<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Seller extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'user_id',
        'store_name',
        'store_email',
        'store_description' ,
        'account_balance'
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
        return $this->belongsTo(User::class);
    }
}
