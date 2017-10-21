@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')

    <h2 class="partner-list-main-heading">Où dépenser les Val’heureux ?</h2>

    <div class="partner-list">
    @foreach ($initials as $letter => $partners)
        <h3 class="partner-list__sublist-label">{{ $letter }}</h3>

        <ul class="partner-list__sublist">
            @foreach ($partners as $partner)
                <li class="partner-list__entry">
                    {{ $partner->name_sort }}
                    @if ($cities = $partner->locationCities())
                        <span class="partner-list__entry__cities">({{ $cities }})</span>
                    @endif
                </li>
            @endforeach
        </ul>

    @endforeach
    </div>
@endsection
