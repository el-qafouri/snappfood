<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function showSellerRegister()
    {
        return view('auth.sellerRegister');
    }
}
