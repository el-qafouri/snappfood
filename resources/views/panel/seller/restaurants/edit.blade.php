@extends('panel.seller.restaurants.layouts.main')
@section('title', 'restaurant edit')
@section('content')

    <div class="container">
        <form action="{{ route('restaurant.update' , $restaurant->id) }}" method="POST"
              class="d-flex flex-column gap-3 mt-4">
            @csrf
            @method('PUT')
            <div class="form-group">

                <label for="restaurant_name">restaurant Name</label>
                <input
                    value="{{ old('restaurant_name', $restaurant->restaurant_name) }}"
                    {{--                    value="{{ $category->name }}"--}}
                    type="text"
                    class="form-control @error('restaurant_name') is-invalid @enderror"
                    id="restaurant_name"
                    name="restaurant_name"
                    {{--                    placeholder="Enter category name"--}}
                />
                @error('restaurant_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">
                <label for="phone">phone</label>
                <input
                    value="{{ old('phone' , $restaurant->phone) }}"
                    type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    id="phone"
                    name="phone"
                    placeholder="Enter phone"
                />
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="credit_card_number">credit card</label>
                <input
                    {{--                    value="{{  $category->description  }}"--}}
                    value="{{ old('credit_card_number' , $restaurant->credit_card_number) }}"
                    type="text"
                    class="form-control @error('credit_card_number') is-invalid @enderror"
                    id="credit_card_number"
                    name="credit_card_number"
                    {{--                    placeholder="Enter description"--}}
                />
                @error('credit_card_number')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">address</label>
                <input
                    {{--                    value="{{  $category->description  }}"--}}
                    value="{{ old('address' , $restaurant->address) }}"
                    type="text"
                    class="form-control @error('address') is-invalid @enderror"
                    id="address"
                    name="address"
                    {{--                    placeholder="Enter description"--}}
                />
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="send_cost">send cost</label>
                <input
                    {{--                    value="{{  $category->description  }}"--}}
                    value="{{ old('send_cost' , $restaurant->send_cost) }}"
                    type="text"
                    class="form-control @error('send_cost') is-invalid @enderror"
                    id="send_cost"
                    name="send_cost"
                    {{--                    placeholder="Enter description"--}}
                />
                @error('send_cost')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            {{--            <div class="form-group">--}}
            {{--                <label for="restaurant_category_id">restaurant category</label>--}}
            {{--                <select--}}
            {{--                    class="form-control @error('category') is-invalid @enderror"--}}
            {{--                    id="restaurant_category_id"--}}
            {{--                    name="restaurant_category_id"--}}
            {{--                    required--}}
            {{--                >--}}
            {{--                    <option value="" selected disabled>Select category</option>--}}

            {{--                    @foreach($restaurantCategories as $restaurantCategory)--}}
            {{--                        <option value="{{$restaurantCategory->id}}">{{$restaurantCategory->name}}</option>--}}
            {{--                    @endforeach--}}
            {{--                    --}}{{--                                        <option value="{{$foodCategory->id}}">{{$foodCategory->name}}</option>--}}
            {{--                </select>--}}
            {{--                @error('category')--}}
            {{--                <div class="alert alert-danger">{{ $message }}</div>--}}
            {{--                @enderror--}}
            {{--            </div>--}}


            <div class="form-group">
                <label for="restaurant_category_id">Restaurant Category</label>
                <select class="form-control @error('restaurant_category_id') is-invalid @enderror"
                        id="restaurant_category_id" name="restaurant_category_id" required>
                    <option value="" selected disabled>Select category</option>
                    @foreach($restaurantCategories as $restaurantCategory)
                        <option value="{{$restaurantCategory->id}}"
                                @if($restaurantCategory->id == $restaurant->restaurant_category_id)
                                    selected
                            @endif
                        >{{$restaurantCategory->name}}
                        </option>
                    @endforeach
                </select>
                @error('restaurant_category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
