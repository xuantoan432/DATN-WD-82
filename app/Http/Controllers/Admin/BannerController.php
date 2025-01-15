<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validPositions = array_keys(config('banner_positions'));
        $validatedData = $request->validate([
            'banner_title' => 'nullable|string|max:255',
            'banner_text' => 'nullable|string|max:500',
            'banner_link' => 'nullable|url|max:255',
            'banner_image' => 'required|image',
            'status' => 'required|in:active,inactive',
            'position' => 'required|in:' . implode(',', $validPositions)
        ]);

        if ($request->hasFile('banner_image')) {
            $pathFile = Storage::put('banners', $request->file('banner_image'));
            $validatedData['banner_image'] = $pathFile;
        }

        Banner::create($validatedData);

        return redirect()->route('admin.banners.index')->with('success', 'Thêm banner thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        $validPositions = array_keys(config('banner_positions'));
        $validatedData = $request->validate([
            'banner_title' => 'nullable|string|max:255',
            'banner_text' => 'nullable|string|max:500',
            'banner_link' => 'nullable|url|max:255',
            'banner_image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
            'position' => 'required|in:' . implode(',', $validPositions)
        ]);

        if ($request->hasFile('banner_image')) {
            if ($banner->banner_image) {
                Storage::delete($banner->banner_image);
            }
            $pathFile = Storage::put('banners', $request->file('banner_image'));
            $validatedData['banner_image'] = $pathFile;
        }
        $banner->update($validatedData);

        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật banner thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->banner_image) {
            Storage::delete($banner->banner_image);
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Xóa banner thành công');
    }
}
