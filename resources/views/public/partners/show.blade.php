@extends('layouts.public')

@section('title', $partner->name.' - le Val’heureux')

@push('body-styles')
<link rel="stylesheet" href="/vendor/leaflet/leaflet.css">
@endpush

@push('body-scripts')
    <script src="/vendor/leaflet/leaflet.js"></script>
    <script src="{{ mix('js/dynamic-osm-maps.js') }}"></script>
@endpush


@section('content')

    <div class="partner-page">
    <div class="partner-page__wrapper">

        {{--
            If the partner has at least one location, display a link allowing
            to go to the list of partners of that location’s city. Since we
            are taking the city of the first location, in theory, this may
            cause an issue if this partner has locations in more than one
            city. But this should do the trick for a while.
        --}}
        @if (
            $partner->locations->isNotEmpty() &&
            $city = $partner->locations->first()->city
        )
        @php
            // Determine the correct middle word to use
            // according to the name of the city.
            $vowels = ['A', 'E', 'I', 'O', 'U', 'Y'];
            $firstLetter = $city[0];

            $middleWord = (in_array($city[0], $vowels)) ? 'd’' : 'de ';
        @endphp
        <style>
            /**
             * Manually overwrite some CSS…
             */
            .go-back {
                margin-top: 0.8rem;
            }
        </style>
        <div class="go-back">
            <a href="/partenaires-par-localite/{{ $city }}" class="go-back__link">
                ⬅ Retourner à la liste
                {{ $middleWord.$city }}
            </a>
        </div>
        @endif

        <h2 class="partner-page__heading">{{ $partner->name }}</h2>

        {{-- Display the locations of the partner. --}}
        @if ($partner->locations->isNotEmpty())
        <div class="partner-page__location-list">

            @foreach ($partner->locations as $location)
                <div class="partner-page__location">
                    <dl>
                        <div class="partner-page__address">
                            <dt>Adresse</dt>
                            <dd>
                                <div>
                                    {!! $location->postalAddress->toHtml() !!}

                                    {{--
                                        Add an indicator if the location
                                        is a currency exchange.
                                    --}}
                                    @if ($location->hasCurrencyExchange())
                                        <a href="/comptoirs"
                                        class="badge badge--big badge--exchange"
                                        title="Voir la liste de tous les comptoirs de change">
                                            Ce lieu est comptoir de change
                                        </a>
                                    @endif
                                </div>

                                {{--
                                    Display a static map if there is one
                                    available for the current location.
                                --}}
                                @if ($location->hasMedia('maps'))

                                <div class="osm-map-container">
                                    <img src="{{ $location->getFirstMedia('maps')->getUrl() }}"
                                    alt="Carte géographique indiquant l’emplacement de l’adresse."
                                    title="{{ $location->postalAddress->toString() }}"
                                    class="osm-map js-osm-map"
                                    data-address-id="{{ $location->postalAddress->id }}"
                                @if ($location->hasCurrencyExchange())
                                    data-is-currency-exchange="yes"
                                @endif
                                    data-latitude="{{ $location->postalAddress->latitude }}"
                                    data-longitude="{{ $location->postalAddress->longitude }}"
                                    data-zoom-level="18"
                                    >
                                </div>

                                @endif
                            </dd>
                        </div>

                        @foreach ($location->suitablePublicPhones as $phone)
                        <div class="partner-page__phone">
                            <dt>Téléphone</dt>
                            <dd>
                                {!! $phone->toNationalFormat() !!}
                            </dd>
                        </div>
                        @endforeach

                    </dl>
                </div>
            @endforeach

        </div>
        @endif

        {{--
            Then, after the locations, we display the
            info belonging to the partner itself.
        --}}
        <dl class="partner-page__partner-info">

            {{--
                If there is no location, try to display
                phone numbers for the partner itself.
            --}}
            @if ($partner->locations->isEmpty())
                @foreach ($partner->publicPhones as $phone)
                <div class="partner-page__phone">
                    <dt>Téléphone</dt>
                    <dd>{{ $phone }}</dd>
                </div>
                @endforeach
            @endif

            @foreach ($partner->publicEmails as $email)
            <div class="partner-page__email">
                <dt>E-mail</dt>
                <dd>{{ $email }}</dd>
            </div>
            @endforeach

            @foreach ($partner->websites as $website)
            <div class="partner-page__website">
                <dt>Site web</dt>
                <dd>{{ $website }}</dd>
            </div>
            @endforeach

            @foreach ($partner->socialNetworks as $network)
            <div class="partner-page__social-network">
                <dt>Réseaux sociaux</dt>
                <dd>{{ $network }}</dd>
            </div>
            @endforeach
        </dl>
    </div>
    </div>
@endsection
