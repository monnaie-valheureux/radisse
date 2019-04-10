

// Define the settings of our generic map marker.
const markerIcon = L.icon({
  iconUrl: '/img/maps/v-marker.svg',
  iconSize: [27, 43],
  iconAnchor: [14, 43],
  shadowUrl: '/img/maps/v-marker-shadow.svg',
  shadowSize: [23, 12],
  shadowAnchor: [0, 12],
});

// Define the settings of our map marker for currency exchanges.
const currencyExchangeMarkerIcon = L.icon({
  iconUrl: '/img/maps/v-marker--currency-exchange.svg',
  iconSize:[27, 43],
  iconAnchor:[14, 43],
  shadowUrl: '/img/maps/v-marker-shadow.svg',
  shadowSize:[23, 12],
  shadowAnchor: [0, 12],
});

// The list of icon sizes and anchors for cluster icons.
const markerGroupIconData = {
  'v-marker-group':           { size: [41, 43], anchor: [18, 22] },
  'v-marker-group--double':   { size: [48, 44], anchor: [20, 22] },
  'v-marker-group--2-digits': { size: [52, 55], anchor: [22, 23] },
  'v-marker-group--3-digits': { size: [66, 60], anchor: [30, 30] },
};



// We define our own subtype of marker, in order
// to be able to assign custom properties to it.
const ValMarker = L.Marker.extend({
  options: {
    name: 'Le Val’heureux',
    is_currency_exchange: false,
  }
});

L.valMarker = function (id, options) {
  return new ValMarker(id, options);
};


// Define the main group of marker clusters.
const mainCluster = L.markerClusterGroup({

  maxClusterRadius: 80,
  showCoverageOnHover: false,

  iconCreateFunction(cluster) {
    const childMarkers = cluster.getAllChildMarkers();
    const count = cluster.getChildCount();

    let iconID = 'v-marker-group';

    // We determine the correct icon according to
    // the amount of markers inside the cluster.
    if (count === 2) {
      iconID = 'v-marker-group--double';
    } else if (count >= 10 && count < 100) {
      iconID = 'v-marker-group--2-digits';
    } else if (count >= 100) {
      iconID = 'v-marker-group--3-digits';
    }

    // We grab a copy of the correct ‘template’ SVG code of the marker.
    const svg = document.getElementById(iconID).cloneNode(true);

    // If there are at least three markers, we update the number inside
    // the marker icon (groups of two markers contain no text).
    if (count >= 3) {
      svg.querySelector('.marker-total').innerHTML = count;
    }

    // Get the markers that represent currency exchanges.
    const currencyExchangesInCluster = childMarkers.filter(
      item => item.options.is_currency_exchange
    );

    // Do ALL the child markers in the cluster represent currency exchanges?
    // If so, we’ll recolor ALL the markers in the SVG, by adding a class.
    if (currencyExchangesInCluster.length === childMarkers.length) {
      svg.querySelectorAll('.marker').forEach(
        marker => marker.classList.add('marker--currency-exchange')
      );
    }
    // Otherwise, if at least one of the markers represents a currency
    // exchange, we’ll recolor one random marker path in the SVG.
    else if (currencyExchangesInCluster.length > 0) {

      const secondaryMarkers = svg.getElementsByClassName('marker--secondary');

      if (secondaryMarkers.length) {
        const randomIndex = Math.floor(Math.random() * secondaryMarkers.length);
        secondaryMarkers[randomIndex].classList.add('marker--currency-exchange');
      }
    }

    return L.divIcon({
      html: svg.innerHTML,
      className: 'marker-group',
      iconSize: markerGroupIconData[iconID].size,
      iconAnchor: markerGroupIconData[iconID].anchor,
    });
  }

});

// Define the secondary groups of marker clusters.
const partnersSubgroup = L.featureGroup.subGroup(mainCluster);
const currencyExchangesSubgroup = L.featureGroup.subGroup(mainCluster);


