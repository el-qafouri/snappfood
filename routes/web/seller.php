<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard/seller' , [UserController::class , 'sellerIndex'])->middleware(['auth' ,'role:seller'])->name('seller.dashboard');

Route::get('restaurant/create' , [RestaurantController::class , 'create'])->name('restaurant.create');

Route::post('restaurant/store' , [RestaurantController::class , 'store'])->name('restaurant.store');


Route::get('/seller/dashboard', [UserController::class , 'dashboard'])->name('seller.dashboard');
