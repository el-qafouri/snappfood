<?php

namespace App\Http\Controllers;

use App\Models\Food;
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
        dd('create foodddd');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd('store foodddd');

    }

    /**
     * Display the specified resource.
     */
    public function show(Food $foods)
    {
        dd('show foodddd');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $foods)
    {
        dd('edit foodddd');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $foods)
    {
        dd('update foodddd');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $foods)
    {
        dd('destroy foodddd');

    }
}
