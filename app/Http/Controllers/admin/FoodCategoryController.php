<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use App\Http\Controllers\Log;
use App\Http\Requests\StoreFoodeCategoryRequest;
use App\Http\Requests\UpdateFoodCategoryRequest;
use App\Models\FoodCategory;


class FoodCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodCategories = FoodCategory::paginate(3);
        return view("panel.admin.foodCategories.index", [
            "foodCategories" => $foodCategories,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd('hi');
        return view('panel.admin.foodCategories.create');
//        return redirect()->route('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodeCategoryRequest $request)
    {
        try {
            FoodCategory::query()->create($request->validated());
            return redirect()->route("category.index")->with('success', $request->foodCategories . "Category added successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('category.create')->with('fail', 'category didnt add!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = FoodCategory::find($id);
        return view('panel.admin.foodCategories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $foodCategory = FoodCategory::find($id);
        return view('panel.admin.foodCategories.edit', compact('foodCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodCategoryRequest $request, $id)
    {
        try {
            $foodCategory = FoodCategory::find($id);
            $foodCategory->update($request->validated());
            return redirect()->route('category.index')->with('success', 'update successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('category.edit', $foodCategory)->with('fail', 'update failed');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $foodCategory = FoodCategory::find($id);
            $foodCategory->delete();
            return redirect(status: 200)->route("category.index")->with('success', "category deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('category.index')->with('fail', 'category delete!');
        }

    }
}
