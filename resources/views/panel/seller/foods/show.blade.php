@extends('panel.seller.layouts.main')
@section('title', 'show food')
@section('content')

    <div class="showFood">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <br><h1>food name: {{ $food->name }}</h1>
                    <p>material: {{ $food->material }}</p>
                    <p>price: {{ $food->price }}</p>
{{--                    <p>food category: {{ $food->food_category_id }}</p>--}}
                    <p>food category: {{ optional($food->foodCategory)->name }}</p>
                    <p>created at: {{ $food->created_at }}</p>
                    <p>food discount: {{ $food->discount }}</p>
                    <a href="{{ route('food.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
