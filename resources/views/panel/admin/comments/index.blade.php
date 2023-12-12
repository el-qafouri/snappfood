@extends('panel.admin.panel.layouts.main')
@section('title', 'admin dashboard')
@section('content')
    <div class="container">

        <!-- Display Success Messages -->
        @if(session()->has('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
                 style="margin-top: 20px;">
                <strong>Success!</strong> {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="container">
            <table class="table table-striped mt-5">
                <thead class="table-dark">
                <tr>
                    <th scope="col">index</th>
                    <th scope="col">Message</th>
                    <th scope="col">score</th>
                    <th scope="col">Status</th>
                    <th scope="col">Change Status</th>
                    <th scope="col">Change Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $key=>$comment)
                    <tr>
                        <td>{{ $key+1 }}</td>

                        <td>{{ $comment->message }}</td>
                        <td>{{ $comment->score }}</td>
                        <td>{{ $comment->status }}</td>

                        <td>
                            <form method="post"
                                  action="{{ route('comments.update' , ['comment'=>$comment , 'status'=>'accept']) }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success">Accept</button>
                            </form>
                        </td>

                        <td>
                            <form method="post"
                                  action="{{ route('comments.destroy' , $comment) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-success">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection








