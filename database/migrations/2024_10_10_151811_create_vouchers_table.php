<?php

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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('code') ;
            $table->enum('discount_type' , ['%' ]) ;
            $table->decimal('discount_value' ,10 ,2 )  ;
            $table->decimal('max_discount_amount' ,10 ,2 )  ;
            $table->decimal('min_order_value' ,10 ,2 )  ;
            $table->dateTime('start_date') ;
            $table->dateTime('end_date') ;
            $table->unsignedBigInteger('usage_limit') ;
            $table->boolean('usage_type') -> default(false) ;
            $table->unsignedBigInteger('usage_per_customer') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
