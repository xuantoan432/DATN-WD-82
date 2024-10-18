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
        DB::table('user_role')->insert(
            [
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
            ]
        );
        Seller::factory(10)->create();
         Post::factory(10)->create();
         Tag::factory(10)->create();
         Comment::factory(10)->create();
         Voucher::factory(10)->create();
         Address::factory(10)->create();
         Category::factory(10)->create();
         Product::factory(10)->create();
         Review::factory(10)->create();
         Gallery::factory(10)->create();
         ProductVariant::factory(10)->create();
         Attribute::factory(10)->create();
         AttributeValue::factory(10)->create();
         ProductVariantAttribute::factory(10)->create();
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
                        'address_id' =>$j,
                    ]);
                    DB::table('user_address')->insert([
                        'user_id' => $i,
                        'address_id' =>$j,
                    ]);
                }
            }
//         ProductHasAttribute::factory(10)->create();
         Inventory::factory(10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
