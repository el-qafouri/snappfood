<?php

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('layouts.main');
})->name('main');


Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AuthController::class, 'login'])->middleware('web')->name('login');
    Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('sellerRegister', [AuthController::class, 'showSellerRegister'])->name('register.seller');
});

require __DIR__ . '/web/admin.php';
require __DIR__ . '/web/seller.php';
require __DIR__ . '/web/food.php';
require __DIR__ . '/web/user.php';





//Route::get('test' , \App\Http\Controllers\TestController::class);

