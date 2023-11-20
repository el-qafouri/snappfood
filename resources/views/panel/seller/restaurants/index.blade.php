@extends('panel.seller.restaurants.layouts.main')
@section('title', 'restaurants')
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
                <th scope="col">Restaurant Name</th>
                <th scope="col">Address</th>
                <th scope="col">Restaurant Category</th>
                <th scope="col">profile Status</th>
                {{--                <th scope="col">Price</th>--}}
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    {{-- max length of title is 20 characters --}}
                    <td>{{ Str::limit($restaurant->restaurant_name, 20) }}</td>
                    <td>{{ $restaurant->address }}</td>
{{--                    <td>{{ $restaurant->restaurant_category_id }}</td>--}}
{{--                    <td>{{ optional($restaurant->restaurantCategory)->name }}</td>--}}





                    <td>
                        @forelse($restaurant->restaurantCategories as $category)
                            {{ $category->name }}
                            @if(!$loop->last)
                                ,
                            @endif
                        @empty
                            No categories found
                        @endforelse
                    </td>





                    <td>{{ $restaurant->profile_status }}</td>
                    <td>
                        <a href="{{ route('restaurant.show', $restaurant->id) }}" class="btn btn-success"><i
                                class="fas fa-eye"></i> Show</a>
                        <a href="{{ route('restaurant.edit', $restaurant->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('restaurant.delete', $restaurant->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                    class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
