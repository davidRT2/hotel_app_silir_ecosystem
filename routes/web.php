<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MidtransApiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserMidtransController;
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
//Route::post('/checkout', [ApiController::class, 'checkout'])->name('checkout');

//dapid

Route::get('admin/history', function () {
    return view('admin.history');
});

Route::get('admin/income', function () {
    return view('admin.income');
});
Route::group(['middleware' => ['auth.api', 'auth.admin']], function () {
    Route::get('admin/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('admin/home', [ApiController::class, 'getDataPenginap'])->name('admin.home');
    Route::get('admin/room', [RoomController::class, 'index'])->name('room-index');
    Route::get('admin/checkout', [MidtransApiController::class, 'index'])->name('checkout-index');
});
/**
 * Kamar Route Start
 */
Route::post('admin/room', [RoomController::class, 'add'])->name('add-room');
/**
 * Kamar Route End
 */

/**
 * Payment Admin Gateway start
 */
Route::post('admin/booking', [MidtransApiController::class, 'booking'])->name('booking');
Route::post('payment', [MidtransApiController::class, 'payment_post'])->name('pay.post');
Route::post('payment/testing', [MidtransApiController::class, 'payment_post_test'])->name('pay.post.test');
Route::get('testing/{id}', [ApiController::class, 'getJenisLayanan']);
Route::post('testing', [MidtransApiController::class, 'test'])->name('febri');
/**
 * Payment Admin Gateway End
 */
/**
 * Payment user Gateway Start
 */
// Route::get('admin/checkout', [UserMidtransController::class, 'index'])->name('checkout-index');
// Route::post('admin/booking', [UserMidtransController::class, 'booking'])->name('booking');
// Route::post('payment', [UserMidtransController::class, 'payment_post'])->name('pay.post');
// Route::post('payment/testing', [UserMidtransController::class, 'payment_post_test'])->name('pay.post.test');
// Route::get('testing', [UserMidtransController::class, 'generateID_penginap']);

// Route::post('/checkout', [UserMidtransController::class, 'checkout'])->name('checkout');
/**
 * Payment user Gateway End
 */

 /***
  * History
  */


/***
 * Admin Home
 */

Route::post('admin/history', [HistoryController::class, 'status'])->name('history.status');
Route::get('logout', function () {
    return redirect('http://192.168.246.241:7778/logout');
})->name('logout');
