<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy tất cả các vai trò từ bảng roles
        $roles = Role::all(); // Đảm bảo rằng bạn có model Role và bảng roles đã tồn tại

        // Trả về view và truyền dữ liệu roles vào
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:2048', // tối đa 2MB
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id', // Đảm bảo vai trò tồn tại
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
                'address_line' => $validated['address'],
                'province_id' => $request->input('province_id', null), // Gán null nếu không có giá trị
                'district_id' => $request->input('district_id', null),
                'ward_id' => $request->input('ward_id', null),
            ]);
        
            // Gắn địa chỉ này với người dùng
            $user->addresses()->attach($address->id);
        }

        // Gán vai trò cho người dùng
        $user->roles()->attach($validated['role_id']);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }




    public function edit($id)
    {
        // Lấy thông tin người dùng cùng với role và địa chỉ mặc định (defaultAddress)
        $user = User::with(['defaultAddress.details'])->findOrFail($id);
        $roles = Role::all(); // Lấy tất cả các vai trò
        $user = User::with(['roles'])->findOrFail($id);

        return view('admin.user.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'phone' => 'required',
            'avatar' => 'nullable|image|mimes:png,jpg,gif',
            'email' => 'required|string|max:255',
            'role_id' => 'required|array', // Xác thực role (nếu có nhiều role)
            'role_id.*' => 'exists:roles,id', // Đảm bảo các role ID hợp lệ
        ]);

        // Lấy thông tin người dùng
        $user = User::findOrFail($id);

        // Xử lý avatar nếu có thay đổi
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

        if ($request->has('address_id')) {
            $user->update(['default_address_id' => $request->address_id]);
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
