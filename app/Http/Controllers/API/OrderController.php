<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
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




//    public function add(Request $request)
//    {
//        $request->validate([
//            'food_id' => ['required', Rule::exists('food', 'id')],
//            'count' => 'required|integer|min:1'
//        ]);
//
//        $order = Order::where([
//            'user_id' => auth()->user()->id,
//            'restaurant_id' => Food::query()->find($request->food_id)->restaurant->id, 'customer_status' => 'unpaid'])->first();
//
//        if ($order){
//            $foods = $order->foods->pluck('id')->toArray();
//            if (in_array($request->food_id, $foods)){
//                return response(['Message' => 'This food is exist to your card already']);
//            }
//            else{
//                $order->foods()->attach(['food_id' => $request->food_id], ['count' => $request->count]);
//
//                $totalPrice = $order->total_price;
//                $order->total_price = $totalPrice + Food::find($request->food_id)->final_price * $request->count;
//                $order->save();
//            }
//        }
//
//        else {
//            $order = Order::create([
//                'user_id' => auth()->user()->id,
//                'restaurant_id' => Food::find($request->food_id)->restaurant->id,
//                'total_price' => Food::find($request->food_id)->final_price * $request->count
//            ]);
//
//            $order->foods()->attach(['food_id' => $request->food_id], ['count' => $request->count]);
//        }
//        return response(['Message' => 'Food added to card successfully', 'Cart ID' => $order->id]);
//    }
//

/*
    public function add(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'count' => 'required|integer|min:1',
        ]);

        $food = Food::query()->find($request->food_id);
        $order = Order::query()->where([
            'user_id' => auth()->user()->id,
            'restaurant_id' => $food->restaurant->id,
            'customer_status' => 'unpaid',
        ])->first();

        $foodId = $food->id;
        $discount = Discount::query()->where('food_id', $foodId)->first();

        $discountAmount = $discount ? $discount->discount_amount : 0;
        $foodPrice = $discountAmount * $request->count;


        if ($discount) {
            $discountAmount = $discount->discount_amount;
        } else {
            $discountAmount = 0;
        }

        $foodPrice = $discountAmount * $request->count;

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
            $order = Order::query()->create([
                'user_id' => auth()->user()->id,
                'restaurant_id' => $food->restaurant->id,
                'total_amount' => $foodPrice,
            ]);

            $order->foods()->attach($food, ['count' => $request->count]);
        }

        return response(['Message' => 'Food added to cart successfully', 'Cart ID' => $order->id]);
    }
*/


//    public function add(Request $request)
//    {
//        $request->validate([
//            'food_id' => 'required',
//            'count' => 'required|integer|min:1',
//        ]);
//
//        $food = Food::query()->find($request->food_id);
//        $order = Order::query()->where([
//            'user_id' => auth()->user()->id,
//            'restaurant_id' => $food->restaurant->id,
//            'customer_status' => 'unpaid',
//        ])->first();
//
//        $discountAmount = $food->discounts->sum('discount_amount');
//        $foodPrice = $discountAmount * $request->count;
//
//        $foodId = $food->id;
//        $discount = Discount::query()->where('food_id', $foodId)->first();
//
//        $discountAmount = $discount ? $discount->discount_amount : 0;
//        $foodPrice = $discountAmount * $request->count;
//
//        if ($discount) {
//            $discountAmount = $discount->discount_amount;
//        } else {
//            $discountAmount = 0;
//        }
//
//        $foodPrice = $discountAmount * $request->count;
//
//        if ($order) {
//            $existingFood = $order->foods->find($request->food_id);
//
//            if ($existingFood) {
//                $existingFood->pivot->count += $request->count;
//                $existingFood->pivot->save();
//            } else {
//                $order->foods()->attach($food, ['count' => $request->count]);
//            }
//
//            $order->total_price += $foodPrice;
//            $order->save();
//        } else {
//            $order = Order::query()->create([
//                'user_id' => auth()->user()->id,
//                'restaurant_id' => $food->restaurant->id,
//                'total_price' => $foodPrice,
//                'total_amount' => $foodPrice,
//            ]);
//
//            $order->foods()->attach($food, ['count' => $request->count]);
//        }
//
//        return response(['Message' => 'Food added to cart successfully', 'Cart ID' => $order->id]);
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

            $order = Order::query()->where([
                'user_id' => auth()->user()->id,
                'restaurant_id' => $food->restaurant->id,
                'customer_status' => 'unpaid',
            ])->first();
                $discounts = $food->discounts;
            // Calculate discount amount based on food's discounts
//            $discountAmount = $food->discounts->sum('discount_amount');
            $discountAmount = $discounts ? $discounts->sum('discountAmount') :0;
            $foodPrice = $discountAmount * $request->count;

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
                $order = Order::query()->create([
                    'user_id' => auth()->user()->id,
                    'restaurant_id' => $food->restaurant->id,
                    'total_price' => $foodPrice,
                    'total_amount' => $foodPrice,
                ]);

                $order->foods()->attach($food, ['count' => $request->count]);
            }

            return response(['Message' => 'Food added to cart successfully', 'Cart ID' => $order->id]);
        } catch (\Exception $e) {
            \Log::error('An unexpected error occurred: ' . $e->getMessage());
            return response(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }





    public function  update(Request $request)
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

    public function payCard($id)
    {
        $order = Order::query()->find($id);
        if ($order == null)
            return response(['Message' => "this isn't your cart"]);

        $order->customer_status = 'paid';
        $order->save();
        return response(['Message' => "cart number $id paid successfully"]);
    }

}
