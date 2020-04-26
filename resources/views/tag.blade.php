@extends('layouts.frontend')
@section('page')

<div class="stunning-header stunning-header-bg-lightviolet">
    <div class="stunning-header-content">
        <h1 class="stunning-header-title">Tag: {{ $title }}</h1>
    </div>
</div>

<!-- End Stunning Header -->

<!-- Post Details -->


<div class="container">
    <div class="row medium-padding120">
        <main class="main">
            
            <div class="row">
                <div class="case-item-wrap">

                    @if(count($tag->posts) > 0)
                        @foreach($tag->posts as $post)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="case-item">
                                    <div class="case-item__thumb">
                                        <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                                    </div>
                                    <h6 class="case-item__title">
                                        <a href="#">{{ $post->title }}</a>
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="text-center">No posts found for tag!</h3>
                        </div>

                    @endif
                    
                </div>
            </div>

        </main>
    </div>
</div>

@endsection