<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Le Val’heureux')</title>

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    <!--
        This sends stats to Piwik, an open source and privacy-friendly
        analytics tool. We configured it to make it respect privacy
        even more, by honoring ‘Do Not Track’ headers, not using
        any cookie and not storing full IP addresses, among
        other things. Privacy is a human right, period!
    -->
    <script type="text/javascript">
      var _paq = _paq || [];
      // Do not use cookies.
      _paq.push(['disableCookies']);
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//stats.valheureux.be/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document,
            g=d.createElement('script'),
            s=d.getElementsByTagName('script')[0];
        g.type='text/javascript';
        g.async=true;
        g.defer=true;
        g.src=u+'piwik.js';
        s.parentNode.insertBefore(g,s);
      })();
    </script>

</head>
<body>
    <div class="site-header">
        <div class="site-header-elements">

        {{--
            Set a link to the home page on the main heading of the
            site, except if we’re already on the home page.
        --}}
        @if (Route::is('home'))
            <h1 class="site-header__site-title">
                <span>Le Val’heureux</span>
            </h1>
        @else
            <a href="/" class="site-header__home-link">
                <h1 class="site-header__site-title">
                    <span>Le Val’heureux</span>
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

    {{-- Here comes the main content of the page. --}}
    @yield('content')

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
        <div class="site-footer__under-construction">
            <h2>Attention, peinture fraîche !</h2>
            <p>Ce site est tout jeune, et il va encore bien évoluer durant les prochaines semaines et les prochains mois.</p>
            <p>Si jamais vous rencontrez un problème, n’hésitez pas à nous le signaler, afin que nous puissions le régler dès que possible.</p>
        </div>
    </div>
</body>
</html>