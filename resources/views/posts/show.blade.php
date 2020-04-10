@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="card-title text-center font-weight-bold"> {{ $post->title }}</div>
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}"
            width="100%" height="250px">
            <p class="card-text mt-3">{{ $post->description }}</p>
            <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-sm btn-primary">Edit</a>
        </div>
        
    </div>

@stop