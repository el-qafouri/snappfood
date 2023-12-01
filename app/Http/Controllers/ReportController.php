<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
//        $user = auth()->user;
        $orders = Order::all();
        return view('panel.seller.panel.reports', ['orders' => $orders]);


//        $startDate = $request->input('start_date'); // به فرمت Y-m-d
//        $endDate = $request->input('end_date'); // به فرمت Y-m-d
//
//        $orders = Order::whereBetween('created_at', [Carbon::parse($startDate), Carbon::parse($endDate)->endOfDay()])
//            ->with('orderDetails') // ارتباط مربوط به جزئیات سفارش
//            ->get();
//
//        $totalOrders = $orders->count();
//        $totalRevenue = $orders->sum(function ($order) {
//            return $order->orderDetails->sum('price'); // جمع قیمت هر سفارش
//


    }
}
