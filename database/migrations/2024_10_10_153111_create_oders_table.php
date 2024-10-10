<?php

use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
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
        Schema::create('oders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PaymentStatus::class) -> constrained();
            $table->foreignIdFor(PaymentMethod::class) -> constraints();
            $table->foreignIdFor(OrderStatus::class) -> constraints();
            $table->foreignIdFor(User::class) -> constraints();
            $table->string('oder_code') ;
            $table->string('shipping_address') ;
            $table->decimal('total_price' , 10 , 2 ) ; 
            $table->string('note') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oders');
    }
};
