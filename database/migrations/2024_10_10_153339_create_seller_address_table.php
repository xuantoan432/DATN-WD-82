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
            $table->foreignIdFor(Seller::class)->constrained();
            $table->foreignIdFor(Address::class)->constrained();
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
