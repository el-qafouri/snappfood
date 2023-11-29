<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use ConsoleTVs\Charts\Facades\Charts;

class ReportController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // یا هر نحو که نیاز دارید
        return view('reports', ['orders' => $orders]);
    }
}
