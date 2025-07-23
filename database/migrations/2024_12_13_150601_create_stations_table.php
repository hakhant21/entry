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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id');
            $table->string('name', 50);
            $table->string('station_no', 20)->unique();
            $table->string('license_no', 20)->nullable();
            $table->string('image')->nullable();
            $table->string('phone_one', 20);
            $table->string('phone_two', 20)->nullable();
            $table->string('address');
            $table->dateTime('opening_date');
            $table->integer('subscribe_year');
            $table->dateTime('expiry_date');
            $table->string('opening_hour');
            $table->string('closing_hour');
            $table->boolean('is_atg')->default(false);
            $table->string('station_database')->nullable();
            $table->string('expose_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
