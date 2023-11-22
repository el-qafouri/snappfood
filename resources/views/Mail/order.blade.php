@extends('panel.seller.layouts.main')
@section('title', 'orders')
@section('content')
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

                            @if($order->seller_status === 'pending')
                                <form method="post"
                                      action="{{ route('orders.update' , ['order'=>$order , 'newStatus'=>'preparing']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">
                                        <i class="fas fa-eye"></i>Pending
                                    </button>
                                </form>
                            @endif
                        </td>

                        <td>
                            @if($order->seller_status === 'preparing')
                                <form method="post"
                                      action="{{ route('orders.update' , ['order'=>$order , 'newStatus'=>'send']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">
                                        <i class="fas fa-eye"></i>Preparing
                                    </button>
                                </form>
                            @endif
                        </td>

                        <td>
                            @if($order->seller_status === 'send')
                                <form method="post"
                                      action="{{ route('orders.update' , ['order'=>$order , 'newStatus'=>'delivered']) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success">
                                        <i class="fas fa-eye"></i>Send
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>

                    @if($order->seller_status === 'Delivered')
                        <form method="post"
                              action="{{ route('orders.update' , ['order'=>$order , 'newStatus'=>'delivered']) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success">
                                <i class="fas fa-eye"></i>Send
                            </button>
                        </form>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>






    {{--    <script>--}}
    {{--        function nextStage(orderId) {--}}
    {{--            axios.post(`/update-order/${orderId}`, {}, {--}}
    {{--                headers: {--}}
    {{--                    'Content-Type': 'application/json',--}}
    {{--                    'X-CSRF-TOKEN': '{{ csrf_token() }}',--}}
    {{--                }--}}
    {{--            })--}}
    {{--                .then(response => {--}}
    {{--                    console.log(response.data);--}}

    {{--                    // اگر درخواست موفق بود، مرحله سفارش را بروزرسانی کنید و دکمه‌ها را مدیریت کنید--}}
    {{--                    if (response.data.success) {--}}
    {{--                        // بروزرسانی مرحله سفارش--}}
    {{--                        document.getElementById('sellerStatus').innerText = 'preparing'; // یک مثال بسازید--}}

    {{--                        // مدیریت دکمه‌ها--}}
    {{--                        document.getElementById('nextStageBtn').style.display = 'none'; // مثال: مخفی کردن دکمه--}}
    {{--                        document.getElementById('otherBtn').style.display = 'block'; // مثال: نمایش دکمه دیگر--}}
    {{--                    }--}}
    {{--                })--}}
    {{--                .catch(error => {--}}
    {{--                    console.error('Error:', error);--}}
    {{--                    // در صورت خطا، مدیریت خطاها--}}
    {{--                });--}}
    {{--        }--}}
    {{--    </script>--}}

@endsection
