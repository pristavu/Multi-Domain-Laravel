<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fontawesome -->
    <script defer src="//use.fontawesome.com/releases/v5.0.9/js/all.js"></script>


    <link rel="stylesheet" href="{{ mix('app_admin/css/app.css') }}">

    <title>@yield('title', 'Demo') - {{ config('app.name') }}</title>
</head>
<body>
<div class="sidebar-main">
    <div class="sidebar-header">
        <a href="{{ domain_route('site.admin.home') }}" title="{{ config('app.name') }}"><img src="{{ asset('site/admin/img/logo.png') }}"></a>
    </div>
    <ul class="sidebar-nav">
        <li class="nav-item active"><a class="item" href="#" title="Dashboard"><i class="icon fas fa-home"></i></a></li>
        <li class="nav-item"><a class="item" href="#" title="Settings"><i class="icon fas fa-cog"></i></a></li>
        <li class="nav-item divider"></li>
        <li class="nav-item filled reverse"><a class="item" href="{{ domain_route('site.home') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout"><i class="icon fas fa-power-off"></i></a></li>
    </ul>
</div>

<nav class="navbar navbar-expand-lg navbar-light justify-content-between">
    <a class="navbar-brand" href="{{ route('admin.home') }}">App Control Panel</a>



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav mr-3">
            <li class="nav-item active">
                <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
            </li>
        </ul>





        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown dropdown-image">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span data-letters="{{ $user->initials() }}"> {{ $user->name() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.home') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">

    @yield('content')




</div>


<script src="{{ mix('app_admin/js/app.js') }}"></script>
<form id="logout-form" action="{{ route('app.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
</body>
</html>