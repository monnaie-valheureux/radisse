<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Le Valeureux devient le Val’heureux</title>

    <link rel="stylesheet" href="{{ asset('css/teaser.css') }}">

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
<body class="launch-teaser">
    <h1>Le Valeureux devient le Val’heureux</h1>

    <div class="bills">
        <div class="bills-container">
            <img src="teaser/old_bill.png" class="old-bill"
            alt="Ancien billet de 1 Valeureux">
            <img src="teaser/new_bill.png" class="new-bill"
            alt="Nouveau billet de 1 Val’heureux">
        </div>
    </div>

    <div class="text">
        <p>Après trois ans d’existence, la monnaie citoyenne de la région liégeoise évolue !</p>
        <p>Elle circulera désormais également entre Huy et Verviers, en Hesbaye, Condroz, Ourthe-Amblève et dans le pays de Herve.</p>
        <p>Venez nous retrouver ce <em>samedi 21 octobre à la Maison du peuple de Poulseur</em> pour une assemblée générale extraordinaire (ouverte à tous) suivie d’une soirée festive.</p>
        <p class="event"><a href="https://www.facebook.com/events/372751129813867/">Voir l’évènement sur Facebook</a></p>
        <p>Et retrouvez-nous également ici même, samedi 21 octobre à 18h, pour découvrir notre nouveau site :-)</p>
        <p>Pour plus d’infos : <a href="mailto:info@valeureux.be">info@valeureux.be</a></p>
    </div>
</body>
</html>
