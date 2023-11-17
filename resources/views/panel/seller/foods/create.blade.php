@extends('panel.seller.layouts.main')
@section('title', 'create food')
@section('content')
    <div class="container">

        <form action="{{ route('food.store') }}" method="POST" class="d-flex flex-column gap-3 mt-4">
            @csrf
            <div class="form-group">

                <label for="title">food Name</label>
                <input
                    value="{{ old('name') }}"
                    type="text"
                    class="form-control @error('nane') is-invalid @enderror"
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
{{--                    <option value="{{$foodCategory->id}}">{{$foodCategory->name}}</option>--}}
                </select>
                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

{{--                    <option value="" selected disabled>Select Category</option>--}}
{{--                    @foreach($foodCategories as $foodCategory)--}}
{{--                        <option value="{{ $foodCategory->id }}">{{ $foodCategory->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @error('food_category_id')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}


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



            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
