<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

</head>
<body>
    <div id="app">

        @include('inc.navbar')

        <div class="container py-4">


            @if(Auth::check())
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('category.create') }}">Create Category</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('category.index') }}">All Categories</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.index') }}">Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.create') }}">New Post</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.trashed') }}">Trashed Post</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('setting.index') }}">Settings</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('user.profile') }}">My Profile</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>

        </div>
    </div>

    <!-- scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>

</body>
</html>
