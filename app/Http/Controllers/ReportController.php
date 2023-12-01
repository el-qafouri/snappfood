<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{


    public function index(Request $request)
    {
        $filter = $request->get('filter', 'this_month');

        $restaurantId = auth()->user()->restaurant->id ?? null;

        if (!$restaurantId) {

            abort(403, 'Access denied or no restaurant associated with the user.');
        }





            $ordersQuery = Order::where('restaurant_id', $restaurantId);
            // ...
            switch ($filter) {
                case 'today':
                    $ordersQuery->whereDate('created_at', today());
                    break;
                case 'this_week':
                    $ordersQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'this_month':
                    $ordersQuery->whereMonth('created_at', '=', Carbon::now()->month);
                    $ordersQuery->whereYear('created_at', '=', Carbon::now()->year);

                    break;
                case 'all':
                    break;
            }

        $totalOrders = $ordersQuery->count();
        $totalSales = $ordersQuery->sum('total_price');

        // تغییر 'with('orderDetails') به 'with('foods')'
        $orders = $ordersQuery->with(['foods' => function ($query) {
            $query->select('foods.id', 'name')->withPivot('count');
        }])->get();

        // ارسال داده‌ها به ویو
        return view('panel.seller.panel.reports', [
            'filter' => $filter,
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'orders' => $orders,
        ]);
    }


    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }


    public function showSalesReport()
    {
        $salesData = Order::select(
            DB::raw('date(created_at) as date'),
            DB::raw('sum(total_price) as total_sales')
        )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $salesLabels = $salesData->pluck('date')->all();
        $salesAmounts = $salesData->pluck('total_sales')->all();

        return view('your.blade.view', compact('salesLabels', 'salesAmounts'));
    }


}
