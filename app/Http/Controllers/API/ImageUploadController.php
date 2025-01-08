<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = Storage::putFile('uploads', $request->file('file'));

            return response()->json(['location' => Storage::url($path)]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
