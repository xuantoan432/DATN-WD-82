<?php

use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('seller', function(){
    return true;
});


Broadcast::channel('user.{userId}', function ($user, $userId) {
    // Kiểm tra quyền truy cập kênh (chỉ cho phép người dùng có userId đúng)
    return (int) $user->id === (int) $userId;
});
