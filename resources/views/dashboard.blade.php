
@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-primary text-light">Posts</div>

        <div class="card-body">
            @if ($posts->count() > 0)
                
            <table class="table table-hover">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th colspan="3">Action</th>
                </thead>
                <tbody>

                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}"
                                width="90px" height="80px" style="border-radius: 30%">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <a href="{{ route('post.show', [$post->id])}}" class="btn btn-sm btn-primary">View</a>
                            </td>

                            @if(Auth::check())
                                <td>
                                    <form action="{{ route('post.destroy', [$post->id]) }}" method="POST">
                                        @csrf
                                        {{-- Form method spoofing --}}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Trash</button>
                                    </form>
                                </td>
                            @endif


                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else

                <strong class="text-center">No posts found yet</strong>

            @endif
        </div>
    </div>

@endsection






{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
