<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\api\OrderRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController
{
    public function getCard($id)
    {
        $cart = Cart::query()->find($id);
        return response()->json(['cart' => new CartResource($cart)]);
    }


    public function getCards()
    {
        $carts = Cart::query()
            ->with('foods')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at')->get();
        return response()->json(['carts' => CartResource::collection($carts)]);
    }


    public function add(OrderRequest $request)
    {

        $cart = Cart::query()->create([
            'user_id' => auth()->user()->id,
            'food_id' => $request->food_id,
            'restaurant_id' => Food::query()->find($request->food_id)->restaurant->id,
            'payment_status' => 'unpaid',
        ]);

        $cart->foods()->attach($request->food_id, ['count' => $request->count]);

    }


    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'food_id' => ['required',],
            'count' => 'required|integer|min:1'
        ]);

        $cart->foods()->attach($request->food_id, ['count' => $request->count]);

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

        return response(['message' => "cart number $id paid successfully"]);
    }


}
