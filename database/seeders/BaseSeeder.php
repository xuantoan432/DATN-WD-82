<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected function uploadImage($fileName, $folder)
    {
        $sourcePath = base_path("database/seeders/images/{$folder}/{$fileName}");
        if (file_exists($sourcePath)) {
            $storagePath = $folder .'/' . \Str::random(10) . '_' . $fileName;
            Storage::put($storagePath, file_get_contents($sourcePath));
            return $storagePath;
        }

        return 'products/placeholder.jpg';
    }

    protected function deleteOldImages($folder)
    {
        // Lấy tất cả các ảnh cũ từ thư mục 'products' và xóa chúng
        $files = Storage::files($folder);
        foreach ($files as $file) {
            Storage::delete($file);
        }
    }
}
