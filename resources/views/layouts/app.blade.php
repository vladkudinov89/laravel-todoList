<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/tasks') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>


            </div>
        </div>
    </nav>

    <main class="py-1">
        <div class="container">

            <ul class="nav m-3 justify-content-between">
               <ul class="nav">
                <li><a class="btn btn-outline-primary mr-2" href="{{route('tasks.index')}}">Tasks List</a></li>
                <li><a class="btn btn-outline-success" href="{{route('tasks.create')}}">Add</a></li>
               </ul>

                <li>
                    <form class="form-inline my-2 my-lg-0" action="{{route('tasks.search')}}" method="post">

                        {{csrf_field()}}

                        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" id="search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    @error('search')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </li>
            </ul>

            @yield('content')

        </div>
    </main>
</div>
</body>
</html>
