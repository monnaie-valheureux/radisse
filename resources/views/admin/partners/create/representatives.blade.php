@extends('layouts.admin')

@section('title', 'Personne(s) représentante(s) de « '.$partner->name.' » — Gestion du Val’heureux')

@section('content')
    <h2>Personne(s) représentante(s)</h2>

    <p>Ces infos sont destinées à l’<em>usage interne de l’ASBL</em>. On les trouve à la page 3 de la fiche de contact.</p>

    <form method="post" class="tool-form">
@for ($i = 0; $i < 2; $i++)
        <fieldset>
        @if ($i === 0)
            <legend>Personne 1 (obligatoire)</legend>
        @else
            <legend>Personne {{ $i + 1 }} (optionnelle)</legend>
        @endif
            <div class="tool-form__control">
                {!! Form::label("representatives[$i][given_name]", 'Prénom :', ['class' => 'label']) !!}

                @errorhandling("representatives.{$i}.given_name")

                <p>{!! Form::text("representatives[$i][given_name]", optional($representatives->get($i))->given_name) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label("representatives[$i][surname]", 'Nom :', ['class' => 'label']) !!}

                @errorhandling("representatives.{$i}.surname")

                <p>{!! Form::text("representatives[$i][surname]", optional($representatives->get($i))->surname) !!}</p>
            </div>
            <div class="tool-form__control">
                {!! Form::label("representatives[$i][role]", 'Rôle au sein du partenaire :', ['class' => 'label']) !!}

                @errorhandling("representatives.{$i}.role")

                <p>{!! Form::text("representatives[$i][role]", optional($representatives->get($i))->role) !!}</p>
            </div>
            <div class="tool-form__control">
                <label for="representatives[{{ $i }}][email]" class="label">
                    Adresse e-mail personnelle <span class="optional">(optionnelle)</span> :
                </label>

                @errorhandling("representatives.{$i}.email")

                <p>{!! Form::email(
                    "representatives[$i][email]",
                    optional($representatives->get($i))->email,
                    ['id' => "representatives[$i][email]", 'size' => 27]
                ) !!}</p>
            </div>
            <div class="tool-form__control">
                <label for="representatives[{{ $i }}][phone]" class="label">
                    Numéro de téléphone personnel <span class="optional">(optionnel)</span> :
                </label>

                @errorhandling("representatives.{$i}.phone")

                <p>{!! Form::text(
                    "representatives[$i][phone]",
                    optional($representatives->get($i))->phone,
                    [
                        'id' => "representatives[$i][phone]",
                        'inputmode' => 'tel',
                        'size' => 15
                    ]
                ) !!}</p>
            </div>
        </fieldset>
@endfor

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
    <form action="{{ route('partners.add.site-and-social-networks', compact('partner')) }}" method="GET" class="tool-form tool-form--go-back">
        <p>
            Vous pouvez aussi
            <button type="submit" class="btn btn--link">revenir à l’étape précédente</button>.
        </p>
    </form>
@endsection
