<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        return view('panel.seller.foods.index', [
            'foods' => $foods
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foodCategories = FoodCategory::all();
//        dd('create foodddd');
        return view('panel.seller.foods.create', compact('foodCategories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FoodRequest $request)
    {
//        dd('store foodddd');

        try {
            Food::query()->create($request->validated());
            return redirect()->route("food.index")->with('success', $request->food . "food added successfully");
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
//        dd('show foodddd');

        $food = Food::find($id);
        return view('panel.seller.foods.show')->with('food', $food);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
////        dd('edit foodddd');
//        $food = Food::find($id);
//        return view('panel.seller.foods.edit', compact('food'));
        $food = Food::find($id);
        $foodCategories = FoodCategory::all(); // دریافت داده‌های مورد نیاز برای $foodCategories
        return view('panel.seller.foods.edit', compact('food', 'foodCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FoodRequest $request, $id)
    {
        try {
            $food = Food::find($id);
            $food->update($request->validated());
            $foodCategoryId = $food->foodCategory->id; // یافتن آیدی فود کتگوری
            return view('panel.seller.foods.edit', compact('food', 'foodCategoryId'))->with('success', 'Update successfully');
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
//        dd('destroy foodddd');
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
