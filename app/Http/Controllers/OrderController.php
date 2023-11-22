<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Jobs\SendEmailJob;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
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
            $order = Order::query()->findOrFail($id);

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


/*
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
*/







    public function getOrders(Request $request)
    {
        try {
            $restaurantId = Restaurant::query()->where('user_id', auth()->user()->id)->value('id');

            $orders = Order::query()->where('restaurant_id', $restaurantId)->orderBy('created_at')->get();
            $index = 0;

            if ($request->filter == 'lastWeek') {
                foreach ($orders as $order) {
                    if (Carbon::now()->diff($order->created_at)->days > 7) {
                        unset($orders[$index]);
                    }
                    $index++;
                }
            } elseif ($request->filter == 'lastMonth') {
                foreach ($orders as $order) {
                    if (Carbon::now()->diff($order->created_at)->days > 30) {
                        unset($orders[$index]);
                    }
                    $index++;
                }
            } elseif ($request->filter == 'lastYear') {
                foreach ($orders as $order) {
                    if (Carbon::now()->diff($order->created_at)->days > 365) {
                        unset($orders[$index]);
                    }
                    $index++;
                }
            }
            return view('Mail.order', ['orders' => $orders]);
        } catch (QueryException $e) {
            return response(['Message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response(['Message' => $e->getMessage()], 500);
        }
    }

















//    public function update()
//    {
//
//    }

    public function update(Request $request)
    {
        try {
            $order = Order::query()->find($request->id);
            dd($order);
            if (!$order) {
                throw new \Exception('Order not found');
            }

            $sellerStatus = $order->seller_status;

            if ($sellerStatus == 'pending') {
                $order->seller_status = 'preparing';
            } elseif ($sellerStatus == 'preparing') {
                $order->seller_status = 'send';
            } elseif ($sellerStatus == 'send') {
                $order->seller_status = 'delivered';
            }

            $order->save();

            SendEmailJob::dispatch($order);

            return redirect()->route('order.getOrder');
        } catch (\Exception $e) {
            return \response(['message' => $e->getMessage()], 500);
        }
    }


// php artisan make:notification Sssss

}
