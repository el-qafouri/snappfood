<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Food;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RestaurantController extends Controller
{

//    public function index(Request $request)
//    {
//        $restaurants = Restaurant::all();
//        return response(['Restaurants' => $restaurants]);
//    }


    public function index()
    {
        $user = Auth::user();

        $userActiveAddress = $user->addresses()->where('active', 1)->first();

        if (is_null($userActiveAddress)) {
            return response()->json(['error' => 'هیچ آدرس فعالی برای کاربر یافت نشد.'], 404);
        }

        $userLatitude = (double)$userActiveAddress->latitude;
        $userLongitude = (double)$userActiveAddress->longitude;

        $restaurantsWithDistance = DB::table('restaurants')
            ->join('addresses', function ($join) {
                $join->on('restaurants.id', '=', 'addresses.addressable_id')
                    ->where('addresses.addressable_type', '=', 'App\Models\User')
                    ->where('addresses.active', '=', 1);
            })
            ->select(
                'restaurants.*',
                'addresses.latitude',
                'addresses.longitude',
                DB::raw("6371 * acos(
                cos(radians(" . $userLatitude . ")) *
                cos(radians(addresses.latitude)) *
                cos(radians(addresses.longitude) - radians(" . $userLongitude . ")) +
                sin(radians(" . $userLatitude . ")) *
                sin(radians(addresses.latitude))
            ) AS distance")
            )
            ->orderBy('distance', 'asc')
            ->get();
//dd($restaurantsWithDistance);

        $transformedRestaurants = $restaurantsWithDistance->map(function ($restaurant) {
            return [
                'id' => $restaurant->id,
                'title' => $restaurant->restaurant_name,
                'address' => [
                    'address' => $restaurant->address,
                    'latitude' => (float)$restaurant->latitude,
                    'longitude' => (float)$restaurant->longitude,
                ],
                'distance' => $restaurant->distance
            ];
        });

        return response()->json($transformedRestaurants->values()->all());


    }






//    public function show($id)
//    {
//        $restaurant_IDs = Restaurant::all()->pluck('id')->toArray();
//        if (!in_array($id, $restaurant_IDs)) return \response(['Message' => "'This restaurant isn't exist"]);
//
//        return \response(["Restaurants number $id details:" => (Restaurant::query()->find($id))]);
//    }


    public function show($id)
    {
        $restaurant = Restaurant::with(['categories', 'schedules'])->find($id);

        if (!$restaurant) {
            return response()->json(['message' => "This restaurant doesn't exist"], 404);
        }

        return response()->json(['Restaurant details' => new RestaurantResource($restaurant)]);
    }


    public function food($id)
    {
        try {
            $restaurant = Restaurant::query()->findOrFail($id);
            $foods = $restaurant->foods()->with('discount')->get();



            return response()->json(["Foods details of restaurant number $id" => FoodResource::collection($foods)]);
        } catch (\Exception $e) {
            \Log::error('Database error: ' . $e->getMessage());
            return response()->json(['Message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


}


