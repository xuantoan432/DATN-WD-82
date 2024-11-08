<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
   public function userDashboard()
   {
      $user =  Auth::user();
      $addresses = $user->addresses;
      return view('client.user-profile', compact('user', 'addresses'));
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
            Storage::delete($user->avatar);
         }

         $pathFile = Storage::put('users', $request->file('avatar'));

         $validatedData['avatar'] = $pathFile;
      }

      User::query()->findOrFail($id)->update($validatedData);



      return redirect()->back()->with('success', 'Cập nhật thành công!');
   }

   public function createAddress(Request $request)
   {
      if (!$request->user()->hasRole(3)) {
         return redirect()->back()->with('error', 'Bạn không có quyền thêm địa chỉ.');
      }

      $validatedData = $request->validate([
         'address_line' => 'required|string|max:255',
         'province' => 'required|integer',
         'district' => 'required|integer',
         'ward' => 'required|integer',
      ]);

      $address = Address::create([
         'address_line' => $validatedData['address_line'],
         'province_id' => $validatedData['province'],
         'district_id' => $validatedData['district'],
         'ward_id' => $validatedData['ward'],
      ]);
      $request->user()->addresses()->save($address);

      return redirect()->back()->with('success', 'Địa chỉ mới đã được thêm thành công.');
   }

   public function deleteAddress($id)
   {
      $user = Auth::user();

      $address = $user->addresses->where('id', $id)->first();

      if (!$address) {
         return redirect()->back()->with('error', 'Địa chỉ không tồn tại hoặc bạn không có quyền xóa địa chỉ này.');
      }

      $address->delete();

      return redirect()->back()->with('success', 'Địa chỉ đã được xóa thành công.');
   }

   public function changePassword(Request $request)
   {
      $request->validate([
         'current_password' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
               $user = Auth::user();
               if (!Hash::check($value, $user->password)) {
                  $fail('Mật khẩu hiện tại không đúng.');
               }
            },
         ],
         'new_password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            function ($attribute, $value, $fail) use ($request) {
               $user = Auth::user();
               if ($value === $request->current_password) {
                  $fail('Mật khẩu mới không được trùng với mật khẩu hiện tại.');
               }
            },
         ],
      ]);

      $user = Auth::user();

      // Cập nhật mật khẩu mới
      $user->update([
         'password' => bcrypt($request->new_password),
      ]);

      return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
   }
}
