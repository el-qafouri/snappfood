@extends('panel.seller.restaurants.layouts.main')
@section('title', 'show restaurant')
@section('content')

    <div class="showRestaurant">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <h1>{{ $restaurant->restaurant_name }}</h1>
                    <p>phone: {{ $restaurant->phone }}</p>
                    <p>credit card number: {{ $restaurant->credit_card_number }}</p>
                    <p>address: {{ $restaurant->address }}</p>
                    <p>send cost: {{ $restaurant->send_cost }}</p>
                    <p>restaurant category id: {{ $restaurant->restaurant_category_id }}</p>
                    <p>join at: {{ $restaurant->created_at }}</p>

{{--                    <div>--}}
{{--                        <form action="#" method="post">--}}
{{--                            --}}{{--                            <form action="{{ route('restaurant.updateProfileStatus', $restaurant->id) }}" method="post">--}}
{{--                            @csrf--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>--}}
{{--                                    <label class="form-check-label" for="invalidCheck">--}}
{{--                                        Agree to add Restaurant--}}
{{--                                    </label>--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        You must agree before submitting.--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                <button class="btn btn-primary" type="submit">Save restaurant</button>--}}
{{--                            </div>--}}


{{--                            --}}{{--                            <input class="btn btn-primary" type="submit" value="Submit">--}}
{{--                        </form>--}}
{{--                    </div>--}}







                        <div class="container">
                            <h4 style="color: blue">Restaurant Profile Status</h4>
{{--                            <form action="#" method="post">--}}
                            <form action="{{ route('restaurant.updateProfileStatus', $restaurant->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="profile_status" value="1" {{ $restaurant->profile_status ? 'checked' : '' }}>
                                    <label class="form-check-label">Profile Status</label>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save</button>
                            </form>
                        </div>


                    <br><a href="{{ route('restaurant.index') }}" class="btn btn-primary"><i
                            class="fas fa-arrow-left"></i>
                        Back</a>


                </div>
            </div>
        </div>
    </div>

@endsection
