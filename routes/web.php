<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/reservation', function () {
    return view('reservation');
});
Route::get('/gallery', function () {
    return view('gallery');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::group(['prefix' => 'penginap'], function () {
    Route::get('/', [ApiController::class, 'getDataPenginap']); 
    Route::get('/{id}', [ApiController::class, 'getPenginapByID']); 
    Route::get('/nama/{nama}', [ApiController::class, 'getPenginapByName']); 

});


Route::get('/kamar/{kamar}', [ApiController::class, 'getDetailKamar']);

