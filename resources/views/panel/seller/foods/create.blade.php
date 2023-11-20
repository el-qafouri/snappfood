@extends('panel.seller.layouts.main')
@section('title', 'create food')
@section('content')
    <div class="container">

        <form action="{{ route('food.store') }}" method="post" class="d-flex flex-column gap-3 mt-4"
        enctype="multipart/form-data">
            @csrf
            <div class="form-group">

                <label for="name">food Name</label>
                <input
                    value="{{ old('name') }}"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    placeholder="Enter food name"
                />
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="price">price</label>
                <input
                    value="{{ old('price') }}"
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
                    value="{{ old('material') }}"
                    type="text"
                    class="form-control @error('material') is-invalid @enderror"
                    id="material"
                    name="material"
                    placeholder="Enter material"
                />
                @error('material')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

{{--            <div class="form-group">--}}
{{--                <label>Food Categories</label>--}}
{{--                <div>--}}
{{--                    @foreach($foodCategories as $foodCategory)--}}
{{--                        <label class="checkbox-inline">--}}
{{--                            <input type="checkbox" name="food_category_id" value="{{ $foodCategory->id }}">--}}
{{--                            {{ $foodCategory->name }}--}}
{{--                        </label>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                @error('food_category_id')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}




            <div class="form-group">
                <label>Food Categories</label>
                <div>
                    @foreach($foodCategories as $foodCategory)
                        <label class="checkbox-inline">
                            <input type="checkbox" name="food_category_id[]" value="{{ $foodCategory->id }}">
                            {{ $foodCategory->name }}
                        </label>
                    @endforeach
                </div>
                @error('food_category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            {{--            <label for="food_category_id">Food Category:</label>--}}
{{--            <select name="food_category_id[]" multiple>--}}
{{--                @foreach($foodCategories as $category)--}}
{{--                    <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}


            <div class="form-group">
                <label for="discount_id">food discount</label>
                <select
                        class="form-control @error('discount_id') is-invalid @enderror"
                    id="discount_id"
                    name="discount_id"
                >
                    <option value="" selected disabled>Select food discount</option>

                    @foreach($discounts as $discount)
                        <option value="{{$discount->id}}">{{$discount->discount}}</option>
                    @endforeach

                    {{--                    <option value="{{$foodCategory->id}}">{{$foodCategory->name}}</option>--}}
                </select>
                @error('discount')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

{{--            <label for="image">upload image</label>--}}
{{--            <input type="file" name="image" accept="image/*">--}}


            <div class="form-group">
                <label for="imagePath">upload image</label>
                <div class="input-group">
                    <input type="file" name="imagePath" accept="image/*" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
