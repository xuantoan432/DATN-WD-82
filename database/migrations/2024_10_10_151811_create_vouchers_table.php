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
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('code')->unique() ;
            $table->enum('discount_type' , ['percentage', 'fixed']) ;
            $table->decimal('discount_value' ,10 ,2 )  ;
            $table->decimal('max_discount_amount' ,10 ,2 )  ;
            $table->decimal('min_order_value' ,10 ,2 )  ;
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('usage_limit') ;
            $table->boolean('usage_type') -> default(false) ;
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->unsignedBigInteger('usage_per_customer') ;
            $table->timestamps();

            $table->index(['code', 'start_date', 'end_date']);
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
