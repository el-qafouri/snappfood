<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Food;
use App\Models\Order;
use http\Env\Response;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class OrderController extends Controller
{
//    public function getOrder()
//    {
////        dd('getOrder');
//        $order = Order::query()->find($id);
//        if (\Illuminate\Support\Facades\Gate::allows('view' , $order))
//            return \response(new OrderResource($order));
//        else return \response(['message'=>'this is not your order']);
//
//    }




    public function getOrder($id)
    {
        try {
            $order = Order::findOrFail($id);

            if (\Illuminate\Support\Facades\Gate::allows('view', $order)) {
                return \response(new OrderResource($order));
            } else {
                return \response(['message' => 'This is not your order'], 403);
            }
        } catch (ModelNotFoundException $e) {
            return \response(['message' => 'Order not found'], 404);
        } catch (\Exception $e) {
            return \response(['message' => $e->getMessage()], 500);
        }
    }









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
