<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Discount;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        $user = Auth::user();
//        $foods = $user->foods;
//        return view('panel.seller.foods.index', compact('foods'));
//    }


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
//    public function create()
//    {
//        $user = Auth::user();
//        $foodCategories = FoodCategory::all();
//        $discounts = $user->discounts;
//        return view('panel.seller.foods.create', compact('foodCategories' , 'discounts'));
//    }


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

//    public function store(FoodRequest $request)
//    {
//        $user = Auth::user();
//
//        try {
//            $foodData = $request->validated();
//
//            $foodData['restaurant_id'] = $user->restaurant->id;
//
//            $food = $user->foods()->create($foodData);
//
//            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }

// ...

//    public function store(FoodRequest $request)
//    {
//        $user = Auth::user();
//        try {
//            $foodData = $request->validated();
//            $foodData['restaurant_id'] = $user->restaurant->id;
//            $food = $user->foods()->create($foodData);
////            $food->foodCategories()->sync($request->input('food_category_id'));
//
//            $food->foodCategories()->attach($request->input('food_category_id'));
//
//            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }


//بدون عکس درست بود
//    public function store(FoodRequest $request)
//    {
//        $user = Auth::user();
//        try {
//            $foodData = $request->validated();
//            $foodData['restaurant_id'] = $user->restaurant->id;
//            $food = $user->foods()->create($foodData);
//
//            // Get the food category ids from the request
//            $foodCategoryIds = $request->input('food_category_ids');
//
//            // Attach the food categories
//            $food->foodCategories()->sync($foodCategoryIds);
//
//            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }


//با عکس
//    public function store(FoodRequest $request)
//    {
//        $user = Auth::user();
//        try {
//            $foodData = $request->validated();
//            $foodData['restaurant_id'] = $user->restaurant->id;
//            if ($request->hasFile('image_path')) {
//                $imagePath = $request->file('image_path');
//                $fileName = 'public/food' . time() . '_' . $imagePath->getClientOriginalName();
//                $imagePath->move(public_path('public/food'), $fileName);
//            } else {
//                $fileName = null;
//            }
//            $food = $user->foods()->create($foodData);
//            $foodCategoryIds = $request->input('food_category_ids');
//            $food->foodCategories()->sync($foodCategoryIds);
//            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }

//دیدی گرفتم خروجی نداد
//    public function store(FoodRequest $request)
//    {
//        $user = Auth::user();
//        try {
//            $foodData = $request->validated();
//            $foodData['restaurant_id'] = $user->restaurant->id;
//            if ($request->hasFile('imagePath')) {
//                $imagePath = $request->file('imagePath');
////                $fileName = $imagePath->getClientOriginalName();
////                $imagePath->move(public_path('food'), $fileName);
//
//                $fileName = 'food_' . time() . '_' . $imagePath->hashName();
//                $imagePath->move(public_path('food'), $fileName);
//
//            } else {
//                $fileName = null;
//            }
//            dd($imagePath);
//
//
//            $food = $user->foods()->create($foodData);
//
//
//
//            // Get the food category ids from the request
//            $foodCategoryIds = $request->input('food_category_ids');
//
//            // Attach the food categories
//            $food->foodCategories()->sync($foodCategoryIds);
//
//            // Save the food record
//            $food->save();
//
//            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }



//    public function store(FoodRequest $request)
//    {
////        dd('iii')
//        $user = Auth::user();
//        $imagePath = null;
//        try {
//            $foodData = $request->validated();
//            $foodData['user_id'] = $user->id;
//
//            $foodData['restaurant_id'] = $user->restaurant->id;
//            if ($request->hasFile('imagePath')) {
//                $imagePath = $request->file('imagePath');
//                $fileName = 'food' . time() . '_' . $imagePath->hashName();
//                $imagePath->move(public_path('food'), $fileName);
//            } else {
//                $fileName = null;
//            }
////            $food = $user->foods()->create($foodData);
//            $food = new Food($foodData);
//            $food->image_path = $fileName;
//            $food->save();
////            $foodCategoryId = $request->input('food_category_id')[0];
////            $food->foodCategories()->sync($foodCategoryId);
//
//
//            $foodCategoryIds = $request->input('food_category_id');
//            $food->foodCategories()->sync($foodCategoryIds);
//
//            return redirect()->route("food.index")->with('success', $food->name . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }




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
//بدون عکس جواب بود
//    public function show($id)
//    {
//        $food = Food::query()->find($id);
//        if ($food && $food->user_id == auth()->id()) {
//            return view('panel.seller.foods.show')->with('food', $food);
//        } else {
//            abort(403, 'Access denied');
//        }
//    }


    public function show($id)
    {
        $food = Food::query()->find($id);
        if ($food && $food->restaurant_id == auth()->id()) {
            $images = $food->imagePath ? json_decode($food->imagePath , true) : [];
            return view('panel.seller.foods.show')->with(['food' => $food, 'images' => $images]);
        } else {
            abort(403, 'Access denied');
        }
    }






    /**
     * Show the form for editing the specified resource.
     */
