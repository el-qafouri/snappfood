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



