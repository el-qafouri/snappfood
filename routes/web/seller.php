<?php

use Illuminate\Support\Facades\Route;


Route::get('dashboard/seller' , [\App\Http\Controllers\UserController::class , 'sellerIndex'])->middleware(['role:seller'])->name('seller.dashboard');
