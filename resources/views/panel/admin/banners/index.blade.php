@extends('panel.admin.banners.layouts.main')
@section('title', 'Banner')
@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
                 style="margin-top: 20px;">
                <strong>Success!</strong> {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                setTimeout(function () {
                    $('#success-alert').fadeOut('slow');
                }, 2000);
            </script>
        @endif

        <table class="table table-striped mt-5">
            <thead class="table-dark">
            <tr>
                <th scope="col">title</th>
                <th scope="col">banners image</th>
                <th scope="col">actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($banners as $banner)
                <tr>
{{--                     max length of title is 20 characters--}}
                    <td>{{ Str::limit($banner->title, 20) }}</td>
                    <td>
                        <!-- افزودن تگ img برای نمایش تصویر -->
                        <img src="{{ asset($banner->image) }}"  width="50" height="50">
                    </td>


                    <td>
                        <a href="{{ route('banner.index', $banner->id) }}" class="btn btn-success"><i
                                class="fas fa-eye"></i> Show</a>
{{--                    </td>--}}
{{--                        <td>--}}
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Edit</a>
                    </td>
                    <td>
                        <!-- فرم حذف بنر -->
                        <form action="{{ route('banner.destroy', $banner->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{--    <div class="table-responsive">--}}
    {{--        {{ $banner->links() }}--}}
    {{--    </div>--}}

@endsection
