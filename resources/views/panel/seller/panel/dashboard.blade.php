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
 <tr>
                <td>Comments</td>
                <td>
                    <a href="" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            </tbody>
        </table>
    </div>


@endsection








