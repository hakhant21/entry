<?php

namespace App\Traits;

use Exception;
use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait HasConfig
{
    public function getDispenser($value)
    {
        $nozzle = DB::table('nozzles')->where('nozzle_no', $value)->first();

        return $nozzle->dispenser_id;
    }

    public function getNozzle($value)
    {
        $nozzle = DB::table('nozzles')->where('nozzle_no', $value)->first();

        return $nozzle->id;
    }

    public function getPayment($value)
    {
        $payments = collect(config('payments'));

        $payment = $payments->where('name', $value)->first();

        return $payment['id'];
    }

    public function getTank($value)
    {
        $fuelType = DB::table('fuel_types')->where('name', $value)->first();

        return $fuelType->tank_id;
    }

    public function getType($value)
    {
        $fuelType = DB::table('fuel_types')->where('name', $value)->first();

        return $fuelType->id;
    }

    public function getVehicle($value)
    {
        $vehicles = collect(config('vehicles'));

        $vehicle = $vehicles->where('name', $value)->first();

        if ($vehicle == null) {
            return 1;
        }

        return $vehicle['id'];
    }

    public function extractVocono($value)
    {
        $vocono = explode('/', $value);

        return [
            'cashier' => $vocono[1] == 'm1' ? 'manager' : 'cashier',
            'serial_no' => $vocono[3],
        ];
    }

    public function generateVoucherNo($value, $date)
    {
        $vocono = $this->extractVocono($value);

        $cashier = $vocono['cashier'];

        $stationNo = 'KS-001';

        $today = Carbon::parse($date)->format('Ymd');

        $counter = $vocono['serial_no'];

        $voucherNo = "{$stationNo}/" . Str::upper(trim($cashier)) . '/' . $today . "/{$counter}";

        return $voucherNo;
    }

    public function getSale(array $attribute)
    {
        return [
            'station_id' => 1,
            'dispenser_id' => $this->getDispenser($attribute['nozzleNo']),
            'nozzle_id' => $this->getNozzle($attribute['nozzleNo']),
            'fuel_type_id' => $this->getType($attribute['fuelType']),
            'payment_id' => $this->getPayment($attribute['cashType']),
            'vehicle_type_id' => $this->getVehicle($attribute['vehicleType']),
            'tank_id' => $this->getTank($attribute['fuelType']),
            'cashier_code' => 'C-SSSK-001-4',
            'car_no' => $attribute['carNo'],
            'voucher_no' => $this->generateVoucherNo($attribute['vocono'], $attribute['dailyReportDate']),
            'device' => $attribute['device'],
            'totalizer_liter' => $attribute['totalizer_liter'],
            'totalizer_amount' => $attribute['totalizer_amount'],
            'device_totalizer_liter' => $attribute['devTotalizar_liter'],
            'device_totalizer_amount' => $attribute['devTotalizar_liter'] * $attribute['salePrice'],
            'tank_balance' => isset($attribute['tankBalance']) ? $attribute['tankBalance'] : null,
            'sale_liter' => $attribute['saleLiter'],
            'sale_price' => $attribute['salePrice'],
            'total_price' => $attribute['totalPrice'],
            'is_preset' => $attribute['preset'] != null ? 1 : 0,
            'preset_amount' => $attribute['preset'] != null ? $attribute['preset'] : null,
            'daily_report_date' => $attribute['dailyReportDate'],
            'created_at' => Carbon::parse($attribute['createAt']['$date'])->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($attribute['createAt']['$date'])->format('Y-m-d H:i:s'),
        ];
    }

    public function getNewSale($attribute)
    {
        return [
            'station_id' => 1,
            'dispenser_id' => $attribute->dispenser_id,
            'nozzle_id' => $attribute->nozzle_id,
            'fuel_type_id' => $attribute->fuel_type_id,
            'payment_id' => $attribute->payment_id,
            'vehicle_type_id' => $attribute->vehicle_type_id,
            'tank_id' => $attribute->tank_id,
            'cashier_code' => $attribute->cashier_code,
            'car_no' => $attribute->car_no,
            'voucher_no' => $attribute->voucher_no,
            'device' => $attribute->device,
            'totalizer_liter' => $attribute->totalizer_liter,
            'totalizer_amount' => $attribute->totalizer_amount,
            'device_totalizer_liter' => $attribute->device_totalizer_liter,
            'device_totalizer_amount' => $attribute->device_totalizer_amount,
            'tank_balance' => $attribute->tank_balance,
            'sale_liter' => $attribute->sale_liter,
            'sale_price' => $attribute->sale_price,
            'total_price' => $attribute->total_price,
            'is_preset' => $attribute->is_preset,
            'preset_amount' => $attribute->preset_amount,
            'daily_report_date' => $attribute->daily_report_date,
            'created_at' => $attribute->created_at,
            'updated_at' => $attribute->updated_at,
        ];
    }

    public function getFuelIn(array $attribute)
    {
        return [
            'tank_id' => $this->getTank($attribute['fuel_type']),
            'station_id' => 1,
            'fuel_type_id' => $this->getType($attribute['fuel_type']),
            'code' => $attribute['fuel_in_code'],
            'terminal_name' => $attribute['terminal'],
            'driver_name' => $attribute['driver'],
            'bowser_no' => $attribute['bowser'],
            'tank_capacity' => $attribute['tank_capacity'],
            'opening_balance' => $attribute['opening_balance'],
            'closing_balance' => $attribute['closing_balance'],
            'send_balance' => $attribute['send_balance'],
            'receive_balance' => $attribute['receive_balance'],
            'created_at' => $attribute['createAt'],
            'updated_at' => $attribute['updateAt'],
        ];
    }
}
