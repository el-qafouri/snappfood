<?php


use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;


//Route::prefix('foods')->group(function () {
Route::prefix('foods')->middleware(['auth' , 'role:seller'])->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('food.index');
    Route::get('{id}' , [FoodController::class , 'show'])->name('food.show');
    Route::delete('{id}', [FoodController::class, 'destroy'])->name('food.delete');

    Route::get('food/create', [FoodController::class, 'create'])->name('food.create');
        Route::post('create' , [FoodController::class , 'store'])->name('food.store');

    Route::get('{id}/edit', [FoodController::class, 'edit'])->name('food.edit');
    Route::put('update/{id}', [FoodController::class, 'update'])->name('food.update');

});

//Route::middleware('role:admin|seller')->resource('discount', DiscountController::class)->except(['create', 'store']);
//Route::get('discount/create', [DiscountController::class, 'create'])->name('discount.create');
//Route::post('discount', [DiscountController::class, 'store'])->name('discount.store');


Route::prefix('discount')->middleware('auth')->group(function () {
    Route::get('/', [DiscountController::class, 'index'])->name('discount.index');
    Route::get('{id}', [DiscountController::class, 'show'])->name('discount.show');
    Route::delete('{id}', [DiscountController::class, 'destroy'])->name('discount.delete');

    Route::get('discount/create', [DiscountController::class, 'create'])->name('discount.create');
    Route::post('create', [DiscountController::class, 'store'])->name('discount.store');

    Route::get('{id}/edit', [DiscountController::class, 'edit'])->name('discount.edit');
    Route::put('update/{id}', [DiscountController::class, 'update'])->name('discount.update');
});


Route::prefix('comment')->middleware('auth')->group(function () {
    Route::post('/{id}/answer',[CommentController::class , 'answerComment'])->name('comment.answer');
    Route::post('/{id}/accept', [CommentController::class , 'acceptComment'])->name('comment.accept');
    Route::delete('/{id}/delete', [CommentController::class , 'deleteComment'])->name('comment.delete');
});
