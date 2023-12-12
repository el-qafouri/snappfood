
@extends('panel.seller.layouts.main')
@section('title', 'show food')
@section('content')

    <div class="showFood" style="margin-top: 25px;">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    @if ($food->image_path)
                        <img src="{{ asset('food/' . $food->image_path) }}" class="img-fluid" alt="Food Image"
                             style=" margin-bottom: 10px; margin-left: auto;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <div class="col-md-6">
                    <br>
                    <h1>food name: {{ $food->name }}</h1>
                    <p>material: {{ $food->material }}</p>
                    <p>price: {{ $food->price }}</p>

                    <p>Food Categories:</p>
                    <ul>
                        @if ($food->foodCategories->count() > 0)
                            @foreach($food->foodCategories as $foodCategory)
                                <li>{{ $foodCategory->name }}</li>
                            @endforeach
                        @else
                            <li>No categories found</li>
                        @endif
                    </ul>

                    <p>created at: {{ $food->created_at }}</p>
                    <p>food discount: {{ $food->discount ? $food->discount->discount : 'No discount available' }}</p>

                    <a href="{{ route('food.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        Back</a>

                    <hr>

                </div>
            </div>
        </div>
    </div>

@endsection
