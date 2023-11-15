<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $discounts = $user->discounts;
        return view('panel.seller.discounts.index', compact('discounts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.seller.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */

////یوزرآیدی رو سیو میکنه
//    public function store(DiscountRequest $request)
//    {
//        try {
//            $user = auth()->user();
//            $discountData = $request->validated();
//            $discount = $user->discounts()->create($discountData);
//            return redirect()->route('discount.index')->with('success', $discount->discount . " discount added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('discount.create')->with('fail', 'discount didnt add');
//        }
//    }

    public function store(DiscountRequest $request)
    {
        try {
            $user = auth()->user();
            $restaurant = $user->restaurant;
            if (!$restaurant) {
                abort(404, 'رستوران یافت نشد');
            }
            $discountData = $request->validated();
            $discountData['user_id'] = $user->id;
            $discountData['restaurant_id'] = $restaurant->id;
//            $foodId = $request->input('food_id');
//            $discountData['food_id'] = $foodId;
            $discount = Discount::create($discountData);
            return redirect()->route('discount.index')->with('success', $discount->discount . " discount added successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('discount.create')->with('fail', 'discount didnt add');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount, $id)
    {
        $discount = Discount::find($id);
        return view('panel.seller.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, $id)
    {
        try {
            $discount = Discount::find($id);
            $discount->update($request->validated());
            return redirect()->route('discount.index')->with('success', 'update successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('discount.edit', $discount)->with('fail', 'update failed');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $discount = Discount::find($id);
            $discount->delete();
            return redirect(status: 200)->route("discount.index")->with('success', "food Party deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('discount.index')->with('fail', 'food Party delete!');
        }
    }
}
