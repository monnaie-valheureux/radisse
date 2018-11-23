<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Interface de gestion - Le Val’heureux')</title>

    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">

    <!-- Add favicon and other proprietary, non-standard crap. -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-admin.png?v=jwz">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32-admin.png?v=jwz">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16-admin.png?v=jwz">
    <link rel="shortcut icon" href="/favicon-admin.ico?v=jwz">
</head>
<body>
    <div class="site-header">

    {{-- Set a link to the home page except if we’re already on it. --}}
    @if (Route::is('admin-home'))
        <h1 class="site-header__site-title">
            Gestion du Val’heureux
        </h1>
    @else
        <a href="{{ route('admin-home') }}" class="site-header__home-link">
            <h1 class="site-header__site-title">
                Gestion du Val’heureux
            </h1>
        </a>
    @endif

        <a href="{{ route('home') }}" class="site-header__public-home-link">
            <span>Voir le site</span>
        </a>
    </div>

    <div class="main-content">
        {{-- Here comes the main content of the page. --}}
        @yield('content')
    </div>

    <div class="site-footer">
    @auth
        <hr>
        {{-- If we are logged in, display a button to be able to log out. --}}
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            {{ csrf_field() }}
            <button type="submit" name="submit">Se déconnecter</button>
        </form>
    @endauth
    </div>

    @stack('body-scripts')
</body>
</html>
