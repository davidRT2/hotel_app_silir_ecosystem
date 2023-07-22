<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\MidtransApiController;
use App\Http\Controllers\RoomController;
use Illuminate\Routing\RouteRegistrar;

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
})->name('home');
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
Route::get('/contact', function () {
    return view('contact');
})->name('contactus');

Route::group(['prefix' => 'penginap'], function () {
    Route::get('/', [ApiController::class, 'getDataPenginap']);
    Route::get('/{id}', [ApiController::class, 'getPenginapByID']);
    Route::get('/nama/{nama}', [ApiController::class, 'getPenginapByName']);
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/reservation', [ApiController::class, 'getTipe'])->name('reservation.index');
//lucky TI2B

//test feb
Route::get('/detail-kamar/{id}', [ApiController::class, 'getDetailKamar'])->name('detail-kamar.index');

//checkout febri
Route::post('/checkout', [ApiController::class, 'checkout'])->name('checkout');

//dapid
Route::get('admin/home', [ApiController::class, 'getDataPenginap']);

Route::get('admin/history', function () {
    return view('admin.history');
});

Route::get('admin/income', function () {
    return view('admin.income');
});

/**
 * Kamar Route Start
 */
Route::get('admin/room', [RoomController::class, 'index'])->name('room-index');
Route::post('admin/room', [RoomController::class, 'add'])->name('add-room');
/**
 * Kamar Route End
 */

/**
 * Payment Admin Gateway start
 */
Route::get('admin/checkout', [MidtransApiController::class, 'index'])->name('checkout-index');
Route::post('admin/booking', [MidtransApiController::class, 'booking'])->name('booking');
Route::get('testing', [MidtransApiController::class, 'booking']);
/**
 * Payment Admin Gateway End
 */
