<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
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

        $userLatitude = (double) $user->latitude;
        $userLongitude = (double) $user->longitude;

        $restaurants = DB::table('restaurants')
            ->join('addresses', 'restaurants.id', '=', 'addresses.addressable_id')
            ->select('restaurants.*', 'addresses.latitude', 'addresses.longitude')
            ->selectRaw("6371 * acos(cos(radians(?)) * cos(radians(addresses.latitude)) * cos(radians(addresses.longitude) - radians(?)) + sin(radians(?)) * sin(radians(addresses.latitude))) AS distance", [
                $userLatitude,
                $userLongitude,
                $userLatitude
            ])
            ->orderBy('distance')
            ->get();

        $restaurants = $restaurants->map(function ($restaurant) {
            $restaurant->distance = round($restaurant->distance, 2);
            return $restaurant;
        });

        return response()->json([
            'restaurants' => $restaurants
        ], 200);
    }




//    public function index()
//    {
//        $user = auth()->user();
//
//        // اگر کاربر لاگین نکرده باشد
//        if (!$user) {
//            return response(['Message' => 'User not authenticated.'], 401);
//        }
//
//        $userCoordinates = DB::table('addresses')
//            ->where('addressable_type', 'App\Models\User')
//            ->where('addressable_id', $user->id)
//            ->where('active' , '==' , true)
//            ->select('latitude', 'longitude')
//            ->first();
//
//        // اگر اطلاعات موقعیت جغرافیایی برای کاربر موجود نبود یا غیرفعال بود
//        if (!$userCoordinates) {
//            return response(['Message' => 'User coordinates not found or inactive.'], 404);
//        }
//        // محاسبه فاصله با رستوران‌ها
//        $restaurants = DB::table('restaurants')
//            ->join('addresses', 'restaurants.id', '=', 'addresses.addressable_id')
//            ->where('addresses.addressable_type', 'App\Models\Restaurant')
//            ->where('addresses.active', 1)
//            ->select(
//                'restaurants.id',
//                'restaurants.restaurant_name',
//                'restaurants.phone',
//                'addresses.address',
//                DB::raw('(6371 * acos(
//                cos(radians(' . $userCoordinates->latitude . ')) *
//                cos(radians(addresses.latitude)) *
//                cos(radians(addresses.longitude) - radians(' . $userCoordinates->longitude . ')) +
//                sin(radians(' . $userCoordinates->latitude . ')) * sin(radians(addresses.latitude))
//            )) AS distance')
//            )
//            ->orderBy('distance', 'asc')
//            ->get();
//
//        return response(['Nearby Restaurants' => $restaurants]);
//    }



    public function show($id)
    {
        $restaurant_IDs = Restaurant::all()->pluck('id')->toArray();
        if (!in_array($id, $restaurant_IDs)) return \response(['Message' => "'This restaurant isn't exist"]);

        return \response(["Restaurants number $id details:" => (Restaurant::query()->find($id))]);
    }


    public function food($id)
    {
        try {
            $restaurant = Restaurant::query()->findOrFail($id);
//            $foods = $restaurant->foods;
            $foods = $restaurant->foods()->with('discount')->get();
            $foodDetails = [];
            foreach ($foods as $food) {
                $foodDetails[] = [
                    'name' => $food->name,
                    'price' => $food->price,
//                    'discount'=>$food->discount,
                    'discount' => $food->discount ? $food->discount->discount : null,
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


