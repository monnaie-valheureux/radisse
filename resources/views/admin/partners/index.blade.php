@extends('layouts.admin')

@section('title', 'Liste des partenaires prestataires')

@section('content')

    @breadcrumbs(['Gérer les partenaires'])

    <h2 id="début">Gérer les prestataires partenaires</h2>

    <ul>
        <li>
            <a href="#mon-val">Partenaires du val {{ auth()->user()->team->name }}</a>
        </li>
        <li>
            <a href="#autres-vals">Voir les partenaires des autres vals</a>
        </li>
    </ul>

    <p>Pour modifier un partenaire, cliquez sur son nom dans la liste. Pour en ajouter un nouveau, utilisez le bouton juste ci-dessous.</p>
    <p>En tout, <strong>{{ $teamPartnersCount + $otherPartnersCount }}</strong> prestataires partenaires sont enregistrés sur le site.</p>

    <p>
        <a href="{{ route('create-partner') }}" class="btn">Ajouter un nouveau partenaire</a>
    </p>


    <h3 id="mon-val">
        Partenaires du val {{ auth()->user()->team->name }}
        ({{ $teamPartnersCount }})
    </h3>

    @if ($teamPartnersCount > 30)
        {{--
            If the team has more than a given amount of partners, we will
            categorize them by initials and provide a list a ‘quick
            links’ to access the lists related to each initial.
        --}}

        <p class="partner-initials-list">
        @foreach ($teamPartnersInitials as $initial)
            <a href="#{{ $initial }}">{{ $initial }}</a>
        @endforeach
        </p>

        @foreach ($teamPartners as $letter => $partners)

        <h4 class="listing-letter" id="{{ $letter }}">{{ $letter }}</h4>

        <ul class="partner-list">
            @foreach ($partners as $partner)
                @if ($partner->left_on)
                <li class="former-partner">
                    <span class="partner-name">
                        {{ $partner->name_sort }}
                    </span>
                    <br>
                    <span class="partner-left-on">
                        N’est plus partenaire depuis le
                        {{ $partner->left_on->format('d/m/Y') }}.
                    </span>
                </li>
                @else
                <li>
                    <a href="{{ route('partner', $partner) }}">
                        <span class="partner-name">
                            {{ $partner->name_sort }}
                        </span>
                    </a>

                    @if ($partner->isNotValidated())
                        <span style="color: #ce7a10;"> (non-validé)</span>
                    @endif
@php
    $currencyExchanges = [];
    foreach ($partner->locations as $location) {
        if ($location->currencyExchange) {
            $currencyExchanges[] =
                'Comptoir de change';
        }
    }
@endphp
                    @if (count($currencyExchanges) === 1)
                        <br>
                        A un comptoir de change
                    @elseif (count($currencyExchanges) > 1)
                        <br>
                        A {{ count($currencyExchanges) }} comptoirs de change
                    @endif
                </li>
                @endif
            @endforeach
        </ul>
        @endforeach

    @else
        {{--
            If the team has less than a given amount of partners, we
            will simply provide a single list with all the partners,
            with no subcategories.
        --}}

        <ul class="partner-list">
            @foreach ($teamPartners as $letter => $partners)
                @foreach ($partners as $partner)
                    @if ($partner->left_on)
                    <li class="former-partner">
                        <span class="partner-name">
                            {{ $partner->name_sort }}
                        </span>
                        <br>
                        <span class="partner-left-on">
                            N’est plus partenaire depuis le
                            {{ $partner->left_on->format('d/m/Y') }}.
                        </span>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('partner', $partner) }}">
                            <span class="partner-name">
                                {{ $partner->name_sort }}
                            </span>
                        </a>

                        @if ($partner->isNotValidated())
                            <span style="color: #ce7a10;"> (non-validé)</span>
                        @endif
                    </li>
                    @endif
                @endforeach
            @endforeach
        </ul>

    @endif

    <ul class="return-list">
        <li>
            <a href="#mon-val">Revenir au début de la liste</a>
        </li>
        <li>
            <a href="#début">Revenir en haut de la page</a>
        </li>
    </ul>


    <h3 id="autres-vals">
        Partenaires des autres vals ({{ $otherPartnersCount }})
    </h3>

    <p>Les partenaires hors du val {{ auth()->user()->team->name }} sont listés ici pour information. Au cas où une de leurs infos doit être modifiée, merci de demander à une personne du val concerné.</p>

    <p class="partner-initials-list">
    @foreach ($otherPartnersInitials as $initial)
        <a href="#autres-{{ $initial }}">{{ $initial }}</a>
    @endforeach
    </p>

    @foreach ($otherPartners as $letter => $partners)

    <h4 class="listing-letter" id="autres-{{ $letter }}">{{ $letter }}</h4>

    <ul class="partner-list">
        @foreach ($partners as $partner)
            @if ($partner->left_on)
            <li class="former-partner">
            @else
            <li>
            @endif
                <span class="partner-name">{{ $partner->name_sort }}</span>

                @if ($partner->team)
                    <span style="padding-left: 0.5em; color: #017891; font-size: 0.8em">
                        val {{ $partner->team->name }}
                    </span>
                @else
                    <span style="padding-left: 0.5em; color: red; font-size: 0.8em">
                        val inconnu
                    </span>
                @endif

                @if ($partner->left_on)
                    <span class="partner-left-on">
                        N’est plus partenaire depuis le
                        {{ $partner->left_on->format('d/m/Y') }}.
                    </span>
                @endif
            </li>
        @endforeach
    </ul>
    @endforeach

    <ul class="return-list">
        <li>
            <a href="#autres-vals">Revenir au début de la liste</a>
        </li>
        <li>
            <a href="#début">Revenir en haut de la page</a>
        </li>
    </ul>
@endsection
