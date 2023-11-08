@extends('panel.seller.restaurants.layouts.main')
@section('title', 'show restaurant')
@section('content')

    <div class="showRestaurant">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {{-- gallery images--}}
                    {{--                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">--}}
                    {{--                        <div class="carousel-inner">--}}
                    {{--                            @foreach($galleries as $image)--}}
                    {{--                                                                @dd($image)--}}
                    {{--                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">--}}
                    {{--                                    <img src="{{$image }}" class="d-block w-100"--}}
                    {{--                                         alt="...">--}}
                    {{--                                </div>--}}
                    {{--                            @endforeach--}}
                    {{--                        </div>--}}
                    {{--                        <button class="carousel-control-prev" type="button"--}}
                    {{--                                data-bs-target="#carouselExampleControls" data-bs-slide="prev">--}}
                    {{--                            <span class="carousel-control-prev-icon" aria-hidden="true"><i--}}
                    {{--                                    class="fas fa-chevron-left"></i></span>--}}
                    {{--                            <span class="visually-hidden">Previous</span>--}}
                    {{--                        </button>--}}
                    {{--                        <button class="carousel-control-next" type="button"--}}
                    {{--                                data-bs-target="#carouselExampleControls" data-bs-slide="next">--}}
                    {{--                            <span class="carousel-control-next-icon" aria-hidden="true"><i--}}
                    {{--                                    class="fas fa-chevron-right"></i></span>--}}
                    {{--                            <span class="visually-hidden">Next</span>--}}
                    {{--                        </button>--}}
                    {{--                    </div>--}}
                </div>
                <div class="col-md-6">
                    <h1>{{ $restaurant->restaurant_name }}</h1>
                    <p>phone: {{ $restaurant->phone }}</p>
                    <p>credit card number: {{ $restaurant->credit_card_number }}</p>
                    <p>address: {{ $restaurant->address }}</p>
                    <p>send cost: {{ $restaurant->send_cost }}</p>
                    <p>restaurant category id: {{ $restaurant->restaurant_category_id }}</p>
                    <p>join at: {{ $restaurant->created_at }}</p>

                    {{--                    <div class="form-check form-switch">--}}
                    {{--                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">--}}
                    {{--                        <label class="form-check-label" for="flexSwitchCheckDefault">accept restaurant info</label>--}}
                    {{--                    </div>--}}

                    <div>
                        <form>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Agree to add Restaurant
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit restaurant</button>
                            </div>


{{--                            <input class="btn btn-primary" type="submit" value="Submit">--}}
                        </form>
                    </div>


                    <br><a href="{{ route('restaurant.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        Back</a>


                </div>
            </div>
        </div>
    </div>

@endsection
