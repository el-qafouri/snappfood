<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;





//Route::prefix('order')->middleware(['auth'])->group(function () {
Route::prefix('orders')->middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/{order}/{newStatus}', [OrderController::class, 'update'])->name('orders.update');
    Route::put('/archive', [OrderController::class, 'archive'])->name('orders.archive');
    Route::get('/filter/{status}' , [OrderController::class , 'filterOrders'])->name('orders.filter');
});

