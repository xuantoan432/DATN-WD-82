<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->deleteOldImages('products');
        // Xóa dữ liệu cũ
        DB::table('products')->truncate();
        DB::table('galleries')->truncate();
        DB::table('product_variant_attributes')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('attribute_values')->truncate();
        DB::table('attributes')->truncate();

        // Danh sách thuộc tính và giá trị
        $attributes = [
            ['id' => 1, 'user_id' => 2, 'name' => 'Color'],
            ['id' => 2, 'user_id' => 2, 'name' => 'Size'],
            ['id' => 3, 'user_id' => 2, 'name' => 'Material'],
        ];

        $attributeValues = [
            ['id' => 1, 'attribute_id' => 1, 'value' => 'Red', 'user_id' => 2],
            ['id' => 2, 'attribute_id' => 1, 'value' => 'Blue', 'user_id' => 2],
            ['id' => 3, 'attribute_id' => 1, 'value' => 'Green', 'user_id' => 2],
            ['id' => 4, 'attribute_id' => 2, 'value' => 'Small', 'user_id' => 2],
            ['id' => 5, 'attribute_id' => 2, 'value' => 'Medium', 'user_id' => 2],
            ['id' => 6, 'attribute_id' => 2, 'value' => 'Large', 'user_id' => 2],
            ['id' => 7, 'attribute_id' => 3, 'value' => 'Cotton', 'user_id' => 2],
            ['id' => 8, 'attribute_id' => 3, 'value' => 'Polyester', 'user_id' => 2],
        ];

        DB::table('attributes')->insert($attributes);
        DB::table('attribute_values')->insert($attributeValues);

        // Danh sách sản phẩm
        $products = [];
        $productId = 10;
        $variantId = 1;
        $variantAttributes = [];
        $variants = [];
        $galleries = [];

        foreach (range(1, 30) as $index) { // Tạo 5 sản phẩm
            $productName = "Sample Product " . $index;
            $productSku = "SP" . str_pad($index, 3, '0', STR_PAD_LEFT);

            // Tạo sản phẩm
            $products[] = [
                'category_id' => 1,
                'seller_id' => 1,
                'final_fee_percentage' => 5,
                'name' => $productName,
                'short_description' => 'This is ' . $productName,
                'sku' => $productSku,
                'content' => 'Detailed description for ' . $productName,
                'price' => 100000,
                'image' => $this->uploadImage("$index.jpg", 'products'),
                'views' => rand(50, 200),
                'is_verified' => true,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tạo biến thể cho sản phẩm này
            foreach ($attributeValues as $color) {
                if ($color['attribute_id'] != 1) continue;

                foreach ($attributeValues as $size) {
                    if ($size['attribute_id'] != 2) continue;

                    foreach ($attributeValues as $material) {
                        if ($material['attribute_id'] != 3) continue;

                        $sku = $productSku . "-" . substr($color['value'], 0, 2) . "-" . substr($size['value'], 0, 2) . "-" . substr($material['value'], 0, 2);

                        // Thêm biến thể
                        $variants[] = [
                            'id' => $variantId,
                            'product_id' => $index,
                            'sku' => $sku,
                            'price' => rand(100000, 200000),
                            'price_sale' => rand(90000, 150000),
                            'image' => $this->uploadImage(rand(1,30) . ".jpg",'products'),
                            'stock_quantity' => rand(5, 20),
                            'is_verified' => true,
                            'status' => 1,
                            'date_start' => now(),
                            'date_end' => now()->addYear(),
                        ];

                        // Thêm thuộc tính cho biến thể
                        $variantAttributes[] = [
                            'id' => count($variantAttributes) + 1,
                            'product_variant_id' => $variantId,
                            'attribute_id' => 1,
                            'attribute_value_id' => $color['id'],
                        ];
                        $variantAttributes[] = [
                            'id' => count($variantAttributes) + 1,
                            'product_variant_id' => $variantId,
                            'attribute_id' => 2,
                            'attribute_value_id' => $size['id'],
                        ];
                        $variantAttributes[] = [
                            'id' => count($variantAttributes) + 1,
                            'product_variant_id' => $variantId,
                            'attribute_id' => 3,
                            'attribute_value_id' => $material['id'],
                        ];

                        $variantId++;
                    }
                }
            }

            $galleryCount = rand(3, 5);
            foreach (range(1, $galleryCount) as $k) {
                $galleries[] = [
                    'product_id' => $index,
                    'image' => $this->uploadImage(rand(1,30) . ".jpg",'products'),
                ];
            }

            $productId++;
        }

        // Insert dữ liệu vào database
        DB::table('products')->insert($products);
        DB::table('product_variants')->insert($variants);
        DB::table('product_variant_attributes')->insert($variantAttributes);
        DB::table('galleries')->insert($galleries);

        Schema::enableForeignKeyConstraints();
    }
}
