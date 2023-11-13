@extends('panel.seller.panel.layouts.main')
@section('title', 'admin dashboard')
@section('content')
    <div class="container">

        <h1><br>Welcome!</h1><br>
        <h2>Sorry! You don't have a restaurant.</h2><br>
        <h3>Please complete your restaurant data from here!</h3>
        <a href="{{ route('restaurant.create') }}"
           class="btn btn-primary">Complete Form</a>
        <br>
        <br>
        <h4>If you complete your restaurant data connect with admin: admin@gmail.com</h4>
    </div>
@endsection
