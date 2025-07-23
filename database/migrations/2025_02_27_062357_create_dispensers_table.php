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
        Schema::create('dispensers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id');
            $table->string('device_ip');
            $table->string('server_ip');
            $table->integer('server_port');
            $table->string('dispenser_no')->nullable();
            $table->string('firmware_version')->nullable();
            $table->integer('boot_count')->nullable();
            $table->integer('retry_count')->nullable();
            $table->string('debug_bit')->nullable();
            $table->string('password')->nullable();
            $table->string('wifi_ssid');
            $table->string('wifi_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensers');
    }
};
