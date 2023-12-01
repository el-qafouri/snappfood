<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function index(Request $request)
    {
        $filter = $request->get('filter', 'this_month');
        // حصول اطمینان از شناسه رستوران
        $restaurantId = auth()->user()->restaurant->id ?? null;

        if (!$restaurantId) {
            // اطلاعاتی یافت نشده یا کاربر مجوز لازم را ندارد.
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
            default:
                $ordersQuery->whereMonth('created_at', now()->month);
                break;
        }

        $totalOrders = $ordersQuery->count();
        $totalSales = $ordersQuery->sum('total_price');

        // تغییر 'with('orderDetails') به 'with('foods')'
        $orders = $ordersQuery->with(['foods' => function($query) {
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




}
