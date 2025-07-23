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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id');
            $table->foreignId('vehicle_type_id');
            $table->string('name', 50);
            $table->string('car_number', 30);
            $table->string('type', 10); // credit/ normal / debit
            $table->string('email', 30)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('card_number', 30)->nullable();
            $table->float('debit_liter')->nullable();
            $table->bigInteger('debit_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
