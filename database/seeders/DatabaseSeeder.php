<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Inventory;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductHasAttribute;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttribute;
use App\Models\Review;
use App\Models\Role;
use App\Models\Seller;
use App\Models\SellerAddress;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Voucher;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Role::truncate();
        Seller::truncate();
        Post::truncate();
        Tag::truncate();
        Comment::truncate();
        Voucher::truncate();
        Address::truncate();
        Category::truncate();
        Product::truncate();
        Review::truncate();
        Gallery::truncate();
        ProductVariant::truncate();
        Attribute::truncate();
        AttributeValue::truncate();
        ProductVariantAttribute::truncate();
        Wishlist::truncate();
        Cart::truncate();
        CartItem::truncate();
        Chat::truncate();
        PaymentMethod::truncate();
        PaymentStatus::truncate();
        OrderStatus::truncate();
        Order::truncate();
        OrderDetail::truncate();
        Notification::truncate();
        Banner::truncate();
        DB::table('seller_address')->truncate();
        DB::table('user_address')->truncate();
        DB::table('user_role')->truncate();
        //        ProductHasAttribute::truncate();
        Inventory::truncate();
        \App\Models\User::factory(10)->create();
         Role::insert([
             ['name' => 'admin'],
             ['name' => 'seller'],
             ['name' => 'customer'],
         ]);
        DB::table('user_role')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
            ],
            [
                'user_id' => 2,
                'role_id' => 3,
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
            ],
            [
                'user_id' => 3,
                'role_id' => 3,
            ],
            [
                'user_id' => 4,
                'role_id' => 3,
            ],
            [
                'user_id' => 5,
                'role_id' => 3,
            ],
            [
                'user_id' => 6,
                'role_id' => 3,
            ],
            [
                'user_id' => 6,
                'role_id' => 2,
            ]
        ]);
        Seller::factory(10)->create();
        Post::factory(10)->create();
        Tag::factory(10)->create();
        Comment::factory(10)->create();
        Voucher::factory(10)->create();
        Address::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(10)->create();
        Review::factory(10)->create();

