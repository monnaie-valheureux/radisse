@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')

    <div class="partner-list">

        <div class="go-back">
            <a href="/partenaires" class="go-back__link">
                ⬅ Retourner à la liste des villes et villages
            </a>
        </div>
        @if (in_array(\Illuminate\Support\Str::substr($city, 0, 1), ['A', 'E', 'I', 'O', 'U', 'Y']))
            <h2 class="partner-list-main-heading">Commerces d’{{ $city }}</h2>
        @else
            <h2 class="partner-list-main-heading">Commerces de {{ $city }}</h2>
        @endif

        <ul class="partner-list__sublist">
            @each ('public.partners.partner-list-item', $partners, 'partner')
        </ul>

    </div>
@endsection
