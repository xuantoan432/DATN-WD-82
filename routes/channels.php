<?php

use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('seller.{sellerId}', function ($user, $sellerId) {
    return (int) $user->seller->id === (int) $sellerId;
});
Broadcast::channel('thongbao', function(){
    return true;
});
Broadcast::channel('user.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

