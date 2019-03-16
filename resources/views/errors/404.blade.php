<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page introuvable — Le Val’heureux</title>

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

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
            font-family: 'museo';
            font-weight: bold;
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
            <img src="/img/white_question_mark_on_blue_circle.svg" alt="">
            Oups…
        </div>
        <p>Cette page du site n’existe pas…</p>
        <p>Vous cherchez peut-être la <a href="/carte">carte des commerces</a> ou la <a href="/comptoirs">liste des comptoirs de change</a> ?</p>
        <p>Vous pouvez aussi simplement <a href="/">retourner sur la page d’accueil</a> du site.</p>
    </div>
</body>
</html>
