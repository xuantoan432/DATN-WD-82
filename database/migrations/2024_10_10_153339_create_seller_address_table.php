<?php

use App\Models\Address;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seller_address', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seller::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Address::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_address');
    }
};
