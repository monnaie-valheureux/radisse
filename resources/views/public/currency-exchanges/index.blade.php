@extends('layouts.public')

@section('title', 'Liste des comptoirs de change')

@section('content')

    <h2 class="counter-list-main-heading">Comptoirs de change</h2>

    <div class="counter-list">
        <p>Actuellement, vous pouvez échanger vos euros contre des Val’heureux dans ces {{ $total }} lieux :</p>

        {{--
            Display an alphabetically sorted list of cities.
        --}}
        @foreach ($cities as $city => $currencyExchanges)
            <h3 class="counter-list__sublist-label">{{ $city }}</h3>

            <ul class="counter-list__sublist">
                {{--
                    For each city, we display an alphabetically sorted list
                    of currency exchanges that are located in this city.
                --}}
                @foreach ($currencyExchanges as $address)
                    <li class="counter-list__entry">
                        <a href="/partenaires/{{ $address->partnerSlug }}">
                            {{ $address->recipient }}
                        </a><br>
                        {{ $address->street }}
                        {{ $address->streetNumber }}
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection
