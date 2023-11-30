<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


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

//این ادد کار میکنه ولی میخوام سبد خرید در بیارم
//    public function add(Request $request)
//    {
//        $request->validate([
//            'food_id' => 'required',
//            'count' => 'required|integer|min:1',
//        ]);
//
//        try {
//            $food = Food::query()->find($request->food_id);
//
//            if (!$food) {
//                return response(['Message' => 'Food not found.'], 404);
//            }
//
//            $order = Order::query()->where([
//                'user_id' => auth()->user()->id,
//                'restaurant_id' => $food->restaurant->id,
//                'customer_status' => 'unpaid',
//            ])->first();
//            $discounts = $food->discounts;
////            $discountAmount = $food->discounts->sum('discount_amount');
//            $discountAmount = $discounts ? $discounts->sum('discountAmount') : 0;
//            $foodPrice = $discountAmount * $request->count;
//
//            if ($order) {
//                $existingFood = $order->foods->find($request->food_id);
//
//                if ($existingFood) {
//                    $existingFood->pivot->count += $request->count;
//                    $existingFood->pivot->save();
//                } else {
//                    $order->foods()->attach($food, ['count' => $request->count]);
//                }
//
//                $order->total_price += $foodPrice;
//                $order->save();
//            } else {
//                $order = Order::query()->create([
//                    'user_id' => auth()->user()->id,
//                    'restaurant_id' => $food->restaurant->id,
//                    'total_price' => $foodPrice,
//                    'total_amount' => $foodPrice,
//                ]);
//
//                $order->foods()->attach($food, ['count' => $request->count]);
//            }
//
//            return response(['Message' => 'Food added to cart successfully', 'Cart ID' => $order->id]);
//        } catch (\Exception $e) {
//            \Log::error('An unexpected error occurred: ' . $e->getMessage());
//            return response(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
//        }
//    }





    public function add(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'count' => 'required|integer|min:1',
        ]);

        try {
            $food = Food::query()->find($request->food_id);

            if (!$food) {
                return response(['Message' => 'Food not found.'], 404);
            }

            $discounts = $food->discounts;
            $discountAmount = $discounts ? $discounts->sum('discountAmount') : 0;
            $foodPrice = $discountAmount * $request->count;

            $order = Order::query()->where([
                'user_id' => auth()->user()->id,
                'restaurant_id' => $food->restaurant->id,
                'customer_status' => 'unpaid',
            ])->first();

            if ($order) {
                $existingFood = $order->foods->find($request->food_id);

                if ($existingFood) {
                    $existingFood->pivot->count += $request->count;
                    $existingFood->pivot->save();
                } else {
                    $order->foods()->attach($food, ['count' => $request->count]);
                }

                $order->total_price += $foodPrice;
                $order->save();
            } else {
                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'restaurant_id' => $food->restaurant->id,
                    'total_price' => $foodPrice,
                    // سایر فیلدها...
                ]);

                $order->foods()->attach($food, ['count' => $request->count]);
            }

            return response(['Message' => 'Food added to cart successfully', 'Order ID' => $order->id]);
        } catch (\Exception $e) {
            \Log::error('An unexpected error occurred: ' . $e->getMessage());
            return response(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }



    public function update(Request $request)
    {
        $request->validate([
            'food_id' => ['required',],
            'count' => 'required|integer|min:1'
        ]);

        $order = Order::query()->where(['restaurant_id' => Food::query()->find($request->food_id)->restaurant->id,
            'user_id' => auth()->user()->id, 'customer_status' => 'unpaid'])->first();
        if ($order == null) return \response(['Message' => "You don't have unpaid card"]);

        $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
        if (!in_array($request->food_id, $foods)) return response("this food isn't added yet");

        $pivot = $order->foods->first()->pivot->where('food_id', $request->food_id)->first();
        $food_id = $pivot->food_id;
        $oldCount = $pivot->count;
        $pivot->count = $request->count;
        $pivot->save();

        $order->total_price += ((Food::query()->find($food_id)->discount * $request->count)
            - (Food::query()->find($food_id)->discount * $oldCount));
        $order->save();

        return response(['Message' => 'count of food is updated']);
    }

//    public function payCard($id)
//    {
//        $order = Order::query()->find($id);
//        if ($order == null)
//            return response(['Message' => "this isn't your cart"]);
//
//        $order->customer_status = 'paid';
//        $order->save();
//        return response(['Message' => "cart number $id paid successfully"]);
//    }

//این دوتا پی کارد کار میکنن ولی میخوام سبد خرید در بیارم

//    public function payCard($id)
//    {
//        try {
//            $order = Order::find($id);
//
//            if (!$order) {
//                return response(['Message' => "This isn't a valid cart."], 404);
//            }
//
//            if ($order->user_id != auth()->user()->id) {
//                return response(['Message' => "You don't have permission to pay for this cart."], 403);
//            }
//
//            if ($order->customer_status == 'paid') {
//                return response(['Message' => "This cart has already been paid."], 400);
//            }
//
//            $order->customer_status = 'paid';
//            $order->seller_status = 'paid';
//            $order->save();
//
//
//            return response(['Message' => "Cart number $id paid successfully"]);
//        } catch (\Exception $e) {
//            \Log::error('An unexpected error occurred: ' . $e->getMessage());
//            return response(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
//        }
//    }





}
