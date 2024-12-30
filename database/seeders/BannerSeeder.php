<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BannerSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        Schema::disableForeignKeyConstraints();
        $this->deleteOldImages('banners');
        DB::table('banners')->truncate();
        DB::table('banners')->insert([
            [
                'banner_title' => 'Fashion Collection Summer Sale',
                'banner_image' => $this->uploadImage('1.webp', 'banners'),
                'banner_text' => 'Up to 70% off',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'hero',
            ],
            [
                'banner_title' => 'Fashion Collection Summer Sale 2',
                'banner_image' => $this->uploadImage('2.webp', 'banners'),
                'banner_text' => 'up to 20% off',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'hero',
            ],
            [
                'banner_title' => 'Fashion Collection Summer Sale 3',
                'banner_image' => $this->uploadImage('3.webp', 'banners'),
                'banner_text' => 'up to 30%',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'hero',
            ],
            [
                'banner_title' => 'Get 65% Offer & Make New  Fusion.',
                'banner_image' => $this->uploadImage('6.webp', 'banners'),
                'banner_text' => 'NEW STYLE',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'sub1',
            ],
            [
                'banner_title' => 'Make your New Styles with Our  Products',
                'banner_image' => $this->uploadImage('7.webp', 'banners'),
                'banner_text' => 'mega offer',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'sub1',
            ],
            [
                'banner_title' => 'Make your New Styles with Our  Products',
                'banner_image' => $this->uploadImage('4.webp', 'banners'),
                'banner_text' => 'NEW STYLE',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'sub2',
            ],
            [
                'banner_title' => 'Get 65% Offer & Make New Fusion.',
                'banner_image' => $this->uploadImage('5.webp', 'banners'),
                'banner_text' => 'Mega OFFER',
                'banner_link' => NULL,
                'status' => 'active',
                'position' => 'sub2',
            ],

        ]);
        Schema::enableForeignKeyConstraints();
    }
}
