@extends('panel.admin.layouts.main')
@section('title', 'create category')
@section('content')
    <div class="container">

        <form action="{{ route('category.store') }}" method="POST" class="d-flex flex-column gap-3 mt-4">
            @csrf
            <div class="form-group">

                <label for="title">Category Name</label>
                <input
                    value="{{ old('name') }}"
                    type="text"
                    class="form-control @error('nane') is-invalid @enderror"
                    id="name"
                    name="name"
                    placeholder="Enter Category name"
                />
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input
                    value="{{ old('description') }}"
                    type="text"
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    placeholder="Enter Description"
                />
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">


                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
