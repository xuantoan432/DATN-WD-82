<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()->orderByDesc('id')->paginate(10);
        if($request->role){
            $users = User::whereHas('roles', function ($query) use ($request) {
                $query->where('id', $request->role);
            })->paginate(10);
        }
        return view('admin.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'array',
            'address.province' => 'required|exists:provinces,id',
            'address.district' => 'required|exists:districts,id',
            'address.ward' => 'required|exists:wards,id',
            'address.address_line' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required',
        ]);
        // Tải ảnh avatar lên nếu có
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Tạo người dùng
        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'avatar' => $validated['avatar'] ?? null,
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($validated['address']) {
            $address = Address::create([
                'address_line' => $validated['address']['address_line'],
                'province_id' => $validated['address']['province'], // Gán null nếu không có giá trị
                'district_id' => $validated['address']['district'],
                'ward_id' => $validated['address']['ward'],
            ]);
            $user->update([
                'default_address_id' => $address->id,
            ]);
            // Gắn địa chỉ này với người dùng
            $user->addresses()->attach($address->id);
        }

        // Gán vai trò cho người dùng
        $user->roles()->attach($validated['roles']);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }




    public function edit($id)
    {
        $roles = Role::all(); // Lấy tất cả các vai trò
        $user = User::with(['roles', 'addresses'])->findOrFail($id);
        $address = Address::query()->find($user->default_address_id)->first();
        return view('admin.user.edit', compact('user', 'roles', 'address'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'array',
            'address.province' => 'required|exists:provinces,id',
            'address.district' => 'required|exists:districts,id',
            'address.ward' => 'required|exists:wards,id',
            'address.address_line' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'required',
        ]);
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Lưu avatar mới
            $image = $request->file('avatar');
            $newFileName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/avatar', $newFileName, 'public');
        } else {
            // Nếu không có avatar mới, giữ avatar cũ
            $path = $user->avatar;
        }

        // Cập nhật thông tin người dùng
        $data = [
            'name' => $request->name,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'avatar' => $path,  // Lưu lại đường dẫn avatar mới hoặc cũ
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password, // Nếu có mật khẩu mới thì mã hóa, nếu không giữ mật khẩu cũ
        ];

        // Cập nhật dữ liệu người dùng
        $user->update($data);

        if ($request->has('address')) {
            $dataAddress = [
                'address_line' => $validated['address']['address_line'],
                'province_id' => $validated['address']['province'], // Gán null nếu không có giá trị
                'district_id' => $validated['address']['district'],
                'ward_id' => $validated['address']['ward'],
            ];
            $user->defaultAddress()->update($dataAddress);
        }

        // Cập nhật các role mà người dùng có (nếu có)
        if ($request->has('role_id')) {
            $user->roles()->sync($request->role_id); // Cập nhật vai trò
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }



    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Request $request)
    {
        $userName = $request->input('name');

        $user = User::where('name', $userName)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }

        return redirect()->route('admin.users.index')->with('error', 'User not found.');
    }

}
