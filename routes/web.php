<?php

use App\Models\Sale;
use App\Jobs\CreateSale;
use App\Jobs\CreateFuelIn;
use App\Jobs\CreateNewSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Traits\HasConfig;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/sales', function(){

    $sales = DB::table('fuel_management.sales')->orderBy('id', 'desc')
                ->where('created_at', '>', '2025-06-30')
                ->where('created_at', '<', '2025-07-21')
                ->whereIn('fuel_type_id', [1, 2, 3])
                ->get();

    CreateNewSale::dispatch($sales->toArray());

})->name('sales');

Route::post('/upload', function(Request $request){
    $json = $request->file->getContent();

    $attributes = json_decode($json);

    CreateNewSale::dispatch($attributes);

    // CreateSale::dispatch($attributes);
})->name('upload');

Route::post('/fuelin', function(Request $request){
    $json = $request->file->getContent();

    $attributes = json_decode($json, true);

    CreateFuelIn::dispatch($attributes);
})->name('fuelin');
