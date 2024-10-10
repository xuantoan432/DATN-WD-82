<?php

use App\Models\Oder;
use App\Models\Product;
use App\Models\ProductVariantAttribute;
use App\Models\Seller;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('oder_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Oder::class) -> constraints();
            $table->foreignIdFor(Product::class) -> constraints();
            $table->foreignIdFor(Seller::class) -> constraints();
            $table->foreignIdFor(ProductVariantAttribute::class) -> constraints();
            $table->unsignedBigInteger('quantity');
            $table->string('name') ;
            $table->string('image') ;
            $table->decimal('price',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oder_details');
    }
};
