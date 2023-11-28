{{--@extends('panel.seller.layouts.main')--}}
{{--@section('title', 'show food')--}}
{{--@section('content')--}}

{{--    <div class="showFood" style="margin-top: 25px;">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}


{{--                <div class="col-md-6">--}}
{{--                    @if ($food->image_path)--}}
{{--                        <img src="{{ asset('food/' . $food->image_path) }}" class="img-fluid" alt="Food Image" style=" margin-bottom: 10px; margin-left: auto;">--}}
{{--                    @else--}}
{{--                        <p>No image available</p>--}}
{{--                    @endif--}}
{{--                </div>--}}


{{--                <div class="col-md-6">--}}
{{--                    <br>--}}
{{--                    <h1>food name: {{ $food->name }}</h1>--}}
{{--                    <p>material: {{ $food->material }}</p>--}}
{{--                    <p>price: {{ $food->price }}</p>--}}

{{--                    <p>Food Categories:</p>--}}
{{--                    <ul>--}}
{{--                        @if ($food->foodCategories->count() > 0)--}}
{{--                            @foreach($food->foodCategories as $foodCategory)--}}
{{--                                <li>{{ $foodCategory->name }}</li>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <li>No categories found</li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}

{{--                    <p>created at: {{ $food->created_at }}</p>--}}
{{--                    <p>food discount: {{ $food->discount->discount }}</p>--}}

{{--                    <p>food discount: {{ $food->discount ? $food->discount->discount : 'No discount available' }}</p>--}}

{{--                    <a href="{{ route('food.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>--}}

{{--                    <hr>--}}

{{--                    <h3>Comments:</h3>--}}
{{--                    @if ($food->comments->count() > 0)--}}
{{--                        <ul>--}}
{{--                            @foreach($food->comments as $comment)--}}
{{--                                <li>--}}
{{--                                    <strong>{{ $comment->user->name }}</strong>--}}
{{--                                    <p>{{ $comment->message }}</p>--}}
{{--                                    <p>Score: {{ $comment->score }}</p>--}}
{{--                                    <p>Created at: {{ $comment->created_at }}</p>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @else--}}
{{--                        <p>No comments available</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    --}}
{{--@endsection--}}


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

                    <h3>Comments:</h3>
                    @if ($food->comments->count() > 0)
                        <ul>
                            @foreach($food->comments as $comment)
                                <li>
                                    <strong>{{ $comment->user->name }}</strong>
                                    <p>{{ $comment->message }}</p>
                                    <p>Score: {{ $comment->score }}</p>
                                    <p>Created at: {{ $comment->created_at }}</p>

                                    {{-- دکمه Answer --}}
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#answerModal{{ $comment->id }}">
                                        Answer
                                    </button>

                                    {{-- دکمه Accept --}}
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#acceptModal{{ $comment->id }}">
                                        Accept
                                    </button>

                                    {{-- دکمه Delete --}}
{{--                                    @can('delete-comment', $comment)--}}
                                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $comment->id }}">
                                            Delete
                                        </button>
                                    </form>
{{--                                    @endcan--}}
                                </li>

                                {{-- مدال Answer --}}
                                <div class="modal fade" id="answerModal{{ $comment->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="answerModalLabel{{ $comment->id }}" aria-hidden="true">
                                    {{-- ... محتوای مدال --}}
                                </div>

                                {{-- مدال Accept --}}
                                <div class="modal fade" id="acceptModal{{ $comment->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="acceptModalLabel{{ $comment->id }}" aria-hidden="true">
                                    {{-- ... محتوای مدال --}}
                                </div>

                                {{-- مدال Delete --}}
                                <div class="modal fade" id="deleteModal{{ $comment->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="deleteModalLabel{{ $comment->id }}" aria-hidden="true">
                                    {{-- ... محتوای مدال --}}
                                </div>
                            @endforeach
                        </ul>
                    @else
                        <p>No comments available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
