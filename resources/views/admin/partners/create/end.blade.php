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

    <h3>Un problème ? Une question ?</h3>

    <p>L’essentiel de cet outil fonctionne, mais il doit encore évoluer un peu. Ça viendra. En attendant, il est déjà utilisable pour ajouter les nouveaux partenaires.</p>
    <p>Si vous pensez avoir repéré un problème ou un bug, ou bien si vous avez une question ou si quelque chose vous a semblé pas clair, signalez-le par e-mail à Michaël (<a href="mailto:&#x6d;&#105;&#99;h&#97;&#x65;&#108;&#64;e&#x73;t&#x73;u&#114;i&#x6e;&#x74;er.&#x6e;&#101;t">&#x6d;&#105;&#99;h&#97;&#x65;&#108;&#64;e&#x73;t&#x73;u&#114;i&#x6e;&#x74;er.&#x6e;&#101;t</a>) pour qu’il puisse s’en occuper.</p>
@endsection
