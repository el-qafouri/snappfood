<?php

use App\Http\Controllers\seller\CommentController;
use App\Http\Controllers\seller\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/seller', [UserController::class, 'dashboard'])->name('seller.dashboard');
//    Route::get('/dashboard', [UserController::class, 'sellerIndex'])->name('admin.dashboard');
});


Route::prefix('restaurants')->group(function () {
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

Route::get('/create', [RestaurantController::class, 'create'])->name('restaurant.create');

Route::post('/', [RestaurantController::class, 'store'])->name('restaurant.store');

Route::get('/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::patch('/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');

Route::delete('/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurant.delete');

    Route::get('/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit');
//    Route::put('/{restaurant}', [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::get('/location', [RestaurantController::class, 'getLocation'])->name('restaurant.location');
    Route::post('/location', [RestaurantController::class, 'getLocation'])->name('restaurant.location');
    Route::post('/location/set', [RestaurantController::class, 'setLocation'])->name('restaurant.setLocation');

    Route::get('location/edit', [RestaurantController::class, 'editLocation'])->name('restaurant.editLocation');
    Route::put('location/edit', [RestaurantController::class, 'editLocation'])->name('restaurant.edit.Location');
    Route::put('location/update', [RestaurantController::class, 'updateLocation'])->name('restaurant.updateLocation');

});

//comments
Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index'])->name('comments.index');
    Route::put('/{comment}/{status}', [CommentController::class, 'update'])->name('comments.update');
    Route::get('/create/{comment}', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/{comment}', [CommentController::class, 'store'])->name('comments.store');
});


//Route::prefix('restaurant')->middleware(['auth', 'role:admin'])->group(function () {
//    // Routes for sellers
//    Route::get('{id}', [RestaurantController::class, 'show'])->name('restaurantSeller.show');
//    // ...
//});


Route::prefix('restaurant')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/{id}/editProfileStatus', [RestaurantController::class, 'editProfileStatus'])->name('restaurant.editProfileStatus');
    Route::patch('/{id}', [RestaurantController::class, 'updateProfileStatus'])->name('restaurant.updateProfileStatus');
});



