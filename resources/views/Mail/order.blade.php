@extends('panel.seller.layouts.main')
@section('title', 'foods')
@section('content')
{{--    <div class="container">--}}
{{--        @if(session()->has('success'))--}}
{{--            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"--}}
{{--                 style="margin-top: 20px;">--}}
{{--                <strong>Success!</strong> {{ session()->get('success') }}--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--            </div>--}}

{{--            <script>--}}
{{--                setTimeout(function () {--}}
{{--                    $('#success-alert').fadeOut('slow');--}}
{{--                }, 2000);--}}
{{--            </script>--}}
{{--        @endif--}}
{{--        <table class="table table-striped mt-5">--}}
{{--            <thead class="table-dark">--}}
{{--            <tr>--}}
{{--                <th scope="col">order number</th>--}}
{{--                <th scope="col">food</th>--}}
{{--                <th scope="col">delivered address</th>--}}
{{--                <th scope="col">food level</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($orders as $order)--}}
{{--                @foreach($order->foods as $food)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $food->id }}</td>--}}
{{--                        <td>{{ $food->name }}</td>--}}
{{--                        <td>{{ $food->order->address }}</td>--}}
{{--                        <td>address</td>--}}
{{--                        <td>--}}
{{--                            @if($order->food_level == 'pending')--}}
{{--                                <a href="" class="btn btn-success"><i--}}
{{--                                        class="fas fa-eye"></i> pending</a>--}}
{{--                            @elseif($order->food_level == 'preparing')--}}
{{--                                <a href="" class="btn btn-primary"><i--}}
{{--                                        class="fas fa-edit"></i> preparing</a>--}}
{{--                            @elseif($order->food_level == 'delivered')--}}
{{--                                <a href="" class="btn btn-primary"><i--}}
{{--                                        class="fas fa-edit"></i> delivered</a>--}}
{{--                            @elseif($order->food_level == 'send')--}}
{{--                                <a href="" class="btn btn-success"><i--}}
{{--                                        class="fas fa-eye"></i> send</a>--}}
{{--                        @endif--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--@endsection--}}




    <div class="container">
        @if(session()->has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
                 style="margin-top: 20px;">
                <strong>Success!</strong> {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                setTimeout(function () {
                    $('#success-alert').fadeOut('slow');
                }, 2000);
            </script>
        @endif
        <table class="table table-striped mt-5">
            <thead class="table-dark">
            <tr>
                <th scope="col">Order Number</th>
                <th scope="col">Food</th>
                <th scope="col">Delivered Address</th>
                <th scope="col">Food Level</th>
{{--                <th scope="col">Actions</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                @foreach($order->foods as $food)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $food->name }}</td>
                        <td>{{ $order->address }}</td>
                        <td>
                            @if($order->food_level == 'pending')
                                <span class="badge bg-success">Pending</span>
                            @elseif($order->food_level == 'preparing')
                                <span class="badge bg-primary">Preparing</span>
                            @elseif($order->food_level == 'delivered')
                                <span class="badge bg-primary">Delivered</span>
                            @elseif($order->food_level == 'send')
                                <span class="badge bg-success">Send</span>
                            @endif
                        </td>
                        <td>
                            @if($order->seller_status == 'pending')
                                <a href="#" class="btn btn-success" disabled><i class="fas fa-eye"></i> Next Step</a>
                            @elseif($order->seller_status == 'preparing')
                                <a href="#" class="btn btn-primary" disabled><i class="fas fa-edit"></i> Next Step</a>
                            @elseif($order->seller_status == 'send')
                                <a href="#" class="btn btn-primary" disabled><i class="fas fa-edit"></i> Next Step</a>
                            @elseif($order->seller_status == 'delivered')
                                <a href="#" class="btn btn-success"><i class="fas fa-eye"></i> Next Step</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
