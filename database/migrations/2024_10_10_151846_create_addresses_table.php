<?php

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_line');
            $table->foreignIdFor(\Kjmtrue\VietnamZone\Models\Province::class)->constrained();
            $table->foreignIdFor(\Kjmtrue\VietnamZone\Models\Ward::class)->constrained();
            $table->foreignIdFor(\Kjmtrue\VietnamZone\Models\District::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
