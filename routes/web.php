<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\seller\ReportController;
use App\Models\Banner;
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
    $banners = Banner::query()->get()->all();
    return view('layouts.main', compact('banners'));
//    return view('layouts.main');
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



Route::prefix('reports')->middleware('auth')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/export-orders', [ReportController::class , 'export'])->name('reports.export-orders');

});







//Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
//Route::get('/reports/export', [ReportController::class, 'export']);


//Route::get('test' , \App\Http\Controllers\TestController::class);

