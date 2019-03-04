@extends('layouts.public')

@section('title', 'Carte des commerces — le Val’heureux')

@push('body-styles')
<link rel="stylesheet" href="/vendor/leaflet/leaflet.css">
<link rel="stylesheet" href="/vendor/leaflet.markercluster/MarkerCluster.css">
<link rel="stylesheet" href="/vendor/leaflet.markercluster/MarkerCluster.Default.css">
@endpush

@push('body-scripts')
    <script>
      var locations = @json($locations);
      var municipalities = @json($municipalities);
    </script>

    <script src="/vendor/leaflet/leaflet.js"></script>
    <script src="/vendor/leaflet.markercluster/leaflet.markercluster.js"></script>
    <script src="/vendor/leaflet.featuregroup.subgroup/leaflet.featuregroup.subgroup.js"></script>
    <script src="{{ mix('js/general-osm-map.js') }}"></script>

@endpush


@section('content')

    <noscript>
        <div class="error-message error-message--javascript-required">
            <p>Nous sommes désolés, la carte reprenant tous les commerçants du Val’heureux ne peut pas fonctionner sur votre appareil, car elle nécessite la technologie JavaScript.</p>
            <p>Si vous en avez l’occasion, nous vous conseillons d’activer JavaScript sur votre appareil, ou bien d’utiliser un autre appareil.</p>
            <p>Dans tous les cas, vous pouvez toujours consulter la <a href="/partenaires">liste complète de nos commerçants</a>.</p>
        </div>
    </noscript>

    <div id="map" class="general-partner-map"></div>

    <div class="template-marker-groups">
        <div id="v-marker-group">
            @php
                require_once public_path('/img/maps/v-marker-group.svg');
            @endphp
        </div>
        <div id="v-marker-group--double">
            @php
                require_once public_path('/img/maps/v-marker-group--double.svg');
            @endphp
        </div>
        <div id="v-marker-group--2-digits">
            @php
                require_once public_path('/img/maps/v-marker-group--2-digits.svg');
            @endphp
        </div>
        <div id="v-marker-group--3-digits">
            @php
                require_once public_path('/img/maps/v-marker-group--3-digits.svg');
            @endphp
        </div>
    </div>

@endsection
