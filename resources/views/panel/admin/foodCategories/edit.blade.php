@extends('panel.admin.layouts.main')
@section('title', 'create')
@section('content')

    <div class="container">
        <form action="{{ route('category.update' , $foodCategory->id) }}" method="POST" class="d-flex flex-column gap-3 mt-4">
            @csrf
            @method('PUT')
            <div class="form-group">

                <label for="name">Category Name</label>
                <input
                    value="{{ old('name', $foodCategory->name) }}"
{{--                    value="{{ $category->name }}"--}}
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
{{--                    placeholder="Enter category name"--}}
                />
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input
{{--                    value="{{  $category->description  }}"--}}
                    value="{{ old('description' , $foodCategory->description) }}"
                    type="text"
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
{{--                    placeholder="Enter description"--}}
                />
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
