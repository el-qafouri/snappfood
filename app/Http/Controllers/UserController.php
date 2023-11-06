<?php

namespace App\Http\Controllers;

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

    public function sellerIndex()
    {
//        dd('hi this is index');
        return view('panel.seller.panel.dashboard');
    }
}
