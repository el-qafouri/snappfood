<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\AddressRequest;
use App\Http\Requests\RestaurantRequest;
use App\Models\Address;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use http\Client\Curl\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index()
    {

        $restaurants = Restaurant::all();
        return view('panel.seller.restaurants.index', compact('restaurants'));

//        $restaurants = Restaurant::all();
//        $users = \App\Models\User::all();
////        $restaurants = auth()->user()->restaurants;
//        return view('panel.seller.restaurants.index', compact('restaurants' , 'users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('panel.seller.restaurants.create', compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(RestaurantRequest $request)
    {
        try {
            $user = $request->user();
            $restaurant = new Restaurant();
            $restaurant->fill($request->validated());
            $restaurant->user_id = $user->id;
            $restaurant->save();
            $restaurant->restaurantCategories()->attach($request->input('restaurant_category_ids'));

            return redirect()->route('seller.dashboard')->with('success', $request->restaurant_name . ' رستوران با موفقیت افزوده شد');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('restaurant.create')->with('fail', 'رستوران افزوده نشد');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('panel.seller.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurantCategories = RestaurantCategory::all();
        return view('panel.seller.restaurants.edit', compact('restaurant', 'restaurantCategories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $restaurant = Restaurant::query()->find($id);
            $restaurant->delete();
            return redirect(status: 200)->route("restaurant.index")->with('success', "restaurant deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('restaurant.index')->with('fail', 'restaurant delete!');
        }
    }


    public function editProfileStatus($id)
    {
        $restaurant = Restaurant::query()->find($id);
        return view('panel.seller.restaurants.show', compact('restaurant'));
    }

    public function updateProfileStatus(Request $request, $id)
    {
        $restaurant = Restaurant::query()->findOrFail($id);
        $restaurant->update([
            'profile_status' => !$restaurant->profile_status]);

        return redirect()->route('restaurant.index')->with('success', 'Profile status updated successfully');
    }


    //    public function updateProfileStatus(Request $request, $id)
//    {
//        $restaurant = Restaurant::findOrFail($id);
//        // اگر پروفایل استاتوس فعال بود، غیرفعال و برعکس
//        $restaurant->update(['profile_status' => !$restaurant->profile_status]);
//        return redirect()->back()->with('success', 'Profile status updated successfully');
//    }

    public function getLocation()
    {
        return view('panel.seller.restaurants.selectRestaurantLocation');
    }

    public function setLocation(Request $request)
    {
        $user = auth()->user();
        Log::info('Request data:', $request->toArray());

        $title = $request->input('title');
        $addressText = $request->input('address');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $existingAddress = $user->addresses->first();

        if ($existingAddress) {
            $existingAddress->update([
                'title' => $title,
                'address' => $addressText,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            $message = 'address update successfully';
        } else {
            $newAddress = new Address([
                'title' => $title,
                'address' => $addressText,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            $user->addresses()->save($newAddress);

            $message = 'address save successfully';
        }

        return redirect()->route('restaurant.create')->with('success', $message);
    }


}
