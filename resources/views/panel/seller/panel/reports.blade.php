@extends('panel.seller.panel.layouts.main')
@section('title', 'reports')
@section('content')


{{--<h1>گزارش فروش</h1>--}}

{{-- لینک‌های فیلترهای زمانی --}}
{{--<div class="btn-group" role="group" aria-label="Basic example">--}}
{{--    <a href="{{ route('reports.index', ['filter' => 'today']) }}" class="btn btn-outline-primary">امروز</a>--}}
{{--    <a href="{{ route('reports.index', ['filter' => 'this_week']) }}" class="btn btn-outline-primary">این هفته</a>--}}
{{--    <a href="{{ route('reports.index', ['filter' => 'this_month']) }}" class="btn btn-outline-primary">این ماه</a>--}}
{{--</div>--}}

{{-- استخراج آمار کلی --}}
{{--<p>تعداد کل سفارشات: {{ $totalOrders }}</p>--}}
{{--<p>مجموع فروش: {{ $totalSales }}</p>--}}


{{--<table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>شماره سفارش</th>--}}
{{--        <th>تاریخ</th>--}}
{{--        <th>جزئیات</th>--}}
{{--        <th>جمع کل</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}


{{--    <table class="table table-striped mt-5">--}}
{{--        <thead>--}}
{{--        <tr class="table-primary">--}}
{{--            <th>شماره سفارش</th>--}}
{{--            <th>تاریخ</th>--}}
{{--            <th>جزئیات</th>--}}
{{--            <th>جمع کل</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($orders as $order)--}}
{{--            <tr>--}}
{{--                <td>{{ $order->id }}</td>--}}
{{--                <td>{{ $order->created_at->toDateString() }}</td>--}}
{{--                <td>--}}
{{--                    @foreach($order->foods as $food)--}}
{{--                        <p>{{ $food->name }} - تعداد: {{ $food->pivot->count }}</p>--}}
{{--                    @endforeach--}}
{{--                </td>--}}
{{--                <td>{{ $order->total_price }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}







<div class="container my-5">
    <h1 class="text-center mb-3">گزارش فروش</h1>

    {{-- لینک‌های فیلترهای زمانی --}}
    <div class="btn-group d-flex justify-content-center mb-4" role="group" aria-label="Basic example">
        <a href="{{ route('reports.index', ['filter' => 'today']) }}" class="btn btn-outline-primary mx-1">امروز</a>
        <a href="{{ route('reports.index', ['filter' => 'this_week']) }}" class="btn btn-outline-primary mx-1">این هفته</a>
        <a href="{{ route('reports.index', ['filter' => 'this_month']) }}" class="btn btn-outline-primary mx-1">این ماه</a>

        <a href="{{ route('reports.index', ['filter' => 'all']) }}" class="btn btn-outline-primary mx-1">همه سفارش‌ها</a>


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
</div>


<hr>

<a href="{{ route('reports.export') }}" class="btn btn-success">دانلود اکسل</a>

@endsection
