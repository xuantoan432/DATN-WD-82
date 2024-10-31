<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   public function userDashboard()
   {

      $user =  Auth::user();

      return view('client.user-profile', compact('user'));
   }


   public function updateUser(Request $request, $id)
   {
      $validatedData = $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
         'dob' => 'required|date',
         'phone' => 'required|digits:10',
         'gender' => 'required',
         'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
      ]);

      $user = Auth::user();

      if ($request->hasFile('avatar')) {

         if ($user->avatar) {
            Storage::delete( $user->avatar);
        }

         $pathFile = Storage::put('users', $request->file('avatar'));

         $validatedData['avatar'] = $pathFile;
     }

     User::query()->findOrFail($id)->update($validatedData);


  
     return redirect()->back()->with('success', 'Cập nhật thành công!');
   }
}
