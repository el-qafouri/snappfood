<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodeCategoryRequest;
use App\Http\Requests\UpdateFoodCategoryRequest;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{

//    public function __construct()
//    {
//        $this->authorizeResource(FoodCategory::class , 'foodCategory');
//    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return view('panel.admin.foodCategories.index');
        $foodCategories = FoodCategory::all();
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
        return view("panel.admin.foodCategories.create");
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
    public function show(FoodCategory $foodCategory)
    {
        dd('show category');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $foodCategory = FoodCategory::find($id);
//        return view("panel.admin.foodCategories.edit",compact('foodCategory'));
//        $category = $foodCategory;
//        $category = FoodCategory::query()->find($foodCategory->id);
//        return view('panel.admin.foodCategories.edit', ['category' => $category]);
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
//        $foodCategory->update($request->all());
//        return redirect()->route('category.index')->with('update','update successfully');
//        dd($foodCategory);
//        $id = $request->input('id');
//        try {
//            $category = FoodCategory::query()->findOrFail($id);
//            $category->update($request->validated());
////            $category->update($request->validated());
////            dd($category);
//            return redirect(status: 200)->route('category.index')->with('success', $request->name . "category updated successfully");
//        }catch (Exception $e){
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('category.edit', $category)->with('fail', 'category didnt update!');
//        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $foodCategory = FoodCategory::find($id);
//            FoodCategory::query()->findOrFail($id)->delete();
            $foodCategory->delete();
            return redirect(status: 200)->route("category.index")->with('success', "category deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('category.index')->with('fail', 'book category delete!');
        }

    }
}
