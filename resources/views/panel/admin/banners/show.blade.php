{{--@extends('panel.admin.banners.layouts.main')--}}
{{--@section('title', 'Banner')--}}
{{--@section('content')--}}

{{--    <div class="showCategory">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    @if ($banner->image_path)--}}
{{--                        <img src="{{ asset($banner->image_path) }}" alt="Banner Image" class="img-fluid">--}}
{{--                    @else--}}
{{--                        <p>No Image Available</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <br><h3>banner title: <br>{{ $banner->title }}</h3><br>--}}
{{--                    <p>description: <br>{{ $banner->text }}</p>--}}

{{--                    <a href="{{ route('banner.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}



@extends('panel.admin.banners.layouts.main')
@section('title', 'Banner')
@section('content')

    <div class="showCategory">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if ($banner->image)
                        <img src="{{ asset($banner->image) }}" alt="Banner Image" class="img-fluid">
                    @else
                        <p>No Image Available</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <br><h3>banner title: <br>{{ $banner->title }}</h3><br>
                    <p>description: <br>{{ $banner->text }}</p>

                    <a href="{{ route('banner.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
