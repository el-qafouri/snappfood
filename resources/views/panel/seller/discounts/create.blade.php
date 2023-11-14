@extends('panel.seller.discounts.layouts.main')
@section('title', 'create discount')
@section('content')
    <div class="container">

        <form action="{{ route('discount.store') }}" method="POST" class="d-flex flex-column gap-3 mt-4">
            @csrf
            <div class="form-group">

                <label for="discount">discount</label>
                <input
                    value="{{ old('discount') }}"
                    type="text"
                    class="form-control @error('nane') is-invalid @enderror"
                    id="discount"
                    name="discount"
                    placeholder="Enter discount"
                />
                @error('discount')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>

            <input type="hidden" name="restaurant_id" value="{{ auth()->user()->restaurant->id }}">



            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
