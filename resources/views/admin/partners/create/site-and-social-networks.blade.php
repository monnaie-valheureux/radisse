@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Site(s) et réseaux sociaux',
    ])

    <div class="tool-page-header">
        <h2>Réseaux sociaux</h2>
    </div>

    <form method="post" class="tool-form">
        {{--
        <fieldset>
            <legend>Site(s) Web (optionnels)</legend>
            <p>Indiquez ici l’adresse d’un ou plusieurs sites. Elles sera ou seront affichée(s) sur le site du Val’heureux.</p>
            <div>
                <label for="">http://</label><input type="text" name="" id="">
                <label for="">http://</label><input type="text" name="" id="">
            </div>
            <div>
                <label for="">http://</label><input type="text" name="" id="">
            </div>
        </fieldset>
        --}}

        <fieldset>
            <legend>Site(s) Web (optionnels)</legend>
            <p>Se trouve(nt) à la page 2 de la fiche de contact.</p>
            <p>Ces données seront affichées sur le site du Val’heureux.</p>

            <div class="tool-form__control">
                {!! Form::label('websites[0][url]', 'Site 1 :', ['class' => 'label']) !!}

                @errorhandling('websites.0.url')

                <p>{!! Form::text(
                    'websites[0][url]',
                    optional($websites->get(0))->__toString('url'),
                    ['size' => 27]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('websites[1][url]', 'Site 2 :', ['class' => 'label']) !!}

                @errorhandling('websites.1.url')

                <p>{!! Form::text(
                    'websites[1][url]',
                    optional($websites->get(1))->__toString('url'),
                    ['size' => 27]
                ) !!}</p>
            </div>
        </fieldset>

        <fieldset>
            <legend>Réseaux sociaux (optionnels)</legend>
            <p>Vous pouvez indiquer ici les réseaux sociaux (page Facebook, compte Twitter, etc.) utilisés par le partenaire. Ils trouvent à la page 2 de la fiche de contact.</p>
            <p>Ces données seront affichées sur le site du Val’heureux.</p>

            <div class="tool-form__control">
                {!! Form::label('social_networks[0][url]', 'Adresse 1 :', ['class' => 'label']) !!}

                @errorhandling('social_networks.0.url')

                <p>{!! Form::text(
                    'social_networks[0][url]',
                    optional($socialNetworks->get(0))->__toString('url'),
                    ['size' => 27]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('social_networks[1][url]', 'Adresse 2 :', ['class' => 'label']) !!}

                @errorhandling('social_networks.1.url')

                <p>{!! Form::text(
                    'social_networks[1][url]',
                    optional($socialNetworks->get(1))->__toString('url'),
                    ['size' => 27]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('social_networks[2][url]', 'Adresse 3 :', ['class' => 'label']) !!}

                @errorhandling('social_networks.2.url')

                <p>{!! Form::text(
                    'social_networks[2][url]',
                    optional($socialNetworks->get(2))->__toString('url'),
                    ['size' => 27]
                ) !!}</p>
            </div>
        </fieldset>

        <div class="tool-form__footer">
            {{ csrf_field() }}
            {!! Form::hidden('id', $partner->id) !!}

            <div class="btn-group btn-group__submit-or-skip">
                <p>
                    <button type="submit" name="submit" class="btn">Enregistrer ces infos</button>
                </p>
                <p class="or">ou bien</p>
                <p>
                    <button type="submit" name="skip" class="btn btn--skip">Sauter cette étape</button>
                </p>
            </div>
        </div>
    </form>

    {{-- Display a button to go back to the previous step. --}}
    <form action="{{ route('partners.add.location', compact('partner')) }}"
    method="GET" class="tool-form tool-form--go-back">
        <p>
            Vous pouvez aussi
            <button type="submit" class="btn btn--link">revenir à l’étape précédente</button>.
        </p>
    </form>
@endsection
