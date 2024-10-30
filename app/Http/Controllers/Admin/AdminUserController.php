<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        // $request->validate(['name' => 'required|string|max:255']);
        // $request->validate(['dob' => 'required|string|max:255']);
        // $request->validate(['phone' => 'required|string|max:255']);
        // // 'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        // $request->validate(['email' => 'required|string|max:255']);
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'phone' => 'required',
            'icon' => 'nullable|image|mimes:png,jpg,gif',
            'email' => 'required|string|max:255',
        ]);
        $path = null;
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $newFile = time() . '.' . $image->getClientOriginalName();
            $path = $image->storeAs('uploads/avatar', $newFile . 'public');
        }
        $data = [
            'name' => $request->name,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'avatar' => $path,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password
        ];
        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Role $role)
    // {
    //     return view('admin.roles.show', compact('role'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, $id)
    {
        // $request->validate(['name' => 'required|string|max:255']);
        // $user->update($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'phone' => 'required',
            'icon' => 'nullable|image|mimes:png,jpg,gif',
            'email' => 'required|string|max:255',
        ]);
        $update = User::find($id);
        $path = $request->avatar;
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($request->avatar);
            $image = $request->file('avatar');
            $newFile = time() . '.' . $image->getClientOriginalName();
            $path = $image->storeAs('uploads/avatar', $newFile . 'public');
        }
        $data = [
            'name' => $request->name,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'avatar' => $path,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password
        ];
        $update->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Role updated successfully.');
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
