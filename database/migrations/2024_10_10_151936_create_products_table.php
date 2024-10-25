<?php

use App\Models\Category;
use App\Models\Seller;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Seller::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('final_fee_percentage')->nullable();
            $table->string('name');
            $table->text('short_description');
            $table->string('sku');
            $table->text('content');
            $table->decimal('price', 10, 2);

            $table->string('image');
            $table->unsignedBigInteger('views')->default(0);

            $table->boolean('is_verified')->default(false);
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
