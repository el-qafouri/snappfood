<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantCategoryRequest;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('panel.admin.restaurantCategories.index', [
            'restaurantCategories' => $restaurantCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('panel.admin.restaurantCategories.create', compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantCategoryRequest $request)
    {
        try {
            RestaurantCategory::query()->create($request->validated());
            return redirect()->route("restaurantCategory.index")->with('success', $request->restaurantCategory . "restaurant category added successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('restaurantCategory.create')->with('fail', 'restaurant category didnt add!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurantCategory = RestaurantCategory::find($id);
        return view('panel.admin.restaurantCategories.show')->with('restaurantCategory', $restaurantCategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $restaurantCategory = RestaurantCategory::find($id);
        return view('panel.admin.restaurantCategories.edit', compact('restaurantCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantCategoryRequest $request, $id)
    {
        try {
            $restaurantCategory = RestaurantCategory::find($id);
            $restaurantCategory->update($request->validated());
            return redirect()->route('restaurantCategory.index')->with('success', 'update successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('restaurantCategory.edit', $restaurantCategory)->with('fail', 'update failed');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $restaurantCategory = RestaurantCategory::find($id);
            $restaurantCategory->delete();
            return redirect(status: 200)->route("restaurantCategory.index")->with('success', "restaurant category deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('restaurantCategory.index')->with('fail', 'restaurant category delete!');
        }
    }
}
