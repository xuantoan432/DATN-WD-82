<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Chat extends Model
{
    use HasFactory;
    protected $appends = ['formatted_created_at'];
    protected $fillable = [
        'message',
        'user_send_id',
        'user_receive_id',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_send_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_receive_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->isToday()
            ? $this->created_at->format('g:i A') . ', Today'
            : $this->created_at->format('g:i A, d M Y');
    }
}
