@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Demande de suppression',
    ])

    <div class="tool-page-header">
        <h2>Demande de suppression de « {{ $partner->name }} »</h2>
    </div>

    <p>Erreur de doublon ? Partenaire créé par erreur ? Autre problème ? Vous pouvez utiliser ce formulaire pour demander à Michaël (qui gère le site) de supprimer ce partenaire.</p>
    <p>Merci de bien expliquer le problème pour faciliter la vérification ou la correction des infos. C’est d’autant plus utile si jamais il faut regrouper des données en cas de doublon.</p>

    <form method="post" class="tool-form">
        <div class="tool-form__control">
            {!! Form::label('reason', 'Raisons pour supprimer ce partenaire :', ['class' => 'label']) !!}

            @errorhandling('reason')

            <p>{!! Form::textarea(
                'reason',
               '',
               ['size' => '33x10']
           ) !!}</p>
        </div>
        <div class="tool-form__control">
            <strong>Demande faite par :</strong><br>
            {{ auth()->user()->given_name }}
            {{ auth()->user()->surname }}
            ({{ auth()->user()->email }})
            <br>
            Val de {{ auth()->user()->team->name }}
            <br><br>
            <strong>Numéro d’identification du partenaire :</strong><br>
            {{ $partner->id }}<br><br>
            <strong>Date d’ajout :</strong><br>
            {{ $partner->created_at->format('d/m/Y à H:i') }}<br>

            @if ($partner->isValidated())
                <br>
                <strong>Attention :</strong> ce partenaire est <strong>validé</strong> et <strong>sa suppression l’enlèvera du site</strong>.
            @endif
        </div>

        <div class="tool-form__footer">
            {{ csrf_field() }}
            {!! Form::hidden('partner_id', $partner->id) !!}
            {!! Form::hidden('team_member_id', auth()->user()->id) !!}

            <div class="btn-group">
                <p>
                    <button type="submit" name="submit" class="btn">Envoyer la demande</button>
                </p>
            </div>
        </div>
    </form>

    {{-- Display a button to go back to the previous step. --}}
    <form action="{{ route('partners.add.summary', compact('partner')) }}" method="GET"
    class="tool-form tool-form--go-back">
        <p>
            Ou bien
            <button type="submit" class="btn btn--link">revenir à la page précédente</button>.
        </p>
    </form>
@endsection
