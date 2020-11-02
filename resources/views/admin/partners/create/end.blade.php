@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Validation',
    ])

    <h2>Voilà, c’est fini !</h2>

    <p>Le partenaire « {{ $partner->name }} » a été ajouté au site !</p>

    <form action="/gestion/partenaires/nom" method="get" class="tool-form">
        <p>
            <button type="submit" class="btn">Ajouter un autre partenaire</button>
        </p>
    </form>

    <p>
        <a href="{{ route('partners.index') }}">
            Revenir à la liste de tous les partenaires
        </a>
    </p>
@endsection
