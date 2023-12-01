@extends('panel.admin.panel.layouts.main')
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
                <td>Food Category</td>

                <td>
                    <a href="{{ route('category.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>

            <tr>
                <td>Restaurant Category</td>
                <td>
                    <a href="{{ route('restaurantCategory.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            <tr>
                <td>Restaurants</td>
                <td>
                    <a href="{{ route('restaurant.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>



            <tr>
                <td>Banners</td>
                <td>
                    <a href="{{ route('banner.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            <tr>
                <td>Food Parties</td>
                <td>
                    <a href="{{ route('foodParty.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            <tr>
                <td>Reports</td>
                <td>
                    <a href="{{ route('reports.index') }}" class="btn btn-primary"><i class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            <tr>
                <td>Comments</td>
                <td>
                    <a href="" class="btn btn-primary"><i class="fas fa-edit"></i>show</a>
                </td>
            </tr>






{{--            @foreach($foods as $food)--}}
{{--                <tr>--}}
{{--                    <td>{{ $food->name }}</td>--}}
{{--                    <td>--}}
{{--                        <a href="{{ route('food.show', ['id' => $food->id]) }}" class="btn btn-primary">--}}
{{--                            <i class="fas fa-edit"></i> show--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}







            <tr>
                <td>users</td>
                <td>
                    <a href="#" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>

            <tr>
                <td>sellers</td>
                <td>
                    <a href="#" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>




            </tbody>
        </table>
    </div>

    {{--    <div class="table-responsive">--}}
    {{--        {{ $foodParties->links() }}--}}
    {{--    </div>--}}
    {{--    <form action="{{route('logout')}}" method="post">--}}
    {{--        @csrf--}}
    {{--        <button type="submit">Logout</button>--}}
    {{--    </form>--}}
@endsection








