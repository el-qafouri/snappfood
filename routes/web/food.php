<?php


use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;


Route::prefix('foods')->middleware(['auth' ,'role:seller|admin'])->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('food.index');
    Route::get('{id}', [FoodController::class, 'show'])->name('food.show');
    Route::delete('{id}', [FoodController::class, 'destroy'])->name('food.delete');

    Route::get('food/create', [FoodController::class, 'create'])->name('food.create');
    Route::post('create', [FoodController::class, 'store'])->name('food.store');

    Route::get('{id}/edit', [FoodController::class, 'edit'])->name('food.edit');
    Route::put('update/{id}', [FoodController::class, 'update'])->name('food.update');
});


Route::middleware('role:admin|seller')->resource('discount', DiscountController::class)->except(['create', 'store']);
//Route::get('discount/create', [DiscountController::class, 'create'])->name('discount.create');
//Route::post('discount', [DiscountController::class, 'store'])->name('discount.store');
