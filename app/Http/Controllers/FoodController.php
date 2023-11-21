<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;

        if ($restaurant) {
            $foods = $restaurant->foods;
            return view('panel.seller.foods.index', compact('foods'));
        } else {
            return redirect()->route('restaurant.create')->with('warning', 'You need to create a restaurant first.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        try {
            $user = Auth::user();
            $foodCategories = FoodCategory::all();
            $discounts = $user->discounts;
            return view('panel.seller.foods.create', compact('foodCategories', 'discounts'));
        } catch (Exception $e) {
            return ('food didnt add');
        }
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(FoodRequest $request)
    {
        $user = Auth::user();
//        $restaurant = Restaurant::query()->find($restaurantId);
//        $foods = $restaurant->foods;
        try {
            $foodData = $request->validated();
            $foodData['restaurant_id'] = $user->restaurant->id;
            if ($request->hasFile('imagePath')) {
                $imagePath = $request->file('imagePath');
                $fileName = 'food' . time() . '_' . $imagePath->hashName();
                $imagePath->move(public_path('food'), $fileName);
                $foodData['image_path'] = $fileName;
            } else {
                $foodData['image_path'] = null;
            }

            $food = new Food($foodData);
//            dd($food);

            $food->save();

            $foodCategoryIds = $request->input('food_category_id');

            $food->foodCategories()->attach($foodCategoryIds);

            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
        }
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        try {
            $food = Food::query()->findOrFail($id);
            if ($food->restaurant_id) {
                $images = $food->imagePath ? json_decode($food->imagePath, true) : [];
                return view('panel.seller.foods.show')->with(['food' => $food, 'images' => $images]);
            } else {
                abort(403, 'Access denied');
            }
        } catch (ModelNotFoundException $e) {
            // در صورت عدم یافتن موجودیت، ایجاد استثناء ModelNotFoundException
            abort(404, 'Food not found');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $food = Food::query()->findOrFail($id);
        if ($food && $food->restaurant_id) {
            $foodCategories = FoodCategory::all();
//            $discounts = Discount::query()->find($id);
            $discounts = auth()->user()->discounts;
            return view('panel.seller.foods.edit', compact('food', 'foodCategories', 'discounts'));
        } else {
            abort(403, 'Access denied');
        }
    }


    /**
     * Update the specified resource in storage.
     */


    public function update(UpdateFoodRequest $request, $id)
    {
//        dd('hi');
        try {
            $food = Food::query()->findOrFail($id);

            if ($request->hasFile('imagePath')) {
                $imagePath = $request->file('imagePath');
                $fileName = 'food' . time() . '_' . $imagePath->hashName();
                $imagePath->move(public_path('food'), $fileName);

                if ($food->image_path) {
                    unlink(public_path('food/' . $food->image_path));
                }
                $food->update(['image_path' => $fileName]);
            }
            $food->update($request->validated());
            $food->foodCategories()->sync($request->input('food_category_id'));

            $food = Food::with('foodCategories', 'discount')->findOrFail($id);

            $foodCategories = FoodCategory::all();
            $discounts = auth()->user()->discounts;

            return view('panel.seller.foods.edit', compact('food', 'foodCategories', 'discounts'))->with('success', 'Update successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $food = Food::query()->find($id);
            $food->delete();
            return redirect(status: 200)->route("food.index")->with('success', "food deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('food.index')->with('fail', 'food delete!');
        }
    }
}
