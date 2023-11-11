@extends('panel.seller.panel.layouts.main')
@section('title', 'admin dashboard')
@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
                 style="margin-top: 20px ;">
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
            {{--            <thead class="table-dark">--}}
            {{--            <tr>--}}
            {{--                <th scope="col">Discount</th>--}}
            {{--                <th scope="col">start time</th>--}}
            {{--                <th scope="col">end time</th>--}}
            {{--                <th scope="col">actions</th>--}}

            {{--            </tr>--}}
            {{--            </thead>--}}
            <tbody>
            {{--            @foreach($foodParties as $foodParty)--}}
            <tr>
                {{-- max length of title is 20 characters --}}
                {{--                    <td>{{ Str::limit($foodParty->discount, 20) }}</td>--}}
                {{--                    <td>{{ $foodParty->start_time }}</td>--}}
                {{--                    <td>{{ $foodParty->end_time }}</td>--}}
                <td>foods</td>

                <td>
                    {{--                        <a href="{{ route('foodParty.show', $foodParty->id) }}" class="btn btn-success"><i--}}
                    {{--                                class="fas fa-eye"></i> Show</a>--}}
                    {{--                    <a href="{{ route('foodParty.edit', $foodParty->id) }}" class="btn btn-primary"><i--}}
                    {{--                            class="fas fa-edit">--}}
                    <a href="{{ route('food.index') }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>

            <tr>
                <td>discounts</td>
                <td>
                    <a href="#" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>



            <tr>
                <td>orders</td>
                <td>
                    <a href="#" class="btn btn-primary"><i
                            class="fas fa-edit"></i>show</a>
                </td>
            </tr>


            {{--            @endforeach--}}
            </tbody>
        </table>
    </div>

    {{--    <div class="table-responsive">--}}
    {{--        {{ $foodParties->links() }}--}}
    {{--    </div>--}}
    {{--    <form action="{{route('logout')}}" method="post">--}}
    {{--        @csrf--}}
    {{--        <button type="submit">Logout</button>--}}
    {{--    </form>--}}
@endsection







