@extends('panel.seller.discounts.layouts.main')
@section('title', 'discount')
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
                <th scope="col">Discount</th>
                <th scope="col">start time</th>
                <th scope="col">end time</th>
                <th scope="col">actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($discounts as $discount)
                <tr>
                    {{-- max length of title is 20 characters --}}
                    <td>{{ Str::limit($discount->discount, 20) }}</td>
                    <td>{{ $discount->start_time }}</td>
                    <td>{{ $discount->end_time }}</td>

                    <td>
{{--                        <a href="{{ route('foodParty.show', $foodParty->id) }}" class="btn btn-success"><i--}}
{{--                                class="fas fa-eye"></i> Show</a>--}}
                        <a href="{{ route('discount.edit', $discount->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('discount.delete', $discount->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                    class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

{{--    <div class="table-responsive">--}}
{{--        {{ $foodParties->links() }}--}}
{{--    </div>--}}

@endsection
