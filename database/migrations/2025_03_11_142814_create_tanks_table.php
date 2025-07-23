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
        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id');
            $table->string('oil_type');
            $table->string('state_info')->nullable();
            $table->float('volume');
            $table->float('today_volume')->default(0)->nullable();
            $table->float('oil_ratio')->nullable();
            $table->integer('level')->nullable();
            $table->float('capacity')->nullable();
            $table->float('temperature')->nullable();
            $table->float('weight')->default(0);
            $table->float('water_ratio')->default(0);
            $table->float('avaliable_oil_weight')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
};
