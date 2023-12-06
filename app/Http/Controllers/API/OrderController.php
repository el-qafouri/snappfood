<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController
{
    public function getCard($id)
    {
        $order = Order::query()->find($id);
        return response($order);
    }


    public function getCards()
    {
        $orders = Order::query()
            ->with('foods')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at')->get();
        return response()->json($orders);
    }


    public function add(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'count' => 'required|integer|min:1',
        ]);

        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'food_id' => $request->food_id,
            'restaurant_id' => Food::find($request->food_id)->restaurant->id,
//            'count' => $request->count,
            'payment_status' => 'unpaid',
        ]);


        $cart->foods()->attach($request->food_id, ['count' => $request->count]);

//        dd('hi');

//        try {
//            $cart = Cart::create([
//                'user_id' => auth()->user()->id,
//                'food_id' => $request->food_id,
//                'count' => $request->count,
//                'payment_status' => 'unpaid',
//            ]);
//
//            $cart->foods()->attach([
//               'food_id'=>$request->food_id,
////               'cart_id'=>$cart->id,
//               'count'=>$request->count ,
//            ]);
//            return response(['message' => 'Order placed successfully', 'cart_iD' => $cart->id]);
//        } catch (\Exception $e) {
//            \Log::error('An unexpected error occurred: ' . $e->getMessage());
//            return response(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
//        }
    }


    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'food_id' => ['required',],
            'count' => 'required|integer|min:1'
        ]);

        $cart->foods()->attach($request->food_id, ['count' => $request->count]);

//
//        $order = Order::query()->where(['restaurant_id' => Food::query()->find($request->food_id)->restaurant->id,
//            'user_id' => auth()->user()->id, 'payment_status' => 'unpaid'])->first();
//        if ($order == null) return \response(['Message' => "You don't have unpaid card"]);
//
//        $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
//        if (!in_array($request->food_id, $foods)) return response("this food isn't added yet");
//
//        $pivot = $order->foods->first()->pivot->where('food_id', $request->food_id)->first();
//        $food_id = $pivot->food_id;
//        $oldCount = $pivot->count;
//        $pivot->count = $request->count;
//        $pivot->save();

//        $order->total_price += ((Food::query()->find($food_id)->discount * $request->count)
//            - (Food::query()->find($food_id)->discount * $oldCount));
//        $order->save();

        return response(['message' => 'cart updated']);
    }


    public function payCard($id)
    {
        $cart = Cart::query()->find($id);
        if ($cart == null)
            return response(['Message' => "this isn't your cart"]);

        $cart->payment_status = 'paid';
        $cart->save();

            $newOrder = Order::create([
                'user_id' => $cart->user_id,
                'food_id' => $cart->food_id,
                'restaurant_id' => $cart->restaurant_id,
                'payment_status' => 'paid',
//                'total_price' => $cart->foods->map(fn($food) => $food->price * (100 - $food->discount === null ? 0 : $food->discount->discount) / 100)->sum(),
                'total_price' => $cart->foods->map(fn($food) => $food->price)->sum(),
            ]);

        foreach ($cart->foods as $food) {
            $newOrder->foods()->attach($food->id, ['count' => $food->pivot->count]);
        }

        return response(['Message' => "cart number $id paid successfully"]);
    }


//    public function completeOrder($id)
//    {
//        DB::beginTransaction();
//
//        try {
//            $cartOrder = Cart::with(['food.restaurant'])->where('id', $id)->where('payment_status', 'paid')->firstOrFail();
//
//            $totalPrice = $cartOrder->food ? $cartOrder->food->price * $cartOrder->count : 0;
//            $restaurantId = optional(optional($cartOrder->food)->restaurant)->id;
//            $newOrder = Order::create([
//                'user_id' => $cartOrder->user_id,
//                'food_id' => $cartOrder->food_id,
//                'count' => $cartOrder->count,
//                'restaurant_id' => $restaurantId,
//                'payment_status' => 'paid',
//                'total_price' => $totalPrice,
//            ]);
//
//            $cartOrder->delete();
//
//            DB::commit();
//
//            return response(['Message' => "Order number $id transferred to orders successfully."]);
//        } catch (\Exception $e) {
//            DB::rollBack();
//            \Log::error("Error completing order: " . $e->getMessage());
//
//            return response(['Message' => 'An unexpected error occurred while transferring the order: ' . $e->getMessage()], 500);
//        }
//    }


}
