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

Route::get('/penginap', "App\Http\Controllers\ApiController@getDataPenginap");


Route::get('/kamar/{kamar}', "App\Http\Controllers\ApiController@getDetailKamar");

