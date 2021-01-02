<?php

use Illuminate\Support\Facades\Route;
use App\Models\stock_market;
use App\Http\Controllers\stock_marketController;
use App\Http\Controllers\getDataController;
use Illuminate\Http\Request;
// use Carbon\Carbon;

Route::post('/api/add', [stock_marketController::class, 'store']);
Route::post('/delete/{i}', [stock_marketController::class, 'destroy'])->name('delete');

Route::get('/edit/{i}', function($id){
    $entry = stock_market::find($id);
    return view('layout.edit',['entry' => $entry]);
})->name('edit');

Route::post('/edit/{i}/confirm',[stock_marketController::class, 'update'])->name('confirm');
Route::get('api/data',[getDataController::class,'get']);
Route::get('api/data/all',[getDataController::class,'getAll']);
Route::get('/', function () {

    // $jsonString = file_get_contents(base_path('resources/stock_market_data.json'));
    // $jsonString = file_get_contents('http://fc1744b5107a.ngrok.io/api/data/all');
    // $array = json_decode($jsonString);
    // foreach ($array as $obj) {
    //     stock_market::create(array(
    //         'trade_code' => $obj->trade_code,
    //         'date' => $obj->date,
    //         'high'=>floatval($obj->high),
    //         'low' =>floatval($obj->low) ,
    //         'open' => floatval($obj->open),
    //         'close' =>floatval($obj->close) ,
    //         'volume'=> intval($obj->volume),
    //     ));
    // }
    // return view('layout.index',['stock' => $data]);
    return view('layout.index');

});
