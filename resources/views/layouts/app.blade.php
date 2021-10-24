<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">

    @stack('style')
</head>
<body>
<!-- Top navbar -->
<nav class="container-fluid fixed-top bg-white pt-2" id="top_nav">
    <div class="row">
        <div class="col-4 pl-4">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/images/logo.jpg"></a>
        </div>
        <div class="col-4">
            <form action="{{ route('search') }}" method="get">
                <div class="input-group mb-3">
                    <input name="search" type="text" class="form-control search" placeholder="Search channel or videos">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary" data-toggle="tooltip"
                                data-placement="bottom" title="Search!"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4 text-right">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary"><i class="fas fa-user-circle"
                                                                                  style="font-size: 20px;"></i> <span
                        style="font-size:14px; font-weight: 600;">SIGN IN</span></a>
            @else
                <a href="{{ route('channels.show', auth()->user()->channel->id) }}" class="btn btn-outline-primary"><i
                        class="fas fa-user-circle"
                        style="font-size: 20px;"></i> <span
                        style="font-size:14px; font-weight: 600;">My Channel</span></a>
            @endguest
        </div>
    </div>
</nav>
<!-- Top navbar -->

<!-- mobile top navbar -->
<nav class="container-fluid fixed-top bg-white pt-3" id="top_nav_mobile">
    <div class="row">
        <div class="col-3 pl-4">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="/images/logo.jpg" class="mb-2"></a>
        </div>
        <div class="col-7">
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control search" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom"
                                title="Search!"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2 text-right">
            @guest
                <a href="{{ route('login') }}"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
            @else
                <a href="{{ route('channels.show', auth()->user()->channel->id) }}"><i class="fas fa-user-circle"
                                                                                       style="font-size: 30px;"></i></a>
            @endguest
        </div>
    </div>
</nav>
<!-- mobile top navbar -->

<!-- sidebar -->
<nav class="main-nav {{ request()->routeIs('video.show') ? 'desc_hide' : '' }}">
    <ul>
        <li class="">
            <a href="{{ route('home') }}">
          	<span class="fa fa-2x">
	            <svg style="display: block; height: 24px; width: 24px;margin: auto;" viewBox="0 0 24 24">
				   <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8" fill="red"></path>
				</svg>
			</span>
                <span class="nav-text">
                Home
            </span>
            </a>
        </li>

        @auth
            <li class="has-subnav">
                <a href="{{ route('my.videos') }}">
             <span class="fa fa-2x">
                 <i class="fa fa-video"></i>
			</span>
                    <span class="nav-text">
              My Videos
            </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="{{ route('upload.videos', auth()->user()->channel->id) }}">
             <span class="fa fa-2x">
	            <svg style="display: block; height: 24px; width: 24px;margin: auto;" viewBox="0 0 24 24">
				  <path
                      d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z"
                      fill="#606060"></path>
				</svg>
			</span>
                    <span class="nav-text">
              Upload Video
            </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             <span class="fa fa-2x">
                 <i class="fa fa-sign-out-alt"></i>
			</span>
                    <span class="nav-text">
                Logout
            </span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
</nav>
<!-- sidebar -->

<!-- main content -->
<div class="{{ request()->routeIs('video.show') ? '' : 'row main_container' }}" id="app">
    @yield('content')
</div>
<!-- main content -->

<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    window.authUser = '{!! auth()->user() !!}'

    window.__auth = function () {
        try {
            return JSON.parse(authUser);
        } catch (e) {
            return null;
        }
    }
</script>
<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('success') }}");
    @endif
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('script')
</body>
</html>
