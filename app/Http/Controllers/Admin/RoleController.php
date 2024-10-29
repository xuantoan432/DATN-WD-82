<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Role::create($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (in_array($role->name, ['admin', 'customer', 'seller'])) {
            return redirect()->route('admin.roles.index')->with('error', 'Không thể chỉnh sửa Role này.');
        }

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (in_array($role->name, ['admin', 'customer', 'seller'])) {
            return redirect()->route('admin.roles.index')->with('error', 'Không thể cập nhật Role này.');
        }

        $request->validate(['name' => 'required|string|max:255']);
        $role->update($request->all());
        return redirect()->route('admin.roles.index')->with('success', 'Role đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Kiểm tra nếu role là admin, customer hoặc seller
        if (in_array($role->name, ['admin', 'customer', 'seller'])) {
            return redirect()->route('admin.roles.index')->with('error', 'Không thể xóa Role này.');
        }

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role đã được xóa thành công.');
    }

}
