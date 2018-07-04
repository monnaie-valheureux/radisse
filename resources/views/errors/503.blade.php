<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mise à jour du site en cours — Le Val’heureux</title>

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    @if (config('app.env') === 'production')
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
        var u="https://stats.valheureux.be/";
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

    @endif

    <style>
        html {
            height: 100%;
        }
        body {
            max-width: 700px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1em;
            padding-right: 1em;
            font-size: 1.6rem;
            text-align: center;
        }
        .logo {
            font-family: 'museo700';
            font-size: 3.5rem;
            color: #0094b3;
        }
        .logo img {
            width: 1em;
            vertical-align: -10%;
        }
        @media (min-width: 750px) {
            body {
                font-size: 2rem;
            }
            .logo {
                font-size: 7rem;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="/img/logo_circle_white_on_blue.svg" alt="">
            le Val’heureux
        </div>
        <p>Nous sommes en train de faire une mise à jour du site.</p>
        <p>Merci de revenir dans quelques instants :-)</p>
    </div>
</body>
</html>
