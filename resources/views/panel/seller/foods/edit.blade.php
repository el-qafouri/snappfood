@extends('panel.seller.layouts.main')
@section('title', 'edit')
@section('content')

    <div class="container">
        <form action="{{ route('food.update' , $food->id) }}" method="POST" class="d-flex flex-column gap-3 mt-4"
              enctype="multipart/form-data">
            @csrf
            @method('PUT');

            <div class="d-flex flex-wrap">
                <div class="half-width">
                    @if ($food->image_path)
                        <img src="{{ asset('food/' . $food->image_path) }}" class="img-fluid food-image"
                             alt="Food Image">
                    @else
                        <h3 style="margin-top: 220px; margin-left: 110px; color: #3c77d1;">No image available</h3>
                    @endif
                </div>

                <div class="half-width">

                    <div class="form-group mb-3">
                        <label for="name">Food Name</label>
                        <input
                            value="{{ old('name', $food->name) }}"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                        />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Price</label>
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

                    <div class="form-group mb-3">
                        <label for="material">Material</label>
                        <input
                            value="{{ old('material' , $food->material) }}"
                            type="text"
                            class="form-control @error('material') is-invalid @enderror"
                            id="material"
                            name="material"
                        />
                        @error('material')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Food Categories</label>
                        <div>
                            @foreach($foodCategories as $foodCategory)
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="food_category_id[]" value="{{ $foodCategory->id }}"
                                        {{ in_array($foodCategory->id, old('food_category_id', $food->foodCategories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    {{ $foodCategory->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('food_category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_id">Food Discount</label>
                        <select
                            class="form-control @error('discount_id') is-invalid @enderror"
                            id="discount_id"
                            name="discount_id"
                        >
                            <option value="" selected disabled>Select food discount</option>
                            @foreach($discounts as $discount)
                                <option
                                    value="{{ $discount->id }}" {{ old('discount_id', $food->discount_id) == $discount->id ? 'selected' : '' }}>
                                    {{ $discount->discount }}
                                </option>
                            @endforeach
                        </select>
                        @error('discount_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style=" margin-left: 100px">
                        <label for="imagePath">Upload new image</label>
                        <input type="file" name="imagePath" accept="image/*" class="form-control">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-bottom: 100px">Submit</button>
        </form>
    </div>

    <style>
        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }

        .half-width {
            width: 40%;
        }

        .food-image {
            width: 100%;
            margin-bottom: 10px;
            margin-left: auto;
        }

        .form-group {
            margin-left: 100px;
            margin-top: 25px;
        }
    </style>

@endsection
