@extends('panel.admin.banners.layouts.main')
@section('title', 'create banner')
@section('content')
    <div class="container">

        <form action="{{ route('banner.store') }}" method="POST" class="d-flex flex-column gap-3 mt-4">
            @csrf
            <div class="form-group">

                <label for="discount">discount</label>
                <input
                    value=""
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


            <div class="form-group">
                <label for="start_time">start at</label>
                <input
                    value="{{ old('start-at') }}"
                    type="datetime-local"
                    class="form-control @error('start_time') is-invalid @enderror"
                    id="start_time"
                    name="start_time"
                    placeholder="Enter start time"
                />
                @error('start_time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">


                <div class="form-group">
                    <label for="end_time">end at</label>
                    <input
                        value="{{ old('end_time') }}"
                        type="datetime-local"
                        class="form-control @error('end_time') is-invalid @enderror"
                        id="end_time"
                        name="end_time"
                        placeholder="Enter end time"
                    />
                    @error('end_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">


                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>

@endsection
