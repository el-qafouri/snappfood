<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
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
        $foods = $user->foods;
//        return view('panel.seller.foods.index', [
//            'foods' => $foods
//        ]);

        return view('panel.seller.foods.index' , compact('foods'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foodCategories = FoodCategory::all();
        return view('panel.seller.foods.create', compact('foodCategories'));

    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(FoodRequest $request)
//    {
//        $user = Auth::user();
//        try {
//            $foodData = $request->validated();
//            $foodData['user_id'] = $user->id;
////            Food::query()->create($request->validated());
//            Food::query()->create($foodData);
//            return redirect()->route("food.index")->with('success', $request->food . "food added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
//        }
//    }


    public function store(FoodRequest $request)
    {
        $user = Auth::user();

        try {
            $foodData = $request->validated();
            $food = $user->foods()->create($foodData);

            return redirect()->route("food.index")->with('success', $food->name . " food added successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('food.create')->with('fail', 'food didnt add!');
        }
    }




    /**
     * Display the specified resource.
     */
//    public function show($id)
//    {
//        $food = Food::find($id);
//        return view('panel.seller.foods.show')->with('food', $food);
//    }
    public function show($id)
    {
        $food = Food::find($id);
        if ($food && $food->user_id == auth()->id()) {
            return view('panel.seller.foods.show')->with('food', $food);
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
        $food = Food::find($id);
        if ($food && $food->user_id == auth()->id()) {
            $foodCategories = FoodCategory::all();
            return view('panel.seller.foods.edit', compact('food', 'foodCategories'));
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
////            $food = Food::find($id);
//            $food = Food::findOrFail($id);
//
//            $food->update($request->validated());
//            $foodCategoryId = $food->foodCategory->id; // یافتن آیدی فود کتگوری
//            return view('panel.seller.foods.edit', compact('food', 'foodCategoryId'))->with('success', 'Update successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
//        }
//    }

//    public function update(FoodRequest $request, $id)
//    {
//        try {
////            $food = Food::find($id);
//            $food = Food::findOrFail($id);
////            $foodCategoryId = $food->foodCategory->id; // یافتن آیدی فود کتگوری
////            $foodCategories = FoodCategory::all();
//            $food->update($request->validated());
//            $foodCategories = FoodCategory::all();
//
//            return view('panel.seller.foods.index', compact('food', 'foodCategories'))->with('success', 'Update successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
//        }
//    }

//1
//    public function update(FoodRequest $request, $id)
//    {
//        try {
//            $food = Food::findOrFail($id);
//            $food->update($request->validated());
//            $foodCategoryId = $food->foodCategory->id;
//            return view('panel.seller.foods.edit', compact('food', 'foodCategoryId'))->with('success', 'Update successfully');
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect()->route('food.edit', $id)->with('fail', 'Update failed');
//        }
//    }



    public function update(FoodRequest $request, $id)
    {

        try {

            $food = Food::findOrFail($id);

            $food->update($request->validated());

//            $foodCategory = $food->foodCategory;
            $foodCategories = FoodCategory::all();

//            $foodCategoryId = $foodCategory->id;

            return view('panel.seller.foods.edit', compact('food' , 'foodCategories'))->with('success', 'Update successfully');


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
