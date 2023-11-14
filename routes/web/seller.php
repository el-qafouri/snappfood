<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Route::get('dashboard/seller' , [UserController::class , 'sellerIndex'])->middleware(['auth' ,'role:seller'])->name('seller.dashboard');
//Route::middleware('auth')->get('dashboard/seller/{user}', [UserController::class , 'dashboard'])->name('seller.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/seller', [UserController::class ,'dashboard'])->name('seller.dashboard');
//    Route::get('/dashboard', [UserController::class, 'sellerIndex'])->name('admin.dashboard');

});




//Route::get('restaurant/create' , [RestaurantController::class , 'create'])->name('restaurant.create');
//Route::post('restaurant/store' , [RestaurantController::class , 'store'])->name('restaurant.store');


Route::prefix('restaurant')->middleware(['auth' ,'role:admin|seller'])->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('{id}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::delete('{id}', [RestaurantController::class, 'destroy'])->name('restaurant.delete');

    Route::get('restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::post('create', [RestaurantController::class, 'store'])->name('restaurant.store');

    Route::get('{id}/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit');
    Route::put('update/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');
});

Route::prefix('restaurant')->middleware(['auth' , 'role:admin'])->group(function (){
//    Route::get('/{id}/editProfileStatus', [RestaurantController::class , 'editProfileStatus'])->name('restaurant.editProfileStatus');
    Route::patch('/{id}', [RestaurantController::class , 'updateProfileStatus'])->name('restaurant.updateProfileStatus');
});

