@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Siège social',
    ])

    <div class="tool-page-header">
        <p class="tool-page-header__tool-name">Ajouter un nouveau prestataire partenaire</p>
        <h2>Siège social de « {{ $partner->name }} »</h2>
    </div>

    <p>Ces infos se trouvent à la page 1 de la fiche de contact.</p>

    <form method="post" class="tool-form">
{{--
            "email": "v.lohest@gmail.com",
            "phone": "+32495536535",
            "address": {
                "label": null,
                "street": "en Neuvice",
                "street_number": "37",
                "postal_code": 4000,
                "city": "Liège"
            }
--}}
        <fieldset>
            <legend>Adresse (obligatoire)</legend>
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

                <p>{!! Form::text('city', $address->city) !!}</p>
            </div>
        </fieldset>

        <fieldset>
            <legend>Autres coordonnées</legend>
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
            <div class="tool-form__control">
                {!! Form::checkbox('phone_is_public', null, $phone_is_public, [
                    'id' => 'phone_is_public'
                ]) !!}
                <label for="phone_is_public">
                    Cochez cette case si ce numéro est <strong>public</strong> et peut-être diffusé sur le site, des flyers, etc.
                </label>
            </div>

            <div class="tool-form__control">
                <label for="email" class="label">
                    Adresse e-mail <span class="optional">(optionnel)</span> :
                </label>

                @errorhandling('email')

                <p>{!! Form::email(
                    'email',
                    $email->address,
                    ['size' => 27]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::checkbox('email_is_public', null, $email_is_public, [
                    'id' => 'email_is_public'
                ]) !!}
                <label for="email_is_public">
                    Cochez cette case si cette adresse e-mail est <strong>publique</strong> et peut-être diffusé sur le site, des flyers, etc.
                </label>
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
    <form action="{{ route('partners.add.sort-name', compact('partner')) }}" method="GET"
    class="tool-form tool-form--go-back">
        <p>
            Vous pouvez aussi
            <button type="submit" class="btn btn--link">revenir à l’étape précédente</button>.
        </p>
    </form>
@endsection
