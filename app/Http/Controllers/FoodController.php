<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Discount;
use App\Models\Food;
use App\Models\FoodCategory;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        try {
            $foodData = $request->validated();
            $foodData['restaurant_id'] = $user->restaurant->id;

            $discountId = $request->input('discount_id');
            $discount = Discount::query()->find($discountId);

            if ($discount) {
                $discountAmount = ($discount->discount / 100) * $foodData['price'];
                $foodData['final_price'] = $foodData['price'] - $discountAmount;
            } //            dd($foodData);
            else {
                $foodData['final_price'] = $foodData['price'];
            }

            $food = new Food($foodData);
            $food->discount_id = $discountId;
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
        try {
            $food = Food::findOrFail($id);

            if ($request->hasFile('imagePath')) {
                $imagePath = $request->file('imagePath');
                $fileName = 'food' . time() . '_' . $imagePath->hashName();
                $imagePath->move(public_path('food'), $fileName);

                if ($food->image_path) {
                    unlink(public_path('food/' . $food->image_path));
                }
                $food->update(['image_path' => $fileName]);
            }

            if ($request->filled('discount_id')) {
                $discountId = $request->input('discount_id');
                $discount = Discount::find($discountId);

                if ($discount) {
                    $food->discount_id = $discountId;
                } else {
                    return redirect()->route('food.edit', $id)->with('fail', 'Discount not found');
                }
            }

            // اعمال تخفیف به قیمت غذا اگر تخفیف موجود باشد
            if ($food->discount) {
                $discountAmount = ($food->discount->discount / 100) * $food->price;
                $food->final_price = $food->price - $discountAmount;
            } else {
                // اگر تخفیف موجود نباشد، قیمت نهایی برابر با قیمت اصلی غذا است
                $food->final_price = $food->price;
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


    public function showFoodWithComment()
    {
        dd('lololo');
        $foodsWithComments = Food::query()->has('comments')->get();
        return view('seller.foods.foodComments', compact('foodsWithComments'));

    }

}
