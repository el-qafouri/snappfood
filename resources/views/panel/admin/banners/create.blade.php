{{--@extends('panel.admin.banners.layouts.main')--}}
{{--@section('title', 'create banner')--}}
{{--@section('content')--}}
{{--    <div class="container">--}}

{{--        <form action="{{ route('banner.store') }}" method="POST" class="d-flex flex-column gap-3 mt-4">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}

{{--                <div class="form-group">--}}
{{--                    <label for="alt">alt</label>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        class="form-control @error('alt') is-invalid @enderror"--}}
{{--                        id="alt"--}}
{{--                        name="alt"--}}
{{--                        placeholder="Enter alt tag"--}}
{{--                    />--}}
{{--                    @error('alt')--}}
{{--                    <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="title">title</label>--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            class="form-control @error('title') is-invalid @enderror"--}}
{{--                            id="title"--}}
{{--                            name="title"--}}
{{--                            placeholder="Enter title"--}}
{{--                        />--}}
{{--                        @error('title')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}


{{--                        <div class="form-group">--}}
{{--                            <label for="imagePath">upload image</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="file" name="imagePath" accept="image/*" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="form-group">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="link">link</label>--}}
{{--                                <input--}}
{{--                                    type="text"--}}
{{--                                    class="form-control @error('link') is-invalid @enderror"--}}
{{--                                    id="link"--}}
{{--                                    name="link"--}}
{{--                                    placeholder="Enter link"--}}
{{--                                />--}}
{{--                                @error('link')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}


{{--                                <div class="container">--}}
{{--                                    <h4 style="color: blue">Banner Status</h4>--}}
{{--                                    --}}{{----}}{{--                                    <form method="POST" action="{{ route('banner.store') }}">--}}
{{--                                    --}}{{----}}{{--                                        @csrf--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="checkbox" name="is_active">--}}
{{--                                        <label class="form-check-label">Banner Status</label>--}}
{{--                                    </div>--}}
{{--                                    <button type="submit" class="btn btn-primary mt-3">Save</button>--}}
{{--                                </div>--}}
{{--                                --}}{{----}}{{--                                <button type="submit" class="btn btn-primary">Submit</button>--}}

{{--                            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--@endsection--}}



@extends('panel.admin.banners.layouts.main')
@section('title', 'create banner')
@section('content')
    <div class="container">
        <form action="{{ route('banner.store') }}" method="POST" class="d-flex flex-column gap-3 mt-4" enctype="multipart/form-data">
            @csrf


            <div class="form-group">
                <label for="title">title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title"/>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">upload image</label>
                <div class="input-group">
                    <input type="file" name="image"  class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="text">Text</label>
                <input type="text" class="form-control @error('text') is-invalid @enderror" id="text" name="text" placeholder="Enter text"/>
                @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


                <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>
@endsection



{{--@extends('panel.admin.banners.layouts.main')--}}
{{--@section('title', 'create banner')--}}
{{--@section('content')--}}
{{--    <div class="container mx-auto py-8">--}}
{{--        <h1 class="text-3xl font-semibold mb-6">Create Banner</h1>--}}

{{--        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">--}}
{{--            @csrf--}}
{{--            <div class="mb-4">--}}
{{--                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>--}}
{{--                <input type="text" name="title" id="title" class="form-input w-full border rounded-md" required>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label for="text" class="block text-gray-700 text-sm font-bold mb-2">Text:</label>--}}
{{--                <textarea name="text" id="text" class="form-textarea w-full border rounded-md" required></textarea>--}}
{{--            </div>--}}

{{--            <div class="mb-4">--}}
{{--                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>--}}
{{--                <input type="file" name="image" id="image" class="form-input w-full border rounded-md" required>--}}
{{--            </div>--}}

{{--            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                Add Banner--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}
