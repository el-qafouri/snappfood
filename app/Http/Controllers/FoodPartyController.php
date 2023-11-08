<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodPartyRequest;
use App\Http\Requests\FoodRequest;
use App\Models\FoodParty;
use Illuminate\Http\Request;

class FoodPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodParties = FoodParty::all();
        return view('panel.admin.foodParties.index' , [
            "foodParties"=> $foodParties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.admin.foodParties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FoodPartyRequest $request)
    {
        try {
            FoodParty::query()->create($request->validated());
            return redirect()->route('foodParty.index')->with('success', $request->foodParty . "food party added successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('foodParty.create')->with('fail', 'food party didnt add!');
        }
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
//    public function show(FoodParty $foodParty)
//    {
//        if (!auth()->user()->can('view-food-party', $foodParty)) {
//            return redirect()->route('home')->with('fail', 'You are not authorized to view this food party.');
//        }
//    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodParty $foodParty , $id)
    {
        $foodParty = FoodParty::find($id);

//        return view('panel.admin.foodParties.edit', ['foodParty' => $foodParty , 'discount' => $discount]);


//        $foodParty = FoodParty::find($id);
        return view('panel.admin.foodParties.edit', compact('foodParty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FoodPartyRequest $request, $id)
    {
        try {
            $foodParty = FoodParty::find($id);
            $foodParty->update($request->validated());
            return redirect()->route('foodParty.index')->with('success', 'update successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('foodParty.edit', $foodParty)->with('fail', 'update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $foodParty = FoodParty::find($id);
            $foodParty->delete();
            return redirect(status: 200)->route("foodParty.index")->with('success', "food Party deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('foodParty.index')->with('fail', 'food Party delete!');
        }
    }
}
