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


//    public function index()
//    {
//        $user = auth()->user();
//        $restaurant = $user->restaurant;
//
//        if (!$restaurant) {
//            abort(404, 'رستوران یافت نشد');
//        }
//
//        $discounts = $restaurant->discounts;
//        return view('panel.seller.discounts.index', compact('discounts'));
//    }


//    public function index()
//    {
//        $user = auth()->user();
//        $discounts = $user->restaurant->discounts;
//        return view('panel.seller.discounts.index', compact('discounts'));
//    }

//    public function index()
//    {
//        $user = auth()->user();
//        $restaurant = optional($user->restaurant);
//
//        $discounts = $restaurant->discounts ?? collect();
//
//        return view('panel.seller.discounts.index', compact('discounts'));
//    }


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
//    public function store(DiscountRequest $request)
//    {
//
//        try {
//            Discount::query()->create($request->validated());
//            return redirect()->route('discount.index')->with('success', $request->discount . "discount added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('discount.create')->with('fail', 'discount didnt add');
//        }
//    }








    //بارد داده
//    public function store(DiscountRequest $request)
//    {
//        $discountData = $request->validated();
//
//        // Retrieve user_id from the request or set it manually
//        $discountData['user_id'] = Auth::user()->id;
//
//        // Retrieve restaurant_id from the request or set it manually
//        $discountData['restaurant_id'] = Restaurant::query()->where('user_id', Auth::user()->id)->first()->id;
//
//        try {
//            Discount::query()->create($discountData);
//            return redirect()->route('discount.index')->with('success', $request->discount . "discount added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('discount.create')->with('fail', 'discount didnt add');
//        }
//    }


//بارد 2
//    public function store(DiscountRequest $request)
//    {
//        $discountData = $request->validated();
//
//        // Retrieve user_id from the request
//        $discountData['user_id'] = $request->user_id;
//
//        // Retrieve restaurant_id from the request
//        $discountData['restaurant_id'] = $request->restaurant_id;
//
//        try {
//            Discount::query()->create($discountData);
//            return redirect()->route('discount.index')->with('success', $request->discount . "discount added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('discount.create')->with('fail', 'discount didnt add');
//        }
//    }

//بارد 3

//    public function store(DiscountRequest $request)
//    {
//        $discountData = $request->validated();
//
//        // Retrieve user_id from the request
//        $discountData['user_id'] = $request->user_id;
//
//        // Retrieve restaurant_id from the restaurant record associated with the current user
//        $restaurant = Restaurant::query()->whereHas('user', function ($query) {
//            $query->where('id', Auth::user()->id);
//        })->first();
//        $discountData['restaurant_id'] = $restaurant->id;
//
//        try {
//            Discount::query()->create($discountData);
//            return redirect()->route('discount.index')->with('success', $request->discount . "discount added successfully");
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            return redirect(status: 500)->route('discount.create')->with('fail', 'discount didnt add');
//        }
//    }



    public function store(DiscountRequest $request)
    {
        try {
            $discount = new Discount();
            $discount->discount = $request->discount;
            $discount->user_id = $request->user_id; // یا هر چیزی که نیاز باشد
            $discount->restaurant_id = $request->restaurant_id; // یا هر چیزی که نیاز باشد
            $discount->food_id = $request->food_id; // یا هر چیزی که نیاز باشد
            $discount->save();

            return redirect()->route('discount.index')->with('success', $request->discount . "discount added successfully");
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
