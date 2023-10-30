<?php

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
});


Route::get('login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login.show');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::get('register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register.show');
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
