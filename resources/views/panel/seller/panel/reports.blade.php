@extends('panel.seller.panel.layouts.main')
@section('title', 'reports')
@section('content')

    <div class="container my-5">
        <h1 class="text-center mb-3">گزارش فروش</h1>

        {{-- لینک‌های فیلترهای زمانی --}}
        <div class="btn-group d-flex justify-content-center mb-4" role="group" aria-label="Basic example">
            <a href="{{ route('reports.index', ['filter' => 'today']) }}" class="btn btn-outline-primary mx-1">امروز</a>
            <a href="{{ route('reports.index', ['filter' => 'this_week']) }}" class="btn btn-outline-primary mx-1">این
                هفته</a>
            <a href="{{ route('reports.index', ['filter' => 'this_month']) }}" class="btn btn-outline-primary mx-1">این
                ماه</a>

            <a href="{{ route('reports.index', ['filter' => 'all']) }}" class="btn btn-outline-primary mx-1">همه
                سفارش‌ها</a>


        </div>

        {{-- استخراج آمار کلی --}}
        <p class="text-center">تعداد کل سفارشات: {{ $totalOrders }}</p>
        <p class="text-center">مجموع فروش: {{ $totalSales }}</p>

        <table class="table table-striped mt-4">
            <thead>
            <tr class="table-primary">
                <th>شماره سفارش</th>
                <th>تاریخ</th>
                <th>جزئیات</th>
                <th>جمع کل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->toDateString() }}</td>
                    <td>
                        @foreach($order->foods as $food)
                            <p>{{ $food->name }} - تعداد: {{ $food->pivot->count }}</p>
                        @endforeach
                    </td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('reports.export-orders') }}" class="btn btn-success">دانلود اکسل</a>
    </div>


    <hr>
    {{--<div style="padding-left: 100px">--}}
    {{--<a href="{{ route('reports.export-orders') }}" class="btn btn-success">دانلود اکسل</a>--}}
    {{--</div>--}}

    <h3 class="text-center">بررسی نمودار فروش</h3>
    <br>





    @php
        $orders = \App\models\Order::orderBy('created_at', 'asc')->get();

        $ordersData = $orders->map(function ($order) {
            return [
                'date' => $order->created_at->format('Y-m-d'),
                'total_sales' => $order->total_price
            ];
        });

        $salesLabels = $ordersData->pluck('date')->all();
        $salesAmounts = $ordersData->pluck('total_sales')->all();
    @endphp

    <canvas id="salesChart"></canvas>
    <script>
        const salesLabels = @json($salesLabels);
        const salesAmounts = @json($salesAmounts);

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'مجموع فروش',
                    data: salesAmounts,
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

    <style>
        #salesChart {
            max-width: 600px;
            max-height: 300px;
            margin: auto;
        }
    </style>

@endsection