//        ProductVariant::factory(10)->create();
//        Attribute::factory(10)->create();
//        AttributeValue::factory(10)->create();
//        ProductVariantAttribute::factory(10)->create();
        $attributes = [
            ['id' => 1, 'name' => 'Color'],
            ['id' => 2, 'name' => 'Size'],
            ['id' => 3, 'name' => 'Material'],
        ];

        foreach ($attributes as &$attribute) {
            $attribute['user_id'] = 2;
        }

        $attribute_values = [
            ['id' => 1, 'attribute_id' => 1, 'value' => 'Red'],
            ['id' => 2, 'attribute_id' => 1, 'value' => 'Blue'],
            ['id' => 3, 'attribute_id' => 1, 'value' => 'Green'],
            ['id' => 4, 'attribute_id' => 2, 'value' => 'Small'],
            ['id' => 5, 'attribute_id' => 2, 'value' => 'Medium'],
            ['id' => 6, 'attribute_id' => 2, 'value' => 'Large'],
            ['id' => 7, 'attribute_id' => 3, 'value' => 'Cotton'],
            ['id' => 8, 'attribute_id' => 3, 'value' => 'Polyester'],
        ];

        foreach ($attribute_values as &$attribute_value) {
            $attribute_value['user_id'] = 2;
        }
        $product_variants = [
            [
                'id' => 1,
                'product_id' => 10,
                'sku' => 'SKU10-RD-SM-CT',
                'price' => 100,
                'price_sale' => 90,
                'image' => $this->uploadImage('a6u00sSpJk6w3GxrBz32imHyYZOhTq7SeXxP7MHm.jpg'),
                'stock_quantity' => 10,
                'is_verified' => true,
                'status' => 1,  // Active
                'date_start' => '2024-01-01',
                'date_end' => '2024-12-31',
            ],
            [
                'id' => 2,
                'product_id' => 10,
                'sku' => 'SKU10-RD-MD-CT',
                'price' => 105,
                'price_sale' => 95,
                'image' => $this->uploadImage('AXY6PDa1WKifnqZX6oeDAl6YyxXz6lkHuezeo4iZ.jpg'),
                'stock_quantity' => 8,
                'is_verified' => true,
                'status' => 1,  // Active
                'date_start' => '2024-01-01',
                'date_end' => '2024-12-31',
            ],
            [
                'id' => 3,
                'product_id' => 10,
                'sku' => 'SKU10-BL-MD-PL',
                'price' => 110,
                'price_sale' => 100,
                'image' => $this->uploadImage('BnuBDZqMjxWagVoU4T1nsEjqmRrJGNzCAQ2ZJVN2.jpg'),
                'stock_quantity' => 5,
                'is_verified' => false,
                'status' => 0,  // Inactive
                'date_start' => '2024-03-01',
                'date_end' => '2024-12-31',
            ],
            [
                'id' => 4,
                'product_id' => 10,
                'sku' => 'SKU10-GR-LG-PL',
                'price' => 120,
                'price_sale' => 110,
                'image' => $this->uploadImage('qhyaQd59SXgJZTlFkbsG0DsC6xqx3XclzRjAKw8y.jpg'),
                'stock_quantity' => 3,
                'is_verified' => true,
                'status' => 1,  // Active
                'date_start' => '2024-05-01',
                'date_end' => '2024-12-31',
            ],
        ];

        $galleries = [
            ['id' => 1, 'product_id' => 10, 'image' => $this->uploadImage('a6u00sSpJk6w3GxrBz32imHyYZOhTq7SeXxP7MHm.jpg')],
            ['id' => 2, 'product_id' => 10, 'image' => $this->uploadImage('AXY6PDa1WKifnqZX6oeDAl6YyxXz6lkHuezeo4iZ.jpg')],
            ['id' => 3, 'product_id' => 10, 'image' => $this->uploadImage('BnuBDZqMjxWagVoU4T1nsEjqmRrJGNzCAQ2ZJVN2.jpg')],
            ['id' => 4, 'product_id' => 10, 'image' => $this->uploadImage('qhyaQd59SXgJZTlFkbsG0DsC6xqx3XclzRjAKw8y.jpg')],
        ];

        $product_variant_attributes = [
            // SKU10-RD-SM-CT
            ['id' => 1, 'product_variant_id' => 1, 'attribute_id' => 1, 'attribute_value_id' => 1], // Color: Red
            ['id' => 2, 'product_variant_id' => 1, 'attribute_id' => 2, 'attribute_value_id' => 4], // Size: Small
            ['id' => 3, 'product_variant_id' => 1, 'attribute_id' => 3, 'attribute_value_id' => 7], // Material: Cotton

            // SKU10-RD-MD-CT
            ['id' => 4, 'product_variant_id' => 2, 'attribute_id' => 1, 'attribute_value_id' => 1], // Color: Red
            ['id' => 5, 'product_variant_id' => 2, 'attribute_id' => 2, 'attribute_value_id' => 5], // Size: Medium
            ['id' => 6, 'product_variant_id' => 2, 'attribute_id' => 3, 'attribute_value_id' => 7], // Material: Cotton

            // SKU10-BL-MD-PL
            ['id' => 7, 'product_variant_id' => 3, 'attribute_id' => 1, 'attribute_value_id' => 2], // Color: Blue
            ['id' => 8, 'product_variant_id' => 3, 'attribute_id' => 2, 'attribute_value_id' => 5], // Size: Medium
            ['id' => 9, 'product_variant_id' => 3, 'attribute_id' => 3, 'attribute_value_id' => 8], // Material: Polyester

            // SKU10-GR-LG-PL
            ['id' => 10, 'product_variant_id' => 4, 'attribute_id' => 1, 'attribute_value_id' => 3], // Color: Green
            ['id' => 11, 'product_variant_id' => 4, 'attribute_id' => 2, 'attribute_value_id' => 6], // Size: Large
            ['id' => 12, 'product_variant_id' => 4, 'attribute_id' => 3, 'attribute_value_id' => 8], // Material: Polyester
        ];
        DB::table('attributes')->insert($attributes);
        DB::table('galleries')->insert($galleries);
        DB::table('attribute_values')->insert($attribute_values);
        DB::table('product_variants')->insert($product_variants);
        DB::table('product_variant_attributes')->insert($product_variant_attributes);


        Wishlist::factory(10)->create();
        Cart::factory(10)->create();
        CartItem::factory(10)->create();
        Chat::factory(10)->create();
        PaymentMethod::factory(10)->create();
        PaymentStatus::factory(10)->create();
        OrderStatus::factory(10)->create();
        Order::factory(10)->create();
        OrderDetail::factory(10)->create();
        Notification::factory(10)->create();
        Banner::factory(10)->create();
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                DB::table('seller_address')->insert([
                    'seller_id' => $i,
                    'address_id' => $j,
                ]);
                DB::table('user_address')->insert([
                    'user_id' => $i,
                    'address_id' => $j,
                ]);

            }
        }
        //         ProductHasAttribute::factory(10)->create();
        Inventory::factory(10)->create();
        Schema::enableForeignKeyConstraints();
    }

    private function uploadImage($fileName)
    {
        // Đường dẫn gốc của file ảnh trong thư mục `database/seeders/images`
        $sourcePath = database_path("seeders/images/{$fileName}");

        // Kiểm tra nếu file tồn tại, di chuyển vào thư mục lưu trữ
        if (file_exists($sourcePath)) {
            $storagePath = 'products/' . \Str::random(10) . '_' . $fileName;
            Storage::put($storagePath, file_get_contents($sourcePath));
            return $storagePath;
        }

        // Nếu file không tồn tại, trả về null hoặc một placeholder
        return 'products/placeholder.jpg';
    }
}
