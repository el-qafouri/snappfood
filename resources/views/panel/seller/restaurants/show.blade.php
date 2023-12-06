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

                    <p>Restaurant Categories:</p>
                    <ul>
                        @if ($restaurant->restaurantCategories->count() > 0)
                            @foreach($restaurant->restaurantCategories as $restaurantCategory)
                                <li>{{ $restaurantCategory->name }}</li>
                            @endforeach
                        @else
                            <li>No categories found</li>
                        @endif
                    </ul>

                    <p>join at: {{ $restaurant->created_at }}</p>
{{--                    <p>open time: {{ $restaurant->open_time }}</p>--}}
{{--                    <p>close time: {{ $restaurant->close_time }}</p>--}}



                    @if ($restaurant->schedules->count() > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">روز</th>
                                <th scope="col">زمان شروع</th>
                                <th scope="col">زمان پایان</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- In your Blade template -->
                            @foreach($restaurant->schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ date('H:i', strtotime($schedule->open_time)) }}</td>
                                    <td>{{ date('H:i', strtotime($schedule->close_time)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>برنامه زمانی برای نمایش وجود ندارد.</p>
                    @endif







                    <div class="container">
                        <h4 style="color: blue">Restaurant Profile Status</h4>
{{--                        <form action="#" method="post">--}}
                            <form action="{{ route('restaurant.updateProfileStatus', $restaurant->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="profile_status"
                                           value="1" {{ $restaurant->profile_status ? 'checked' : '' }}>
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
