<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('seller')->find(Auth::id());
    dd($user);
        $attributes = Attribute::query()->where('user_id', Auth::id())->get();
        return view('seller.attributes.index', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:attributes,name',
        ]);
        $data['user_id'] = auth()->id();
        Attribute::query()->create($data);
        return redirect()
                ->route('seller.attributes.index')
                ->with('success', 'Thêm mới thuộc tính thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        $attributes = Attribute::query()->orderBy('id', 'desc')->get();
        return view('seller.attributes.show', compact('attribute', 'attributes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        $attributes = Attribute::query()->orderBy('id', 'desc')->get();
        return view('seller.attributes.edit', compact('attribute', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $data = $request->validate([
            'name' => 'required|unique:attributes,name,' . $attribute->id,
        ]);
        $attribute->update($data);
        return back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('seller.attributes.index')->with('success', 'Xóa thành công');
    }
}
