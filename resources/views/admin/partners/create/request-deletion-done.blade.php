@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Demande de suppression',
    ])

    <div class="tool-page-header">
        <h2>Demande de suppression envoyée</h2>
    </div>

    <p>Voilà, la demande est bien partie ! Michaël va recevoir un e-mail avec ces infos et s’en occupera quand qu’il le pourra :-)</p>

    <p>
        <a href="{{ route('partners.add.summary', compact('partner')) }}">
            Revenir au récapitulatif de « {{ $partner->name }} »
        </a>
    </p>
    <p>
        <a href="{{ route('partners.index') }}">
            Revenir à la liste de tous les partenaires
        </a>
    </p>
@endsection
