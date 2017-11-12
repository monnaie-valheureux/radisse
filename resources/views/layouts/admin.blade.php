<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Interface de gestion - Le Val’heureux')</title>
</head>
<body>
    <div class="site-header">

    {{-- Set a link to the home page except if we’re already on it. --}}
    @if (Route::is('admin-home'))
        <h1 class="site-header__site-title">
            <span>Gestion du Val’heureux</span>
        </h1>
    @else
        <a href="{{ route('admin-home') }}" class="site-header__home-link">
            <h1 class="site-header__site-title">
                <span>Gestion du Val’heureux</span>
            </h1>
        </a>
    @endif
    </div>

    {{-- Here comes the main content of the page. --}}
    @yield('content')

    <div class="site-footer">
    @auth
        {{-- If we are logged in, display a button to be able to log out. --}}
        <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit">Se déconnecter</button>
        </form>
    @endauth
    </div>

    @stack('body-scripts')
</body>
</html>
