<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::orderBy('id', 'DESC')->paginate(20);
        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'fee_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $data = $request->only('name', 'fee_percentage');

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/icons', $filename, 'public');
            $data['icon'] = $path;
        }

        if (Category::create($data)) {
            return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công');
        }

        return redirect()->back()->with('no', 'Lỗi ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        $data = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.edit', compact('category','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required|string|max:100' ,
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'fee_percentage' => 'required|numeric|min:0|max:100',
        ]);
        $category->name = $request->name;
        $category->fee_percentage = $request->fee_percentage;
        if ($request->hasFile('icon')) {
            if ($category->icon && \Storage::disk('public')->exists($category->icon)) {
                \Storage::disk('public')->delete($category->icon);
            }
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/icons', $filename, 'public');
            $category->icon = $path;
        }
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        if ($category->delete()) {
            return redirect()->route('admin.category.index')->with('success', 'Xóa thành công');
        }
        return redirect()->back()->with('error', 'Lỗi');
    }
}
