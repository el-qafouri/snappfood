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

{{--            <div class="form-group">--}}
{{--                <label for="address">address</label>--}}
{{--                <input--}}
{{--                    --}}{{--                    value="{{  $category->description  }}"--}}
{{--                    value="{{ old('address' , $restaurant->address) }}"--}}
{{--                    type="text"--}}
{{--                    class="form-control @error('address') is-invalid @enderror"--}}
{{--                    id="address"--}}
{{--                    name="address"--}}
{{--                    --}}{{--                    placeholder="Enter description"--}}
{{--                />--}}
{{--                @error('address')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}

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


            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع رستوران را انتخاب کنید</label>
                @foreach($restaurantCategories as $restaurantCategory)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="restaurant_category_{{ $restaurantCategory->id }}"
                               name="restaurant_category_ids[]" value="{{ $restaurantCategory->id }}"
                               class="mr-2"
                               @if(in_array($restaurantCategory->id, old('restaurant_category_ids', $restaurant->restaurantCategories->pluck('id')->toArray())))
                                   checked
                            @endif>

                        <label for="restaurant_category_{{ $restaurantCategory->id }}">
                            {{ $restaurantCategory->name }}
                        </label>
                    </div>
                @endforeach
                @error('restaurant_category_ids')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>




            <div class="form-group">
                <label for="map_location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">موقعیت
                    مکانی رستوران</label>
                <button type="submit"
                        class="w-full text-black bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        formaction="{{ route('restaurant.editLocation' , $restaurant->id) }}" formmethod="post">انتخاب موقعیت مکانی از
                    روی نقشه
                </button>
            </div>





            @foreach (App\Enums\Day::getValues() as $day)
                @php

                    $schedule = $restaurant->schedules->where('day', $day)->first();
                @endphp
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $day }}" id="day-{{ $day }}" name="days[]" {{ $schedule ? 'checked' : '' }}>
                        <label class="form-check-label" for="day-{{ $day }}">
                            {{ \App\Enums\Day::getDescription($day) }}
                        </label>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="open-time-{{ $day }}">Open Time</label>
                            <input type="time" class="form-control" id="open-time-{{ $day }}" name="open_times[{{ $day }}]" value="{{ $schedule ? $schedule->open_time->format('H:i') : '' }}">


                        </div>
                        <div class="col">
                            <label for="close-time-{{ $day }}">Close Time</label>
                            <input type="time" class="form-control" id="close-time-{{ $day }}" name="close_times[{{ $day }}]" value="{{ $schedule ? $schedule->close_time->format('H:i') : '' }}">
                        </div>
                    </div>
                </div>
            @endforeach



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
