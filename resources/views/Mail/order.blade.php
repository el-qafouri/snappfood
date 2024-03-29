@extends('panel.seller.layouts.main')
@section('title', 'orders')
@section('content')
    <div class="container">
        <!-- ... your existing content ... -->

        <div class="mt-4">
            <form action="{{ route('orders.index') }}" method="get">
                <label for="statusFilter">Filter by Status:</label>
                <select name="seller_status" id="statusFilter" class="form-select">
{{--                    <option value="" selected>All</option>--}}
                    <option value="pending" {{ request('seller_status') === "pending" ? "selected" : "" }}>Pending</option>
                    <option value="preparing" {{ request('seller_status') === "preparing" ? "selected" : "" }}>Preparing</option>
                    <option value="send" {{ request('seller_status') === "send" ? "selected" : "" }}>Send</option>
                </select>
                <input type="submit" value="submit">
            </form>
        </div>

        <!-- Display Success Messages -->
        @if(session()->has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
                 style="margin-top: 20px;">
                <strong>Success!</strong> {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="container">
            <table class="table table-striped mt-5">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Order Number</th>
                    <th scope="col">Foods</th>
                    <th scope="col">Delivered Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Change Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach($order->foods as $food)
                                {{ $loop->first ? '' : ', ' }}
                                {{ $food->name }}
                            @endforeach
                        </td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->seller_status }}</td>
                        <td>
                            <!-- Replace with logic for changing the status -->
                            @if($order->seller_status === 'pending')
                                <form method="post" action="{{ route('orders.update', ['order'=>$order, 'newStatus'=>'preparing']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">Preparing</button>
                                </form>
                            @elseif($order->seller_status === 'preparing')
                                <form method="post" action="{{ route('orders.update', ['order'=>$order, 'newStatus'=>'send']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">Send</button>
                                </form>
                            @elseif($order->seller_status === 'send')
                                <form method="post" action="{{ route('orders.update', ['order'=>$order, 'newStatus'=>'delivered']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">Delivered</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

