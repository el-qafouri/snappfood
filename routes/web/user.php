<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;



//Route::get('order' , [OrderController::class , 'getOrder'])->middleware(['auth' , 'role:seller'])->name('order.getOrder');
//Route::get('order/all' , [OrderController::class , 'getOrders'])->middleware(['auth' , 'role:seller'])->name('order.getOrders');
//Route::put('order/update' , [OrderController::class , 'getOrders'])->middleware(['auth' , 'role:seller'])->name('order.update');


Route::prefix('order')->middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/', [OrderController::class, 'getOrder'])->name('order.getOrder');
    Route::get('/all', [OrderController::class, 'getOrders'])->name('order.getOrders');
    Route::put('/update', [OrderController::class, 'getOrders'])->name('order.update');
});
