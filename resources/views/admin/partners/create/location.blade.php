@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Lieu d’activité',
    ])

    <div class="tool-page-header">
        <h2>Lieu où le partenaire exerce son activité</h2>
    </div>

    <p>Ces infos se trouvent à la page 2 de la fiche de contact. <strong>Toutes ces infos seront affichées publiquement (sur le site, etc.).</strong></p>

    <form method="post" class="tool-form">
        <fieldset>
            <legend>Adresse (obligatoire)</legend>
            <div class="tool-form__control">
                {!! Form::label('location_name', 'Nom du lieu :', ['class' => 'label']) !!}

                @errorhandling('location_name')

                <p>
                    {!! Form::text('location_name', $partner->name) !!}
                </p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('street', 'Nom de rue :', ['class' => 'label']) !!}

                @errorhandling('street')

                <p>{!! Form::text(
                    'street',
                   $address->street,
                   ['size' => 27]
               ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('street_number', 'Numéro(s) :', ['class' => 'label']) !!}

                @errorhandling('street_number')

                <p>{!! Form::text(
                    'street_number',
                    $address->streetNumber,
                    ['size' => 5]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('postal_code', 'Code postal :', ['class' => 'label']) !!}

                @errorhandling('postal_code')

                <p>{!! Form::text(
                    'postal_code',
                    $address->postalCode,
                    ['size' => 4]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label('city', 'Village ou ville :', ['class' => 'label']) !!}

                @errorhandling('city')

                <p>
                    {!! Form::text('city', $address->city) !!}
                </p>
            </div>
        </fieldset>

        <fieldset>
            <legend>Autres coordonnées</legend>
            <!--p><strong>N’indiquez ici que des informations publiques, qui peuvent être diffusées.</strong></p-->
            <div class="tool-form__control">
                <label for="phone" class="label">
                    Téléphone <span class="optional">(optionnel)</span> :
                </label>

                @errorhandling('phone')

                <p>{!! Form::text(
                    'phone',
                    $phone->toNationalFormat(),
                    ['inputmode' => 'tel', 'size' => 15]
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
    <form action="{{ route('partners.add.head-office', compact('partner')) }}"
    method="GET" class="tool-form tool-form--go-back">
        <p>
            Vous pouvez aussi
            <button type="submit" class="btn btn--link">revenir à l’étape précédente</button>.
        </p>
    </form>
@endsection
