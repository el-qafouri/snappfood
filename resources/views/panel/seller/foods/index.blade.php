@extends('panel.seller.layouts.main')
@section('title', 'foods')
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
                <th scope="col">Food Name</th>
                <th scope="col">Material</th>
                <th scope="col">Food category</th>
                {{--                <th scope="col">Price</th>--}}
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($foods as $food)
                <tr>
                    {{-- max length of title is 20 characters --}}
                    <td>{{ Str::limit($food->name, 20) }}</td>
                    <td>{{ $food->material }}</td>
{{--                    <td>{{ $food->food_category_id }}</td>--}}
                    <td>{{ optional($food->foodCategory)->name }}</td>
                    <td>
                        <a href="{{ route('food.show', $food->id) }}" class="btn btn-success"><i
                                class="fas fa-eye"></i> Show</a>
                        <a href="{{ route('food.edit', $food->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('food.delete', $food->id) }}" method="POST" class="d-inline">
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
