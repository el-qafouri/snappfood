@extends('panel.admin.layouts.main')
@section('title', 'food category')
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
                <th scope="col">Food Category Name</th>
                <th scope="col">Description</th>
                <th scope="col">Create Time</th>
                {{--                <th scope="col">Price</th>--}}
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($foodCategories as $foodCategory)
                <tr>
                    {{-- max length of title is 20 characters --}}
                    <td>{{ Str::limit($foodCategory->name, 20) }}</td>
                    <td>{{ $foodCategory->description }}</td>
                    <td>{{ $foodCategory->created_at }}</td>
                    <td>
                        <a href="{{ route('category.show', $foodCategory->id) }}" class="btn btn-success"><i
                                class="fas fa-eye"></i> Show</a>
                        <a href="{{ route('category.edit', $foodCategory->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('category.delete', $foodCategory->id) }}" method="POST" class="d-inline">
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

    <div class="table-responsive">
        {{ $foodCategories->links() }}
    </div>

@endsection
