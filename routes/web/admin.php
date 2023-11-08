<?php

use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodPartyController;
use App\Http\Controllers\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('restaurantCategory')->middleware(['auth','role:admin'])->group(function () {
Route::get('/', [RestaurantCategoryController::class, 'index'])->name('restaurantCategory.index');
Route::get('{id}', [RestaurantCategoryController::class, 'show'])->name('restaurantCategory.show');
Route::delete('{id}', [RestaurantCategoryController::class, 'destroy'])->name('restaurantCategory.delete');

Route::get('restaurantCategory/create', [RestaurantCategoryController::class, 'create'])->name('restaurantCategory.create');
Route::post('create', [RestaurantCategoryController::class, 'store'])->name('restaurantCategory.store');

Route::get('{id}/edit', [RestaurantCategoryController::class, 'edit'])->name('restaurantCategory.edit');
Route::put('update/{id}', [RestaurantCategoryController::class, 'update'])->name('restaurantCategory.update');
});



Route::middleware(['auth','role:admin'])->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/', [FoodCategoryController::class, 'index'])->name('category.index');
        Route::get('{id}', [FoodCategoryController::class, 'show'])->name('category.show');
        Route::delete('{id}', [FoodCategoryController::class, 'destroy'])->name('category.delete');

        Route::get('food/create', [FoodCategoryController::class, 'create'])->name('category.create');
        Route::post('create', [FoodCategoryController::class, 'store'])->name('category.store');

        Route::get('{id}/edit', [FoodCategoryController::class, 'edit'])->name('category.edit');
        Route::put('update/{id}', [FoodCategoryController::class, 'update'])->name('category.update');
    });
});


Route::prefix('foodParty')->middleware(['auth' , 'role:admin'])->group(function () {
    Route::get('/', [FoodPartyController::class, 'index'])->name('foodParty.index');
    Route::get('{id}', [FoodPartyController::class, 'show'])->name('foodParty.show');
    Route::delete('{id}', [FoodPartyController::class, 'destroy'])->name('foodParty.delete');

    Route::get('food/create', [FoodPartyController::class, 'create'])->name('foodParty.create');
    Route::post('create', [FoodPartyController::class, 'store'])->name('foodParty.store');

    Route::get('{id}/edit', [FoodPartyController::class, 'edit'])->name('foodParty.edit');
    Route::put('update/{id}', [FoodPartyController::class, 'update'])->name('foodParty.update');
});


//Route::get('dashboard' , [\App\Http\Controllers\TestController::class , 'index'])->middleware(['role:admin'])->name('admin.dashboard');
Route::get('dashboard' , [\App\Http\Controllers\UserController::class , 'adminIndex'])->middleware(['role:admin'])->name('admin.dashboard');
