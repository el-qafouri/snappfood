{{--@extends('panel.seller.layouts.main')--}}
{{--@section('title', 'foods')--}}
{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        @if(session()->has('success'))--}}
{{--            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"--}}
{{--                 style="margin-top: 20px;">--}}
{{--                <strong>Success!</strong> {{ session()->get('success') }}--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--            </div>--}}

{{--            <script>--}}
{{--                setTimeout(function () {--}}
{{--                    $('#success-alert').fadeOut('slow');--}}
{{--                }, 2000);--}}
{{--            </script>--}}
{{--        @endif--}}
{{--        <table class="table table-striped mt-5">--}}
{{--            <thead class="table-dark">--}}
{{--            <tr>--}}
{{--                <th scope="col">Food Name</th>--}}
{{--                <th scope="col">Material</th>--}}
{{--                <th scope="col">Food category</th>--}}
{{--                --}}{{--                <th scope="col">Price</th>--}}
{{--                <th scope="col">Actions</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($foods as $food)--}}
{{--                <tr>--}}
{{--                    --}}{{-- max length of title is 20 characters --}}
{{--                    <td>{{ Str::limit($food->name, 20) }}</td>--}}
{{--                    <td>{{ $food->material }}</td>--}}
{{--                    <td>--}}
{{--                        @forelse($food->foodCategories as $category)--}}
{{--                            {{ $category->name }}--}}
{{--                            @if(!$loop->last)--}}
{{--                                ,--}}
{{--                            @endif--}}
{{--                        @empty--}}
{{--                            No categories found--}}
{{--                        @endforelse--}}
{{--                    </td>--}}


{{--                    <h1>Foods with Comments</h1>--}}

{{--                    <table class="table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Food Name</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($foodsWithComments as $food)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $food->name }}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('food.show', ['id' => $food->id]) }}" class="btn btn-primary">--}}
{{--                                        <i class="fas fa-edit"></i> Show--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}


{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--@endsection--}}
@dd('hi');
