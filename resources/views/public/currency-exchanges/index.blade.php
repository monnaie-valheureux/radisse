@extends('layouts.public')

@section('title', 'Liste des comptoirs de change')

@section('content')

    <h2 class="counter-list-main-heading">Comptoirs de change</h2>

    <div class="counter-list">
        <p>Actuellement, vous pouvez échanger vos euros contre des Val’heureux dans ces endroits :</p>

        <ul>
        @foreach ($addresses as $address)
            <li>
                {{ $address->recipient }}<br>
                {{ $address->street }}
                {{ $address->streetNumber }},
                {{ $address->city }}
            </li>
        @endforeach
        </ul>
    </div>
@endsection
