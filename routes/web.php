<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodPartyController;
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


//Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
//Route::post('login', [AuthController::class, 'login'])->name('login');
//Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
//Route::post('register', [AuthController::class, 'register'])->name('register');

Route::prefix('auth')->middleware('auth')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});




Route::prefix('category')->group(function () {
    Route::get('/', [FoodCategoryController::class, 'index'])->name('category.index');
    Route::get('{id}', [FoodCategoryController::class, 'show'])->name('category.show');
    Route::delete('{id}', [FoodCategoryController::class, 'destroy'])->name('category.delete');

    Route::get('food/create', [FoodCategoryController::class, 'create'])->name('category.create');
    Route::post('create', [FoodCategoryController::class, 'store'])->name('category.store');

    Route::get('{id}/edit', [FoodCategoryController::class, 'edit'])->name('category.edit');
    Route::put('update/{id}', [FoodCategoryController::class, 'update'])->name('category.update');
});


Route::prefix('foods')->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('food.index');
    Route::get('{id}', [FoodController::class, 'show'])->name('food.show');
    Route::delete('{id}', [FoodController::class, 'destroy'])->name('food.delete');

    Route::get('food/create', [FoodController::class, 'create'])->name('food.create');
    Route::post('create', [FoodController::class, 'store'])->name('food.store');

    Route::get('{id}/edit', [FoodController::class, 'edit'])->name('food.edit');
    Route::put('update/{id}', [FoodController::class, 'update'])->name('food.update');
});

Route::prefix('foodParty')->group(function () {
    Route::get('/', [FoodPartyController::class, 'index'])->name('foodParty.index');
    Route::get('{id}', [FoodPartyController::class, 'show'])->name('foodParty.show');
    Route::delete('{id}', [FoodPartyController::class, 'destroy'])->name('foodParty.delete');

    Route::get('food/create', [FoodPartyController::class, 'create'])->name('foodParty.create');
    Route::post('create', [FoodPartyController::class, 'store'])->name('foodParty.store');

    Route::get('{id}/edit', [FoodPartyController::class, 'edit'])->name('foodParty.edit');
    Route::put('update/{id}', [FoodPartyController::class, 'update'])->name('foodParty.update');
});

Route::prefix('discount')->group(function () {
    Route::get('/', [DiscountController::class, 'index'])->name('discount.index');
    Route::get('{id}', [DiscountController::class, 'show'])->name('discount.show');
    Route::delete('{id}', [DiscountController::class, 'destroy'])->name('discount.delete');

    Route::get('food/create', [DiscountController::class, 'create'])->name('discount.create');
    Route::post('create', [DiscountController::class, 'store'])->name('discount.store');

    Route::get('{id}/edit', [DiscountController::class, 'edit'])->name('discount.edit');
    Route::put('update/{id}', [DiscountController::class, 'update'])->name('discount.update');
});
