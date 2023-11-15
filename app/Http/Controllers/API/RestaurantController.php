<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RestaurantController extends Controller
{

    public function index(Request $request)
    {
        $restaurants = Restaurant::all();
        return response(['Restaurants' => $restaurants]);
    }


    public function show($id)
    {
        $restaurant_IDs = Restaurant::all()->pluck('id')->toArray();
        if (!in_array($id, $restaurant_IDs)) return \response(['Message' => "'This restaurant isn't exist"]);

        return \response(["Restaurants number $id details:" => (Restaurant::query()->find($id))]);
    }


    //فقط قیمت هارو میداد
//    public function food($id)
//    {
//        $restaurant = Restaurant::query()->find($id);
//        if (!$restaurant) {
//            return response(['Message' => "This restaurant doesn't exist"], 404);
//        }
//        $foods = $restaurant->foods;
//        return response(["Foods details of restaurant number $id" => $foods]);
//    }

    public function food($id)
    {
        try {
            $restaurant = Restaurant::query()->findOrFail($id);
            $foods = $restaurant->foods;
            $foodDetails = [];
            foreach ($foods as $food) {
                $foodDetails[] = [
                    'name' => $food->name,
                    'price' => $food->price,
                    'final_price' => $food->final_price,
                ];
            }

            return response(["Foods details of restaurant number $id" => $foodDetails]);
        } catch (\Exception $e) {
            \Log::error('Database error: ' . $e->getMessage());

            return response(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


}


