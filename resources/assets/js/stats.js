var _paq = _paq || [];

// Do not use cookies.
_paq.push(['disableCookies']);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);

(function() {
  var u = 'https://stats.valheureux.be/';
  _paq.push(['setTrackerUrl', u+'piwik.php']);
  _paq.push(['setSiteId', '1']);
  var d = document,
      g = d.createElement('script'),
      s = d.getElementsByTagName('script')[0];
  g.type = 'text/javascript';
  g.async = true;
  g.defer = true;
  g.src = u+'piwik.js';
  s.parentNode.insertBefore(g,s);
})();
