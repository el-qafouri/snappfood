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
        $restaurants = Restaurant::all();
        return view('panel.seller.restaurants.index' , compact('restaurants'));
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('panel.seller.restaurants.show' , compact('restaurant'));
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
    public function update(RestaurantRequest $request, $id)
    {
        try {
            $restaurant = Restaurant::find($id);
            $restaurantCategories = RestaurantCategory::all();
            $restaurant->update($request->validated());
            $restaurantCategoryId = $restaurant->restaurantCategory->id;// پیدا کردن آیدی رستوران کتگوری
            return view('panel.seller.restaurants.index', compact('restaurant', 'restaurantCategoryId' , 'restaurantCategories'))->with('success', 'Update successfully');
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
            $restaurant = Restaurant::find($id);
            $restaurant->delete();
            return redirect(status: 200)->route("restaurant.index")->with('success', "restaurant deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('restaurant.index')->with('fail', 'restaurant delete!');
        }
    }
}