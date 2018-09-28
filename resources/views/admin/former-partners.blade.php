@extends('layouts.admin')

@section('title', 'Liste des anciens partenaires')

@section('content')

    <style>
        .team-name {
            display: block;
            font-size: 1.4rem;
            text-transform: uppercase;
            color: rgb(0, 148, 179);
        }
        @media (min-width: 750px) {
            .team-name {
                font-size: 1.6rem;
                font-family: 'museo_sans700';
            }
        }

        .reason-for-leaving {
            display: block;
            color: #777;
        }
    </style>

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        'Anciens partenaires',
    ])

    <h2>Anciens partenaires</h2>

    <p>Voici la liste des <strong>{{ $formerPartnersCount }}</strong> prestataires partenaires ayant quitté le réseau, triés par dates de sortie, des plus récentes aux plus anciennes.</p>

    @foreach ($formerPartners as $month => $partners)

    <h4 class="listing-letter">{{ $month }}</h4>

    <ul class="partner-list">
        @foreach ($partners as $partner)
            <li>
                <span class="partner-name">{{ $partner->name }}</span>

                @if ($partner->reason_for_leaving)
                    <span class="reason-for-leaving">
                        ({{ $partner->reason_for_leaving }})
                    </span>
                @endif

                @if ($partner->team)
                    <span class="team-name">Val {{ $partner->team->name }}</span>
                @else
                    <span class="team-name team-name--unknown">Val inconnu</span>
                @endif
            </li>
        @endforeach
    </ul>

    @endforeach

@endsection
