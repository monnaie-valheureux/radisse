@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

@php
    if ($draftPartner->name) {
        $breadcrumbs = [
            route('partners.index') => 'Gérer les partenaires',
            route('partner', $draftPartner->slug) => $draftPartner->name,
            'Nom et forme juridique',
        ];
    } else {
        $breadcrumbs = [
            route('partners.index') => 'Gérer les partenaires',
            'Nouveau partenaire',
        ];
    }
@endphp

    @breadcrumbs($breadcrumbs)

    <div class="tool-page-header">
        <p class="tool-page-header__tool-name">Ajouter un nouveau prestataire partenaire</p>
        <h2>Nom et forme juridique</h2>
    </div>

    <p>Ces infos se trouvent à la page 1 de la fiche de contact.</p>

    <form method="post" action="{{ route('partners.add.store-name') }}"
    class="tool-form">
        <div class="tool-form__control">
            {!! Form::label('name', 'Dénomination :', ['class' => 'label']) !!}

            <div class="contextual-help">
                <p>Il s’agit du nom officiel complet du partenaire.</p>
                <p>Le Val’heureux circule sur un large territoire. Pour réduire le risque d’avoir plusieurs partenaires avec un nom identique, il peut être utile d’être précis (on peut facilement imaginer qu’il existe plusieurs « cafés des sports » dans la province de Liège !).</p>
                <p>Quelques exemples fictifs de noms : « Boucherie Sanzot », « Antiquaires Loiseau Frères », « Compagnie théâtrale “Les Joyeux Turlurons” », « Salon de coiffure Anatole Lampion », , « Marbrier Isidore Boullu », « Fanfare de Moulinsart ».</p>
            </div>

            @errorhandling('name')

            <p>{!! Form::text('name', $draftPartner->name) !!}</p>
        </div>
        <div class="tool-form__control">
            {!! Form::label(
                'business_type',
                'Forme juridique :',
                ['class' => 'label']
            ) !!}

            <p>C’est le type de société ou d’organisation.</p>

            @errorhandling('business_type')

            <p>
                {!! Form::select(
                    'business_type',
                    $businessTypes,
                    $draftPartner->business_type,
                    [
                        'placeholder' => 'Choisissez une catégorie',
                    ]
                ) !!}
            </p>

            {{-- <input type="text" name="partner.new_business_type" id="partner.new_business_type"> --}}
        </div>

        <div class="tool-form__footer">
            {{ csrf_field() }}
            {!! Form::hidden('id', $draftPartner->id) !!}

            <p>À l’étape suivante, vous pourrez choisir un « nom de liste » pour ce partenaire.</p>
            <p>
                <button type="submit" name="submit" class="btn">Valider</button>
            </p>
        </div>
    </form>
@endsection
