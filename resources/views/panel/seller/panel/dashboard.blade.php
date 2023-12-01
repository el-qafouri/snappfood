@extends('panel.seller.panel.layouts.main')
@section('title', 'admin dashboard')
@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
                 style="margin-top: 20px ;">
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
            <tbody>
            <tr>
                <td>foods</td>
                <td>
                    <a href="{{ route('food.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>

            <tr>
                <td>discounts</td>
                <td>
                    <a href="{{ route('discount.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>

            <tr>
                <td>orders</td>
                <td>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>

            <tr>
                <td>Reports</td>
                <td>
                    <a href="{{ route('reports.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            </tbody>
        </table>
    </div>

    {{--    @elseif(auth()->user()->restaurant->profile_status== false)--}}
    {{--        <h2>Your profile status is not active. please wait or send email: elham@gmail.com </h2>--}}

    {{--    @else--}}

    {{--        <br>--}}
    {{--        <h1>Welcome!</h1><br>--}}
    {{--        <h2>Sorry! You don't have a restaurant.</h2><br>--}}
    {{--        <h3>Please complete your restaurant data from here!</h3>--}}
    {{--        <a href="{{ route('restaurant.create') }}"--}}
    {{--           class="btn btn-primary">Complete Form</a>--}}
    {{--        <br>--}}
    {{--        <br>--}}
    {{--        <h4>If you complete your restaurant data connect with admin: admin@gmail.com</h4>--}}
    {{--    @endif--}}

@endsection








