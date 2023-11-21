<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrder()
    {
        dd('getOrder');
    }

    public function getOrders()
    {
        $order = Order::query()
            ->where('user_id' , auth()->user()->id)
            ->orderBy('created_at')
            ->get();

    }

    public function update()
    {
        dd('update');
    }

}
