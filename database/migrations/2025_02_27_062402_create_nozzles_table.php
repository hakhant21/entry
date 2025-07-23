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
        Schema::create('nozzles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispenser_id');
            $table->foreignId('stock_price_id');
            $table->string('nozzle_no');
            $table->boolean('auto_approve')->default(false);
            $table->boolean('semi_approve')->default(false);
            $table->boolean('cashier_approve')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nozzles');
    }
};
