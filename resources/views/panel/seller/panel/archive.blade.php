@extends('panel.seller.layouts.main')
@section('title', 'archive')
@section('content')
    <div class="container-fluid">

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


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <br>
            <h2>Delivered Orders Archive</h2>
            <div class="table-responsive">
                <table class="table table-striped mt-5">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Order Number</th>
                        <th scope="col">Food</th>
                        <th scope="col">Delivered Address</th>
                        <th scope="col">Food Level</th>
                        <th scope="col">Actions</th>
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


                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
@endsection
