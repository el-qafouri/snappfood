<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
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


Route::get('login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('register', [AuthController::class, 'register'])->name('register');



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
