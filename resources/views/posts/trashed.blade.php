@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-primary text-light">Trashed Posts</div>

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
                                <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}"
                                width="90px" height="80px" style="border-radius: 30%">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <a href="{{ route('post.show', [$post->id])}}" class="btn btn-sm btn-primary">View</a>
                            </td>                          
                            <td>
                                <a href="{{ route('post.restore', ['id' => $post->id]) }}" class="btn btn-warning btn-sm">Restore</a>
                            </td>

                            <td>
                                <form action="{{ route('post.kill', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    {{-- Form method spoofing --}}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    

                </tbody>

            </table>
            @else
                <tr>
                    <strong class="text-center">No trashed posts found yet</strong>
                </tr>
            @endif
        </div>
    </div>

@endsection
