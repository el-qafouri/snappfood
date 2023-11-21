<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrder()
    {
        dd('getOrder');
    }

//    public function getOrders()
//    {
//        $order = Order::query()
//            ->where('restaurant_id' , auth()->user()->id)
//            ->orderBy('created_at')
//            ->get();
//        dd($order);
//            return response(OrderResource::collection($order));
//    }


//    public function getOrders()
//    {
//        $orders = Order::query()
//            ->where('user_id', auth()->user()->id)
//            ->orderBy('created_at')
//            ->get();
//
//        if ($orders->count() > 0) {
//            return response(OrderResource::collection($orders));
//        } else {
//            return response(['Message' => 'No orders found for this restaurant.']);
//        }
//    }


    public function getOrders()
    {
        try {
            $orders = Order::query()
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'asc')
                ->get();
            if ($orders->isEmpty()) {
                throw new \Exception("No orders found for this restaurant.");
            }
            return response(OrderResource::collection($orders));
        } catch (\Exception $e) {
            return response(['Message' => $e->getMessage()], 404);
        }
    }


    public function update()
    {
        dd('update');
    }

}
