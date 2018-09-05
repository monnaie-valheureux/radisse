@extends('layouts.admin')

@section('title', 'Liste des anciens partenaires')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        'Anciens partenaires',
    ])

    <h2>Anciens partenaires</h2>

    <p>Voici la liste des <strong>{{ $formerPartnersCount }}</strong> prestataires partenaires ayant quitté le réseau, triés par date de sortie.</p>

    @foreach ($formerPartners as $month => $partners)

    <h4 class="listing-letter">{{ $month }}</h4>

    <ul class="partner-list">
        @foreach ($partners as $partner)
            <li>
                <span class="partner-name">{{ $partner->name }}</span>

                @if ($partner->team)
                    <span>(val {{ $partner->team->name }})</span>
                @else
                    <span>(val inconnu)</span>
                @endif
            </li>
        @endforeach
    </ul>

    @endforeach

@endsection
