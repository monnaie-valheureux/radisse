@extends('layouts.public')

@section('title', $partner->name.' - le Val’heureux')

@section('content')

    <div class="partner-page">
    <div class="partner-page__wrapper">
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
                                {!! $location->postalAddress->toSimplifiedHtml() !!}

                                {{--
                                    Add an indicator if the location
                                    is a currency exchange.
                                --}}
                                @if ($location->currencyExchange)
                                    <p class="is-currency-exchange">
                                        Ce lieu est comptoir de change
                                    </p>
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
