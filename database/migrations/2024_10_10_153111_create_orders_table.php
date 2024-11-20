<?php

use App\Models\Address;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PaymentStatus::class) -> constrained()->onDelete('cascade');
            $table->foreignIdFor(PaymentMethod::class) -> constrained()->onDelete('cascade');
            $table->foreignIdFor(OrderStatus::class) -> constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class) -> constrained()->onDelete('cascade');
            $table->foreignIdFor(Address::class) -> constrained()->onDelete('cascade');
            $table->string('order_code') ;
            $table->decimal('total_price' , 10 , 2 ) ;
            $table->string('note') ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
