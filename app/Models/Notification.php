<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'notifiable_type' ,
        'notifiable_id',
        'title',
        'user_id' ,
        'message' ,
        'receiver_type',
    ]  ;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function notifiable()
    {
        return $this->morphTo();
    }
}
