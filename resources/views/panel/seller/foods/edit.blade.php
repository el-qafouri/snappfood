@extends('panel.seller.layouts.main')
@section('title', 'edit')
@section('content')

    <div class="container">
        <form action="{{ route('food.update' , $food->id) }}" method="POST" class="d-flex flex-column gap-3 mt-4">
            @csrf
            @method('PUT')
            <div class="form-group">

                <label for="name">Food Name</label>
                <input
                    value="{{ old('name', $food->name) }}"
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
                <label for="price">price</label>
                <input
                    value="{{ old('price' , $food->price) }}"
                    type="text"
                    class="form-control @error('price') is-invalid @enderror"
                    id="price"
                    name="price"
                    placeholder="Enter price"
                />
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="material">material</label>
                <input
                    {{--                    value="{{  $category->description  }}"--}}
                    value="{{ old('material' , $food->material) }}"
                    type="text"
                    class="form-control @error('material') is-invalid @enderror"
                    id="material"
                    name="material"
                    {{--                    placeholder="Enter description"--}}
                />
                @error('material')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="food_category_id">food category</label>
                <select
                    class="form-control @error('category') is-invalid @enderror"
                    id="food_category_id"
                    name="food_category_id"
                    required
                >
                    <option value="" selected disabled>Select category</option>

                    @foreach($foodCategories as $foodCategory)
                        <option value="{{$foodCategory->id}}">{{$foodCategory->name}}</option>
                    @endforeach
{{--                                        <option value="{{$foodCategory->id}}">{{$foodCategory->name}}</option>--}}
                </select>
                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="discount_id">food discount</label>
                <input
                    {{--                    value="{{  $category->description  }}"--}}
                    value="{{ old('discount_id' , $food->discount_id) }}"
                    type="text"
                    class="form-control @error('discount_id') is-invalid @enderror"
                    id="discount_id"
                    name="discount_id"
                    {{--                    placeholder="Enter description"--}}
                />
                @error('discount_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
