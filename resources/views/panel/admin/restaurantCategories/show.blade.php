@extends('panel.admin.restaurantCategories.layouts.main')
@section('title', 'show restaurant category')
@section('content')


    <div class="showCategory">
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
                    <h1>{{ $restaurantCategory->name }}</h1>
                    <p>{{ $restaurantCategory->description }}</p>
                    <p>{{ $restaurantCategory->created_at }}</p>
                    <a href="{{ route('restaurantCategory.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
