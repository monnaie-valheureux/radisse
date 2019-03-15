

// Define the settings of our generic map marker icon.
const markerIcon = L.icon({
  iconUrl: '/img/maps/v-marker.svg',
  iconSize: [27, 43],
  iconAnchor: [14, 43],
  shadowUrl: '/img/maps/v-marker-shadow.svg',
  shadowSize: [23, 12],
  shadowAnchor: [0, 12],
});

// Define the settings of our map marker icon for currency exchanges.
const currencyExchangeMarkerIcon = L.icon({
  iconUrl: '/img/maps/v-marker--currency-exchange.svg',
  iconSize:[27, 43],
  iconAnchor:[14, 43],
  shadowUrl: '/img/maps/v-marker-shadow.svg',
  shadowSize:[23, 12],
  shadowAnchor: [0, 12],
});

// We will loop on every static OSM map on the
// page and replace them by dynamic maps.
document.addEventListener('DOMContentLoaded', function (e) {

  const staticMaps = document.querySelectorAll('.js-osm-map');

  staticMaps.forEach(staticMap => {

    // Grab data from the HTML data attributes.
    const latitude = staticMap.dataset.latitude;
    const longitude = staticMap.dataset.longitude;
    const zoom = staticMap.dataset.zoomLevel;

    // We first create the element that will host the OSM map.
    const mapContainer = document.createElement('div');

    mapContainer.classList.add(
      'osm-map',
      'osm-map--dynamic',
      'js-osm-map--dynamic'
    );

    // Inject the element into the DOM.
    staticMap.parentNode.insertBefore(mapContainer, staticMap);

    // Resize the map container in case the
    // viewport is not big enough for it.
    resizeMapContainer(mapContainer);

    // Then, we instantiate the dynamic map.
    const OSMMap =
      createLeafletMap(mapContainer)
      .setView([latitude, longitude], zoom);

    let icon = markerIcon;

    // Do we need to use the icon of a currency
    // exchange instead of the default one?
    if ('isCurrencyExchange' in staticMap.dataset) {
      icon = currencyExchangeMarkerIcon;
    }

    // Add a marker at the center of the map.
    const marker = L.marker([latitude, longitude], {icon}).addTo(OSMMap);

    // Then, create a tooltip for the marker.
    marker.bindTooltip(staticMap.title, {direction: 'bottom'});

    // Finally, we remove the image of the static map.
    staticMap.parentNode.removeChild(staticMap);
  });

  // Now that all static maps of the page have been replaced by dynamic
  // ones, we add an event handler to react to changes of window size
  // in order to properly resize the maps if needed.
  window.addEventListener('resize', function (e) {
    document.querySelectorAll('.js-osm-map--dynamic').forEach(map => {
      resizeMapContainer(map)
    });
  });

});

/**
 * Create a instance of a Leaflet map.
 *
 * @param  {Element}  mapContainer
 *
 * @return {Map}
 */
function createLeafletMap(mapContainer) {

  // We will use a workaround that is necessary to remove the attribution
  // prefix. We first need to remove the attribution control entirely.
  // Then, we will recreate it when the map is loaded. The content
  // of the attribution is defined when creating the main layer.

  const attribution = 'Carte <a href="http://openstreetmap.org">OpenStreetMap</a>';

  const map = L.map(mapContainer, {
    minZoom: 9,
    // We will manually create these controls.
    attributionControl: false,
    zoomControl: false,
  })
  // Create the attribution control on map load so that we can disable prefix.
  .on('load', function (e) {
    e.target.addControl(L.control.attribution({prefix: false}));
  });

  // Add the base layer (the one containing the tiles).
  L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {attribution, maxZoom: 19}
  )
  .addTo(map);

  // Manually create the zoom controls so that we can localize them.
  L.control.zoom({zoomInTitle: 'Zoomer', zoomOutTitle: 'Dézoomer'}).addTo(map);

  return map;
}

/**
 * Resize a given map if needed.
 *
 * This function is horribly hacky. In some way. I don’t really like it.
 *
 * @param  {Map}  map
 *
 * @return {void}
 */
function resizeMapContainer(map) {

  // Hardcoded values, this is baaad!
  const idealMapWidth = 486;
  const idealMapHeight = 300;
  // (Not so) surprisingly, this gives us the golden ratio :)
  const ratio = idealMapWidth / idealMapHeight;

  // We detect the distance between the left side of the viewport and
  // the left side of the map. This should give us the size of the
  // <body> padding or something similar. Then, we double this
  // distance to account for the right padding.
  const lateralSpace = map.getBoundingClientRect().left * 2;

  // This gives us the width of the viewport.
  const availableWidth = document.documentElement.clientWidth;

  if (
    // Hardcoded value of a media query breakpoint (this is bad). Starting at
    // this width, the layout changes and this function becomes irrelevant.
    // So we have to check that we are under this value.
    availableWidth < 1000 &&
    // Is the real available space smaller than the ideal width?
    (availableWidth - lateralSpace) < idealMapWidth
  ) {
    // If we arrive here, it means we have to shrink the map.
    // Let’s start by calculating the max width we can use.
    const targetWidth = availableWidth - lateralSpace;
    // Then we calculate the new height from the new width.
    const targetHeight = targetWidth / ratio;

    // Updating inline styles like it was 2002 \o/
    map.style.minWidth = targetWidth+'px';
    map.style.minHeight = targetHeight+'px';
  }
  // If we don’t have to shrink the map, then give it the ideal dimensions.
  else {
    map.style.minWidth = idealMapWidth+'px';
    map.style.minHeight = idealMapHeight+'px';
  }
}
