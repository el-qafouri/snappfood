<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Models\Restaurant;
use App\Notifications\OrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class OrderController extends Controller
{

    public function show(Order $order)
    {
        return view('Mail.show', ['order' => $order]);
    }


    public function index(Request $request)
    {
        try {
            $restaurantId = Restaurant::query()->where('user_id', auth()->user()->id)->value('id');

            $orders = Order::query()->where('restaurant_id', $restaurantId)->where('seller_status', '!=' , 'delivered')->orderBy('created_at')->get();
            if ($request->has('seller_status')){
                $orders = $orders->filter(function ($order){
                   return $order->seller_status === \request()->get('seller_status');
                });
            }


//            $index = 0;
//            if ($request->filter == 'lastWeek') {
//                foreach ($orders as $order) {
//                    if (Carbon::now()->diff($order->created_at)->days > 7) {
//                        unset($orders[$index]);
//                    }
//                    $index++;
//                }
//            } elseif ($request->filter == 'lastMonth') {
//                foreach ($orders as $order) {
//                    if (Carbon::now()->diff($order->created_at)->days > 30) {
//                        unset($orders[$index]);
//                    }
//                    $index++;
//                }
//            } elseif ($request->filter == 'lastYear') {
//                foreach ($orders as $order) {
//                    if (Carbon::now()->diff($order->created_at)->days > 365) {
//                        unset($orders[$index]);
//                    }
//                    $index++;
//                }
//            }
            return view('Mail.order', ['orders' => $orders]);
        } catch (QueryException $e) {
            return response(['Message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response(['Message' => $e->getMessage()], 500);
        }
    }


    public function update(Order $order, $newStatus)
    {

//        dd('hi hi');
        $order->update(['seller_status' => $newStatus]);
        \Illuminate\Support\Facades\Notification::send($order->user, new OrderStatus($order, $newStatus));
//        if ($newStatus == 'delivered'){
//
//        }
        return redirect()->route('orders.index')->with('success', "Order has been updated to new status: {$newStatus}");

    }


    public function archive()
    {
        $user = auth()->user();
        $restaurantId = $user->restaurant->id;
        $deliverOrders = Order::query()->where('seller_status', 'delivered')->where('restaurant_id', $restaurantId)->get();
        return view('panel.seller.panel.archive' , compact('deliverOrders'));
    }




}