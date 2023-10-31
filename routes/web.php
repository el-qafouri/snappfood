<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodCategoryController;
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


Route::get('category', [FoodCategoryController::class, 'index'])->name('category.index');
Route::get('category/show', [FoodCategoryController::class, 'show'])->name('category.show');
Route::delete('category/{id}', [FoodCategoryController::class, 'destroy'])->name('category.delete');
Route::get('category/create', [FoodCategoryController::class, 'create'])->name('category.create');
Route::post('category/create', [FoodCategoryController::class, 'create'])->name('category.create');
Route::get('category/store', [FoodCategoryController::class, 'store'])->name('category.store');
Route::post('category/store', [FoodCategoryController::class, 'store'])->name('category.store');
Route::get('category/{id}/edit', [FoodCategoryController::class, 'edit'])->name('category.edit');
Route::put('category/update/{id}', [FoodCategoryController::class, 'update'])->name('category.update');