// Light the fireworks when the DOM is ready :)
document.addEventListener('DOMContentLoaded', function(e) {

  // Instantiate the map.
  const OSMMap = createLeafletMap('map').setView([50.647839, 5.572626], 10);

  // Add the groups of marker clusters to the map.
  mainCluster.addTo(OSMMap);
  partnersSubgroup.addTo(OSMMap);
  currencyExchangesSubgroup.addTo(OSMMap);

  // Create controls allowing to show and hide
  // the secondary groups of marker clusters.
  createLayerControls(OSMMap);


  // Handle municipalities
  // ---------------------

  // Features related to municipalities won’t be available for mobile devices,
  // for usability reasons. After some testing, we found out that this didn’t
  // mix very well with touch screens, especially small ones.
  // Note: we know that ‘mobile’ and ‘touch screen’ could be two completely
  // unrelated things (and, if you look at the code Leaflet uses to try to
  // detect ‘mobile’ contexts, you would certainly facepalm…). But, since
  // we don’t have any perfect solution, we’re trying to improve things
  // for the majority of people and cases on a ‘best-effort’ basis.

  if (L.Browser.mobile === false) {

  const municipalitiesLayerGroup = L.layerGroup().addTo(OSMMap);

  const municipalityOptions = {
    color: '#999',
    opacity: 0.75,
    fillColor: '#999',
    fillOpacity: 0,
    dashArray: [3],
    weight: 1,
  };

  // Variable used to track what is the last clicked municipality.
  let lastClickedMunicipality;

  // Click handler.
  // We will focus the map and zoom on the clicked municipality, except if
  // this municipality was already clicked during the previous click.
  const onMunicipalityClick = function (evt) {

    const municipality = evt.sourceTarget;

    if (lastClickedMunicipality === municipality._leaflet_id) {
      return;
    }

    // Update the variable.
    lastClickedMunicipality = municipality._leaflet_id;

    municipality.bringToFront();
    OSMMap.fitBounds(municipality.getBounds());
  };

  // Mouseover handler.
  // We will change the style of the borders and display
  // the name of the hovered municipality.
  const onMunicipalityMouseover = function (evt) {

    const municipality = evt.sourceTarget;

    municipality.bringToFront();

    // If we’re under a given zoom level, update the styles of the borders.
    if (OSMMap.getZoom() <= 16) {
      municipality.setStyle({
        color: '#333',
        opacity: 1,
        dashArray: null,
        weight: 3,
      });
    }

    // If we’re under a given zoom level, display
    // the name of the municipality in a tooltip.
    if (OSMMap.getZoom() < 16) {
      municipality
        .bindTooltip(municipalityTooltipFunction, {sticky: true})
        .openTooltip();
    }
  };

  // Mouseout handler.
  // We will reset the style of the borders and remove the tooltip.
  const onMunicipalityMouseout = function (evt) {
    const municipality = evt.sourceTarget;

    municipality.setStyle(municipalityOptions);
    municipality.unbindTooltip();
  };

  // Function used to determine the contents of a municipality tooltip.
  const municipalityTooltipFunction = function(layer) {

    const name = layer.feature.properties.name_fr;
    const middleWord = startWithVowel(name) ? 'd’' : 'de ';

    return 'Commune ' + middleWord + name;
  };


  // Add the municipalities to the map.
  for (let i = 0; i < window.generalMapData.municipalities.length; i++) {

    L.geoJSON(window.generalMapData.municipalities[i], municipalityOptions)
      .on('click', onMunicipalityClick)
      .on('mouseover', onMunicipalityMouseover)
      .on('mouseout', onMunicipalityMouseout)
      .addTo(municipalitiesLayerGroup);
  }

  }
  // End check L.Browser.mobile


  // Handle location markers
  // -----------------------

  window.generalMapData.locations.forEach(location => {

    // Ensure that we don’t try to create markers with missing coordinates.
    if (location.latitude == null || location.longitude == null) {
        return;
    }

    // Create a marker for the current location.
    // We use our custom marker type.
    const marker = L.valMarker(
      [location.latitude, location.longitude],
      {
        name: location.name,
        is_currency_exchange: location.is_currency_exchange,
        partner_slug: location.partner_slug,
      }
    );

    // Choose icon and clustering group for the marker.
    if (location.is_currency_exchange) {
        marker.setIcon(currencyExchangeMarkerIcon)
              .addTo(currencyExchangesSubgroup);
    } else {
        marker.setIcon(markerIcon)
              .addTo(partnersSubgroup);
    }

    marker.bindPopup(marker.options.name, {
      offset: [0, -30],
      closeButton: false,
    });

    // By default, the popup would open as soon as the marker is clicked.
    // This means that it will open before the XHR request is able to
    // load the ‘real’ content of the popup, thus creating a ‘flash’
    // due to content change once the XHR callback gets executed.
    // This is a small hack to prevent the popup to open on
    // click, allowing us to manually open it when needed.
    // https://stackoverflow.com/a/46275010
    marker.off('click', this.openPopup);

    // Define click handler.
    marker.on('click', evt => {
      const marker = evt.sourceTarget;
      const slug = marker.options.partner_slug;

      const xhr = new XMLHttpRequest();

      // Callback to execute once the XHR request is complete.
      xhr.addEventListener('load', function() {
        marker.setPopupContent(this.responseText);
        marker.openPopup();
      });

      xhr.open('GET', `/xhr/partenaires/${slug}`);
      xhr.send();
    });

    // Create a tooltip for the marker.
    marker.bindTooltip(marker.options.name, {
      direction: 'bottom',
      className: 'partner-tooltip',
    });

    // End of the forEach loop.
  });

  // End of DOMContentLoaded handler.
});

/**
 * Create an instance of a Leaflet map.
 *
 * @param  {String}  id
 *
 * @return {Map}
 */
function createLeafletMap(id) {

  // We will use a workaround that is necessary to remove the attribution
  // prefix. We first need to remove the attribution control entirely.
  // Then, we will recreate it when the map is loaded. The content
  // of the attribution is defined when creating the main layer.

  const attribution = 'Carte <a href="http://openstreetmap.org">OpenStreetMap</a>';

  const map = L.map(id, {
    // Hardcoded bounds for the province of Liège.
    maxBounds: [
      [50.1296, 4.9794],
      [50.8121, 6.4081]
    ],
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

  // Add a scale control to the map.
  L.control.scale({'metric': true, 'imperial': false}).addTo(map);

  return map;
}

/**
 * Create layer controls for the secondary groups of marker clusters.
 *
 * @param  {Map}  map
 *
 * @return {void}
 */
function createLayerControls(map) {

  const layerControls = L.control.layers(null, null, {collapsed: false});

  layerControls.addOverlay(
    window.partnersSubgroup,
    `<span class="layer-control-label--partner">
      <img src="/img/maps/v-marker.svg" class="marker" alt="" width="20">
      Commerces
    </span>`
  );
  layerControls.addOverlay(
    window.currencyExchangesSubgroup,
    `<span class="layer-control-label--currency-exchange">
      <img src="/img/maps/v-marker--currency-exchange.svg" class="marker" alt="" width="20">
      Comptoirs de change
    </span>`
  );

  layerControls.addTo(map);
}

/**
 * Check if a given word start with a vowel.
 *
 * @param  {String}  word
 *
 * @return {Boolean}
 */
function startWithVowel(word) {
  const vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
  const firstLetter = word.toLowerCase().substring(0, 1);

  return (vowels.indexOf(firstLetter) != -1);
}
