@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">New Post</div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" cols="30" row="30" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="tags">Select tags</label>
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"
                                @foreach($post->tags as $ta)
                                    @if($tag->id == $ta->id)
                                        checked
                                    @endif
                                @endforeach
                                >{{$tag->tag}}</label>
                        </div>
                    @endforeach 
                </div>
            <div class="form-group">
                <label>Featured Image</label>
                <input type="file" name="featured_img" class="form-control-file">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">Store Post</button>
            </div>
        </form>     
    </div>
</div>





@endsection