<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->deleteOldImages('categories');
        DB::table('categories')->truncate();
        $categories = [
            ['name' => 'Váy', 'icon' => $this->uploadImage('1.webp', 'categories'), 'fee_percentage' => 5],
            ['name' => 'Túi da', 'icon' => $this->uploadImage('2.webp', 'categories'), 'fee_percentage' => 8],
            ['name' => 'Áo len', 'icon' => $this->uploadImage('3.webp', 'categories'), 'fee_percentage' => 6],
            ['name' => 'Giày bốt', 'icon' => $this->uploadImage('4.webp', 'categories'), 'fee_percentage' => 10],
            ['name' => 'Quà tặng cho Nam', 'icon' => $this->uploadImage('5.webp', 'categories'), 'fee_percentage' => 7],
            ['name' => 'Giày thể thao', 'icon' => $this->uploadImage('6.webp', 'categories'), 'fee_percentage' => 9],
            ['name' => 'Đồng hồ', 'icon' => $this->uploadImage('7.webp', 'categories'), 'fee_percentage' => 4],
            ['name' => 'Nhẫn vàng', 'icon' => $this->uploadImage('8.webp', 'categories'), 'fee_percentage' => 12],
            ['name' => 'Mũ lưỡi trai', 'icon' => $this->uploadImage('9.webp', 'categories'), 'fee_percentage' => 3],
            ['name' => 'Kính mát', 'icon' => $this->uploadImage('10.webp', 'categories'), 'fee_percentage' => 5],
            ['name' => 'Đồ trẻ em', 'icon' => $this->uploadImage('11.webp', 'categories'), 'fee_percentage' => 6],
        ];
        DB::table('categories')->insert($categories);
        Schema::enableForeignKeyConstraints();
    }
}
