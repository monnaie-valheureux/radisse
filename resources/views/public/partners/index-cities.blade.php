@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')

    <div class="partner-list">

        <h2 class="partner-list-main-heading">Où dépenser les Val’heureux ?</h2>

        <p>Voici la liste des {{ $cityCount }} villes et villages où l’on peut utiliser le Val’heureux. Elle évolue régulièrement. Cliquez sur un nom pour voir les commerces de cette localité.</p>
        <p>À <a href="/partenaires-par-localite/Liège">Liège</a>, plus d’une centaine de lieux et de commerces acceptent déjà le Val’heureux.</p>

        @foreach ($citiesByLetterRanges as $letterRange => $cities)

            <div class="link-listing">
                <h3 class="link-listing__heading">{{ $letterRange }}</h3>

                <ul class="link-listing__list link-list partner-list__sublist">

                    @foreach ($cities as $city => $locationCount)

                        <li class="link-list__item partner-list__entry">
                            <a href="/partenaires-par-localite/{{ $city }}">
                                {{ $city }}
                                <span class="link-list__counter">({{ $locationCount }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

    </div>
@endsection
