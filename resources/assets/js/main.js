document.addEventListener("DOMContentLoaded", function(event) {

  /**
   * Replace the favicon by another one with the color
   * associated with currency exchanges. This will
   * only take place when appropriate.
   */
  if (
    // This selector will work on the page listing currency exchanges.
    document.querySelector('.counter-list') ||
    // This combination of selectors will work on the page of
    // a partner that has at least one currency exchange.
    (
      document.querySelector('.partner-page') &&
      document.querySelector('.badge.badge--exchange')
    )
  ) {
    // Select and remove the appropriate `<link>` elements from the DOM.
    const favicon = document.querySelector('link[rel="shortcut icon"]');
    const favicon32px = document.querySelector('link[rel="icon"][sizes="32x32"]');
    document.head.removeChild(favicon);
    document.head.removeChild(favicon32px);

    // Then, build the replacement '<link>' and add it to the DOM.
    const link = document.createElement('link');
    link.rel = 'shortcut icon';
    link.href = '/favicon-32x32--currency-exchange.png';
    document.head.appendChild(link);
  }

});