//    public function edit($id)
//    {
//        $food = Food::find($id);
//        $foodCategories = FoodCategory::all();
//        return view('panel.seller.foods.edit', compact('food', 'foodCategories'));
//    }


    public function edit($id)
    {
        $food = Food::query()->findOrFail($id);
        if ($food && $food->restaurant_id == auth()->id()) {
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

//    public function update(FoodRequest $request, $id)
//    {
//        try {
//            $food = Food::query()->findOrFail($id);
//            $food->update($request->validated());
//            $foodCategories = FoodCategory::all();
//            $discounts = auth()->user()->discounts;
//            return view('panel.seller.foods.edit', compact('food', 'foodCategories' , 'discounts'))->with('success', 'Update successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
//        }
//    }


//    public function update(FoodRequest $request, $id)
//    {
//        try {
//            $food = Food::findOrFail($id);
//
//            // Make sure the current user owns the food
//            if ($food && $food->user_id == auth()->id()) {
//                // Update the food
//                $food->update($request->validated());
//
//                // Sync the food categories
//                $food->foodCategories()->sync($request->input('food_category_ids'));
//
//                // Retrieve the updated food with categories and discounts
//                $food = Food::with('foodCategories', 'discount')->findOrFail($id);
//
//                $foodCategories = FoodCategory::all();
//                $discounts = auth()->user()->discounts;
//
//                return view('panel.seller.foods.edit', compact('food', 'foodCategories', 'discounts'))->with('success', 'Update successfully');
//            } else {
//                abort(403, 'Access denied');
//            }
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
//        }
//    }





/*
    public function update(FoodRequest $request, $id)
    {
        try {
            $food = Food::findOrFail($id);

            // Make sure the current user owns the food
            if ($food && $food->user_id == auth()->id()) {
                // Check if a new image is uploaded
                if ($request->hasFile('imagePath')) {
                    $imagePath = $request->file('imagePath');
                    $fileName = 'food' . time() . '_' . $imagePath->hashName();
                    $imagePath->move(public_path('food'), $fileName);

                    // Delete the old image if it exists
                    if ($food->image_path) {
                        unlink(public_path('food/' . $food->image_path));
                    }

                    // Update the image path in the food model
                    $food->update(['image_path' => $fileName]);
                }

                // Update the other fields of the food
                $food->update($request->validated());

                // Sync the food categories
                $food->foodCategories()->sync($request->input('food_category_ids'));

                // Retrieve the updated food with categories and discounts
                $food = Food::with('foodCategories', 'discount')->findOrFail($id);

                $foodCategories = FoodCategory::all();
                $discounts = auth()->user()->discounts;

                return view('panel.seller.foods.edit', compact('food', 'foodCategories', 'discounts'))->with('success', 'Update successfully');
            } else {
                abort(403, 'Access denied');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
        }
    }
*/



    public function update(FoodRequest $request ,$id)
    {
        dd($request);
        try {
            $food = Food::query()->findOrFail($id);
            if ($food && $food->restaurant_id == auth()->id()) {
                if ($request->hasFile('imagePath')) {
                    $imagePath = $request->file('imagePath');
                    $fileName = 'food' . time() . '_' . $imagePath->hashName();
                    $imagePath->move(public_path('food'), $fileName);

                    // Delete the old image if it exists
                    if ($food->image_path) {
                        unlink(public_path('food/' . $food->image_path));
                    }

                    // Update the image path in the food model
                    $food->update(['image_path' => $fileName]);
                }

                // Update the other fields of the food
                $food->update($request->validated());

                // Sync the food categories
                $food->foodCategories()->sync($request->input('food_category_ids'));

                // Retrieve the updated food with categories and discounts
                $food = Food::with('foodCategories', 'discount')->findOrFail($id);

                $foodCategories = FoodCategory::all();
                $discounts = auth()->user()->discounts;

                return view('panel.seller.foods.edit', compact('food', 'foodCategories', 'discounts'))->with('success', 'Update successfully');
            } else {
                abort(403, 'Access denied');
            }
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
            $food = Food::find($id);
            $food->delete();
            return redirect(status: 200)->route("food.index")->with('success', "food deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('food.index')->with('fail', 'food delete!');
        }
    }
}
