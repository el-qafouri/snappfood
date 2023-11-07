<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function adminIndex()
    {
//        dd('hi this is index');
        return view('panel.admin.panel.dashboard');
    }

//    public function sellerIndex()
//    {
////        dd('hi this is index');
//        return view('panel.seller.panel.dashboard');
//    }


    public function sellerIndex()
    {
        // Check if the user has a restaurant
        $user = Auth::user();
        if (!$user->restaurant_name) {
            return redirect()->route('restaurant.create');
        }

        // Get the restaurant information
        $restaurant = Restaurant::find($user->restaurant_id);

        // Return the view
        return view('panel.seller.panel.dashboard', ['restaurant' => $restaurant]);
    }


    public function dashboard()
    {
        $user = Auth::user();
        $restaurant = Restaurant::find($user->restaurant_id);

        return view('panel.seller.panel.dashboard', ['restaurant' => $restaurant]);
    }





}
