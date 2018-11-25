@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')

    <div class="partner-list">

        <div class="go-back">
            <a href="/partenaires" class="go-back__link">
                ⬅ Retourner à la liste des villes et villages
            </a>
        </div>

        <h2 class="partner-list-main-heading">Partenaires sans adresse fixe</h2>

        <ul class="partner-list__sublist">
            @each ('public.partners.partner-list-item', $partners, 'partner')
        </ul>

    </div>
@endsection
