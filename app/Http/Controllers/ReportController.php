<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user;
        $orders = Order::all();
        return view('panel.seller.panel.reports', ['orders' => $orders]);
    }
}
