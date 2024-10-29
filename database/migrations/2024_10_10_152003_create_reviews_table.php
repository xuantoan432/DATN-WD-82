<?php

use App\Models\Product;
use App\Models\User;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class) ->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class) ->constrained()->onDelete('cascade');
            $table->string('content') ;
            $table -> unsignedBigInteger('star') ->default(0);
            $table->string('image') -> nullable() ;
            $table->unsignedBigInteger('parent_id') ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
