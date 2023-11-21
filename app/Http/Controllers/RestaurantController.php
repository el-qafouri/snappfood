<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
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
        return view('panel.seller.restaurants.index' , compact('restaurants'));

//        $restaurants = Restaurant::all();
//        $users = \App\Models\User::all();
////        $restaurants = auth()->user()->restaurants;
//        return view('panel.seller.restaurants.index', compact('restaurants' , 'users'));
    }



//    public function index()
//    {
//        $user = auth()->user();
//
//        if ($user->hasRole('seller')) {
//            $restaurants = $user->restaurants;
//
//            // اگر سلر رستوران نداشته باشد
//            if (!$restaurants->isEmpty()) {
//                return view('panel.seller.restaurants.index', compact('restaurants'));
//            } else {
//                return view('panel.seller.restaurants.index');
//            }
//        } elseif ($user->hasRole('admin')) {
////            $restaurants = Restaurant::with('user')->get();
//            $restaurants = Restaurant::all();
//            return view('panel.seller.restaurants.index', compact('restaurants'));
//        } else {
//            return view('panel.seller.restaurants.index');
//        }
//    }



//    public function index()
//    {
//        $user = auth()->user();
//
//        if ($user->hasRole('seller')) {
//            $restaurants = $user->restaurants;
//            return view('panel.seller.restaurants.index', compact('restaurants'));
//        } elseif ($user->hasRole('admin')) {
//            $restaurants = Restaurant::with('user')->get();
//            return view('panel.seller.restaurants.index', compact('restaurants'));
//        } else {
//            return view('panel.seller.restaurants.index');
//        }
//    }







//    public function restaurantActive(Request $request)
//    {
//        $restaurant = Restaurant::query()->find($request->input('restaurant_id'));
//        if (!$restaurant) {
//            return response('not found');
//        }
//        $restaurant->status = $restaurant->status == 1 ? 0 : 1 ;
//        $restaurant->save();
//        return redirect()->back();
//    }



//    public function index()
//    {
//        $restaurants = Restaurant::with('restaurant_category')->get();
//        return view('panel.seller.restaurants.index', compact('restaurants'));
//    }


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
//    public function store(RestaurantRequest $request)
//    {
////        dd('hi');
//        try {
//            $user = $request->user();
//            $restaurant = new Restaurant();
//            $restaurant->fill($request->validated());
//            $restaurant->user_id = $user->id;
//            $restaurant->save();
//            return redirect()->route('seller.dashboard')->with('success', $request->restaurant . 'restaurant add successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('restaurant.create')->with('fail', 'restaurant didnt add');
//        }
//    }


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
     * Update the specified resource in storage.
     */
//    public function update(RestaurantRequest $request, $id)
//    {
//        try {
//            $restaurant = Restaurant::find($id);
//            $restaurantCategories = RestaurantCategory::all();
//            $restaurant->update($request->validated());
//            $restaurantCategoryId = $restaurant->restaurantCategory->id;// پیدا کردن آیدی رستوران کتگوری
//            return view('panel.seller.restaurants.index', compact('restaurant', 'restaurantCategoryId', 'restaurantCategories'))->with('success', 'Update successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect()->route('restaurant.edit', $id)->with('fail', 'Update failed');
//        }
//    }


    public function update(RestaurantRequest $request, $id)
    {
        try {
            $restaurant = Restaurant::query()->find($id);

            if (!$restaurant) {
                return redirect()->route('restaurant.edit', $id)->with('fail', 'Restaurant not found');
            }
            $restaurant->update($request->validated());
            if ($request->has('restaurant_category_ids')) {
                $restaurant->restaurantCategories()->sync($request->input('restaurant_category_ids'));
            } else {
                $restaurant->restaurantCategories()->detach();
            }

            return redirect()->route('restaurant.index')->with('success', 'Restaurant updated successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('restaurant.edit', $id)->with('fail', 'Update failed');
        }
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
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update([
            'profile_status' => !$restaurant->profile_status]);

        return redirect()->route('restaurant.index')->with('success', 'Profile status updated successfully');
    }

//    // RestaurantController.php
//    public function updateProfileStatus(Request $request, $id)
//    {
//        $restaurant = Restaurant::findOrFail($id);
//        // اگر پروفایل استاتوس فعال بود، غیرفعال و برعکس
//        $restaurant->update(['profile_status' => !$restaurant->profile_status]);
//        return redirect()->back()->with('success', 'Profile status updated successfully');
//    }


}
