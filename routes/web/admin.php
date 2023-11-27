<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodPartyController;
use App\Http\Controllers\RestaurantCategoryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



//Route::middleware(['auth'])->group(function () {
//    Route::get('dashboard/admin', [UserController::class ,'dashboard'])->name('admin.dashboard');
//});

Route::get('dashboard' , [UserController::class , 'adminIndex'])->middleware(['role:admin'])->name('admin.dashboard');



//restaurantCategory
Route::prefix('restaurantCategory')->middleware(['auth','role:admin'])->group(function () {
Route::get('/', [RestaurantCategoryController::class, 'index'])->name('restaurantCategory.index');
Route::get('{id}', [RestaurantCategoryController::class, 'show'])->name('restaurantCategory.show');
Route::delete('{id}', [RestaurantCategoryController::class, 'destroy'])->name('restaurantCategory.delete');

Route::get('restaurantCategory/create', [RestaurantCategoryController::class, 'create'])->name('restaurantCategory.create');
Route::post('create', [RestaurantCategoryController::class, 'store'])->name('restaurantCategory.store');

Route::get('{id}/edit', [RestaurantCategoryController::class, 'edit'])->name('restaurantCategory.edit');
Route::put('update/{id}', [RestaurantCategoryController::class, 'update'])->name('restaurantCategory.update');
});

//banners
Route::prefix('banners')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('banner.index');
    Route::delete('{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
    Route::get('banner/create', [BannerController::class, 'create'])->name('banner.create');
    Route::get('/{id}', [BannerController::class, 'show'])->name('banner.show');
    Route::post('create', [BannerController::class, 'store'])->name('banner.store');
    Route::get('{id}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('update/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::get('/get-banners', [BannerController::class, 'getBanners'])->name('get.banners');

});


// food category
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

//food party
Route::prefix('foodParty')->middleware(['auth' , 'role:admin'])->group(function () {
    Route::get('/', [FoodPartyController::class, 'index'])->name('foodParty.index');
    Route::get('{id}', [FoodPartyController::class, 'show'])->name('foodParty.show');
    Route::delete('{id}', [FoodPartyController::class, 'destroy'])->name('foodParty.delete');

    Route::get('food/create', [FoodPartyController::class, 'create'])->name('foodParty.create');
    Route::post('create', [FoodPartyController::class, 'store'])->name('foodParty.store');

    Route::get('{id}/edit', [FoodPartyController::class, 'edit'])->name('foodParty.edit');
    Route::put('update/{id}', [FoodPartyController::class, 'update'])->name('foodParty.update');
});




