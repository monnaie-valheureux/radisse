@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')

    <h2 class="partner-list-main-heading">Où dépenser les Val’heureux ?</h2>

    <div class="partner-list">
    {{--
        Display an alphabetically sorted list of initials. Some letters of
        the alphabet may be missing, because we’re only listing letters
        for those we have at least one partner name starting with it.
    --}}
    @foreach ($initials as $letter => $partners)
        <h3 class="partner-list__sublist-label">{{ $letter }}</h3>

        <ul class="partner-list__sublist">
            {{--
                For each initial, we display an alphabetically
                sorted list of partners who have their ‘list
                name’ starting with this initial.
            --}}
            @foreach ($partners as $partner)
                <li class="partner-list__entry">
                    <a href="/partenaires/{{ $partner->slug }}">
                        {{ $partner->name_sort }}
                    </a>
                    @if ($cities = $partner->locationCities())
                        <span class="partner-list__entry__cities">({{ $cities }})</span>
                    @endif
                </li>
            @endforeach
        </ul>

    @endforeach
    </div>
@endsection
