<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return view('panel.seller.restaurants.create');
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
            return redirect()->route('seller.dashboard')->with('success', $request->restaurant . 'restaurant add successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('restaurant.create')->with('fail', 'restaurant didnt add');
        }
    }


//    public function store(Request $request)
//    {
////        dd('llll');
//        $validatedDate = $request->validate([
//            'phone' => 'required|string|unique:users',
//            'restaurant_name' => 'required',
//            'restaurant_address' => 'required',
//            'restaurant_category_id' => 'required',
//        ]);
//
//
//        try {
////            Restaurant::create($request->validated());
//            Restaurant::create($validatedDate);
//            return redirect()->route('seller.dashboard')->with('success', $request->restaurant . 'restaurant add successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('restaurant.create')->with('fail', 'restaurant didnt add');
//        }
//    }




////مااله خودم
//    public function store(RestaurantRequest $request)
//    {
//        try {
//            Restaurant::query()->create($request->validated());
//            return redirect()->route('seller.dashboard')->with('success', $request->restaurant . 'restaurant add successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('restaurant.create')->with('fail', 'restaurant didnt add');
//        }
//    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
