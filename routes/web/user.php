<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;



//Route::get('order' , [OrderController::class , 'getOrder'])->middleware(['auth' , 'role:seller'])->name('order.getOrder');
//Route::get('order/all' , [OrderController::class , 'getOrders'])->middleware(['auth' , 'role:seller'])->name('order.getOrders');
//Route::put('order/update' , [OrderController::class , 'getOrders'])->middleware(['auth' , 'role:seller'])->name('order.update');


//Route::prefix('order')->middleware(['auth'])->group(function () {
Route::prefix('orders')->middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/{order}/{newStatus}', [OrderController::class, 'update'])->name('orders.update');
});
