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


        <h3 class="link-listing__heading">Partenaires sans adresse fixe</h3>

        <p>Un certain nombre de professionnels n’apparaissent pas dans ces listes, soit car ils ne travaillent pas à une adresse fixe (services ou travaux à domicile, arts du spectacle, etc.)  soit car ils n’ont pas souhaité la communiquer publiquement sur notre site.</p>
        <p>
            Retrouvez-les sur cette page :
            <a href="/partenaires-par-localite/sans-adresse-precise">
                partenaires sans adresse fixe
                <span class="link-list__counter">({{ $partnersWithoutLocationCount }})</span>
            </a>
        </p>


        <h3 class="link-listing__heading">Partenaires non référencés</h3>

        <p>Enfin, certains professionnels acceptant le Val’heureux ne sont pas du tout repris sur notre site, généralement par obligation déontologique ou légale envers la publicité (médecins, etc.).</p>

    </div>
@endsection
