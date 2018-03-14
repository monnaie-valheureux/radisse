@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

{{--
    @if (session('foo'))
        <ul style="border: 1px solid #333;">
        @foreach (array_wrap(session('foo')) as $item)
@php
    switch ($item['change']) {
        case 'create':
            $color = '66f';
            break;
        case 'update':
            $color = '060';
            break;
        case 'delete':
            $color = 'f00';
            break;
    }
@endphp
            <li style="color: #{{ $color  }}">{{ $item['message'] }}</li>
        @endforeach
        </ul>
    @endif
--}}

    <h2>Faut-il associer un lieu à ce partenaire ?</h2>

    <form action="/gestion/partenaires/{{ $partner->slug }}/question-lieu"
        method="post" class="tool-form">
        <p>Le prestataire partenaire dispose-t-il d’au moins un lieu public où les gens peuvent se rendre pour bénéficier de ses services ?</p>
        <p>Ce lieu sera repris sur le site, dans les listes de partenaires, etc.</p>
        <div class="contextual-help">
            <p>Dans la plupart des cas (commerce, café, restaurant, cabinet, etc.), c’est oui.</p>
            <p>Ça pourrait être <em>non</em> dans le cas où le partenaire travaille en déplacement chez ses clients ou ailleurs, vend sur des marchés, etc. Exemples : aide-soigant·e, plafonneur/euse, groupe de musique, magicien·ne, etc.</p>
        </div>

        <!--div>
            {{ csrf_field() }}
            {!! Form::hidden('id', $partner->id) !!}

@if ($hasHeadOfficeAddress)
            <button type="submit" name="submit-location-in-head-office">
                Oui, à la même adresse qu’au siège social
            </button>
@else
            <button disabled="">
                Oui, à la même adresse qu’au siège social
            </button>
            (pour ça, vous devez d’abord <a href="{{ route('partners.add.head-office', compact('partner')) }}">ajouter l’adresse du siège social</a>)
@endif
        </div-->
    </form>

    <form action="/gestion/partenaires/{{ $partner->slug }}/question-lieu"
        method="post" class="tool-form">
        <div>
            {{ csrf_field() }}
            {!! Form::hidden('id', $partner->id) !!}

            <p>
                <button type="submit" name="submit-location-new-address" class="btn">
                    Oui<!--, à un autre endroit qu’au siège social-->
                </button>
            </p>
        </div>
    </form>

    <form action="/gestion/partenaires/{{ $partner->slug }}/site-et-reseaux-sociaux"
        method="get" class="tool-form">
        <div>
            <p>
                <button type="submit" class="btn">
                    Non, pas de lieu accessible au public
                </button>
            </p>
        </div>
    </form>

    {{-- Display a button to go back to the previous step. --}}
    <form action="{{ route('partners.add.head-office', compact('partner')) }}" method="GET"
    class="tool-form tool-form--go-back">
        <p>
            Vous pouvez aussi
            <button type="submit" class="btn btn--link">revenir à l’étape précédente</button>.
        </p>
    </form>
@endsection
