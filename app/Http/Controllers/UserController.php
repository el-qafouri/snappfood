<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function adminIndex()
    {
        $foods = Food::all();
        return view('panel.admin.panel.dashboard' , compact('foods'));
    }



    public function sellerIndex()
    {
        $user = Auth::user();
        if ($user->restaurant_id) {
            $restaurant = Restaurant::find($user->restaurant_id);
            if ($restaurant->profile_status) {
                return view('panel.seller.panel.dashboard', ['restaurant' => $restaurant]);
            }
        }
        return redirect()->route('restaurant.create');
    }


//    public function dashboard()
//    {
//        dd('hoop');
//        $user = Auth::user();
//        $restaurant = Restaurant::find($user->restaurant_id);
//
//        return view('panel.seller.panel.dashboard', ['restaurant' => $restaurant]);
//    }


//    public function dashboard()
//    {
//        $user = Auth::user();
//        if (!$user->restaurant_id) {
//            abort(403, 'شما دسترسی به این صفحه را ندارید');
//        }$restaurant = $user->restaurant;
//        if (!$restaurant) {
//            abort(404, 'رستوران یافت نشد');
//        }
//        return view('panel.seller.panel.dashboard', ['restaurant' => $restaurant]);
//    }



//این دشبورد درست شد ولی سطح دسترسی نداره
//    public function dashboard()
//    {
//        $user = Auth::user();
//        $restaurant = $user->restaurant;
//        return view('panel.seller.panel.dashboard', ['restaurant' => $restaurant]);
//    }


    public function dashboard()
    {
        $user = Auth::user();
        if ($user->restaurant && $user->restaurant->profile_status) {
            //نمایش لیست
            return view('panel.seller.panel.dashboard');
        } elseif ($user->restaurant && !$user->restaurant->profile_status) {
            //پروفایل غیرفعال
            return view('panel.seller.panel.inactive_profile');
        } else {
            // کاربر بدون رستوران
            return view('panel.seller.panel.no_restaurant');
        }
    }

}
