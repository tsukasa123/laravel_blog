@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-light">Create Tags</div>

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
        
        <form action="{{ isset($tag)? route('tag.update', [$tag->id]) : route('tag.store') }}" method="post">
            @csrf

            @if(isset($tag))
                @method('PUT')
            @endif
            
            
            <div class="form-group">
                <label>Tag Name</label>
                <input type="text" name="tag" class="form-control" value='{{ isset($tag)? $tag->tag : ""}}'>
            </div>
           
            <div class="form-group">
                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                    {{ isset($tag)? 'Update Tag' : 'Store Tag' }}</button>
                </div>
            </div>
        </form>     
    </div>
</div>





@endsection