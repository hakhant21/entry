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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id');
            $table->foreignId('dispenser_id');
            $table->foreignId('nozzle_id');
            $table->foreignId('fuel_type_id')->nullable();
            $table->foreignId('payment_id')->nullable();
            $table->foreignId('discount_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('vehicle_type_id')->nullable();
            $table->foreignId('tank_id')->nullable();
            $table->string('cashier_code')->nullable();
            $table->string('car_no')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('device')->default('web'); // web, mobile, tablet
            $table->float('tank_balance')->nullable()->default(0);
            $table->float('totalizer_liter')->nullable()->default(0);
            $table->float('totalizer_amount')->nullable()->default(0);
            $table->float('device_totalizer_liter')->nullable()->default(0);
            $table->float('device_totalizer_amount')->nullable()->default(0);
            $table->float('sale_liter')->nullable()->default(0);
            $table->bigInteger('sale_price')->nullable()->default(0);
            $table->bigInteger('total_price')->nullable()->default(0);
            $table->bigInteger('grand_total')->nullable()->default(0);
            $table->boolean('is_preset')->nullable();
            $table->string('preset_amount')->nullable()->default(0);
            $table->timestamp('daily_report_date')->default(Carbon\Carbon::now()->format('Y-m-d H:i:s'));
            $table->boolean('is_sync')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
