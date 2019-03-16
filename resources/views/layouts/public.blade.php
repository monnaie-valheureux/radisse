<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Le Val’heureux')</title>

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    <!-- Add favicon and other proprietary, non-standard crap. -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=jwzlq">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=jwzlq">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=jwzlq">
    <link rel="manifest" href="/site.webmanifest?v=jwzlq">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=jwzlq" color="#0094b3">
    <link rel="shortcut icon" href="/favicon.ico?v=jwzlq">
    <meta name="apple-mobile-web-app-title" content="le Val&rsquo;heureux">
    <meta name="application-name" content="le Val&rsquo;heureux">
    <meta name="msapplication-TileColor" content="#0094b3">
    <meta name="theme-color" content="#0094b3">

    @stack('body-styles')

    @if (config('app.env') === 'production')
    <!--
        This sends stats to Piwik, an open source and privacy-friendly
        analytics tool. We configured it to make it respect privacy
        even more, by honoring ‘Do Not Track’ headers, not using
        any cookie and not storing full IP addresses, among
        other things. Privacy is a human right, period!
    -->
    <script src="{{ mix('js/stats.js') }}"></script>
    @endif

</head>

{{-- Set a special class on the body if we are on the home page. --}}
@if (Route::is('home'))
<body class="is-homepage">
@else
<body>
@endif
    {{-- Include a site-wide announcement if there is one. --}}
    @include('components.site-wide-component')

    <div class="site-header">
        <div class="site-header-elements">

        {{--
            Set a link to the home page on the main heading of the
            site, except if we’re already on the home page.
        --}}
        @if (Route::is('home'))
            <h1 class="site-header__site-title">
                <span>
                    <span class="site-header__first-letter">L</span>e Val’heureux
                </span>
            </h1>
        @else
            <a href="/" class="site-header__home-link">
                <h1 class="site-header__site-title">
                    <span>
                        <span class="site-header__first-letter">L</span>e Val’heureux
                    </span>
                </h1>
            </a>
        @endif

            <nav>
                <ul>
                    <li><a href="/le-projet">Le projet</a></li>
                    <li><a href="/comptoirs">Où en trouver ?</a></li>
                    <li><a href="/partenaires">Commerces</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="site-content">
        {{-- Here comes the main content of the page. --}}
        @yield('content')
    </div>

    <div class="site-footer">
        <div class="site-footer__contact-details">
            <h2>Nos coordonnées</h2>
            <address>
                ASBL le Val’heureux<br>
                Rue Pierreuse, 57<br>
                4000 Liège<br>
            </address>
            <p>Email : {!! Html::mailto('info@valheureux.be') !!}</p>
        </div>
        <div class="site-footer__links-container">
            <h2>Menu</h2>
            <ul class="site-footer__links">
                <li><a href="/le-projet">Présentation du projet</a></li>
                <li><a href="/comptoirs">Où trouver des val’heureux ?</a></li>
                <li><a href="/partenaires">Où peut-on les utiliser ?</a></li>
            </ul>
        </div>
    </div>
    <div class="no-cookie-mention">
        Ce site respecte votre vie privée et n’utilise aucun cookie.
    </div>

    <script src="{{ mix('js/main.js') }}"></script>
    @stack('body-scripts')

    @php
        // Get the list of Git tags, sorted from newest to oldest.
        $gitTags = shell_exec('git tag --sort=-version:refname');

        // Keep only the newest.
        $currentSiteVersion = explode("\n", $gitTags)[0];
    @endphp

    <div class="site-version" data-version="{{ $currentSiteVersion }}"></div>
</body>
</html>
