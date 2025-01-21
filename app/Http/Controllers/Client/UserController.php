<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressDetail;
use App\Models\Order;
use App\Models\Review;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
   public function userDashboard(Request $request)
   {
       $type = $request->input('type') ?? null;
       $user =  Auth::user();
       switch ($type) {
           case 'personal':{
               return view('client.profile.components.personal-info');
           }
           case 'store':{
               $user->load('seller.address');
               $store = $user->seller;
               $address = $store?->address[0];
               return view('client.profile.components.store-info', compact('store', 'address'));
           }
           case 'payment-method':{
               return view('client.profile.components.payment-method');
           }
           case 'order':{

               $user->load('orders.orderDetails','addresses.province', 'addresses.ward', 'addresses.district');
               $orders = $user->orders()->orderByDesc('id')->get();
               return view('client.profile.components.order', compact('orders'));
           }
           case 'address':{
               $user =  Auth::user();
               $user->load('addresses.province', 'addresses.ward', 'addresses.district');
               $line_addresses = [];
               $addresses = $user->addresses;
               foreach ($addresses as $address){
                   $line_addresses[] = $address->full_address;
               }
               return view('client.profile.components.address', compact('addresses', 'line_addresses'));
           }
           case 'rating':{

            $user = Auth::user();
            $reviews = Review::where('user_id', $user->id)
                ->with('product') // Load thông tin sản phẩm liên quan
                ->orderByDesc('created_at')
                ->get();
               return view('client.profile.components.rating', compact('reviews'));
           }
           case 'change-password':{
               return view('client.profile.components.password');
           }
           default:
               return view('client.profile.components.dashboard');

       }

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
           'full_name' => 'required|string|max:255',
           'phone_number' => 'required',
       ]);
      $address = Address::create([
         'address_line' => $validatedData['address_line'],
         'province_id' => $validatedData['province'],
         'district_id' => $validatedData['district'],
         'ward_id' => $validatedData['ward'],
      ]);

      $address->users()->attach($request->user()->id);
      $user = auth()->user();
      $user->update([
          'default_address_id' => $address->id,
      ]);
      AddressDetail::create([
          'address_id' => $address->id,
          'full_name' => $validatedData['full_name'],
          'phone_number' => $validatedData['phone_number'],
      ]);
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

   public function updateAddressDefault(Request $request,User $user){
        $idAddress = $request->input('address');
        $user->update(['default_address_id' => $idAddress]);
        return redirect()->back();
   }

    public function saveOrUpdateShop(Request $request)
    {
        $user = Auth::user();

        // Xác thực dữ liệu
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'address' => 'array',
            'address.province' => 'required|exists:provinces,id',
            'address.district' => 'required|exists:districts,id',
            'address.ward' => 'required|exists:wards,id',
            'address.address_line' => 'required|string|max:255',
            'logo_shop' => 'nullable|file|max:2048',
            'store_email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('sellers', 'store_email')->ignore(optional($user->seller)->id),
            ],
            'store_description' => 'nullable|string',
        ]);

        // Chuẩn bị dữ liệu cho địa chỉ
        $dataAddress = [
            'address_line' => $validated['address']['address_line'],
            'province_id' => $validated['address']['province'],
            'district_id' => $validated['address']['district'],
            'ward_id' => $validated['address']['ward'],
        ];

        if ($request->hasFile('logo_shop')) {
            $validated['logo_shop'] = Storage::put('sellers', $request->file('logo_shop'));
        }

        if (!$user->seller) {
            $seller = $user->seller()->create([
                'store_name' => $validated['store_name'],
                'store_email' => $validated['store_email'],
                'store_description' => $validated['store_description'] ?? null,
                'logo_shop' => $validated['logo_shop'] ?? null,
            ]);

            $address = Address::create($dataAddress);

            $seller->address()->attach($address->id);

            return redirect()->back()->with('success', 'Cửa hàng đã được thêm mới.');
        } else {
            $user->seller->update([
                'store_name' => $validated['store_name'],
                'store_email' => $validated['store_email'],
                'store_description' => $validated['store_description'] ?? null,
                'logo_shop' => $validated['logo_shop'] ?? $user->seller->logo_shop, // Giữ logo cũ nếu không cập nhật mới
            ]);

            // Thêm hoặc cập nhật địa chỉ
            $address = Address::updateOrCreate(
                [
                    'id' => $user->seller->address()->first()->id ?? null, // Lấy địa chỉ đầu tiên của cửa hàng hiện tại
                ],
                $dataAddress
            );

            $user->seller->address()->syncWithoutDetaching([$address->id]);

            return redirect()->back()->with('success', 'Cửa hàng đã được cập nhật.');
        }
    }


}
