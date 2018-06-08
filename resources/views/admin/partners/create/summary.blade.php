@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')

    @breadcrumbs([
        route('partners.index') => 'Gérer les partenaires',
        route('partner', $partner->slug) => $partner->name,
        'Récapitulatif',
    ])

    <h2>Récapitulatif</h2>

    <p>Voici un récapitulatif des différentes informations du partenaire.</p>
    <p>Merci, s’il y en a, de corriger les éventuelles erreurs qui signalées en <span class="error-color">rouge</span> (obligatoires) ou en <span class="warning-color">orange</span> (pas complètement obligatoires, mais très recommandées).</p>

    <form action="/gestion/partenaires/{{ $partner->slug }}/validation"
    method="post" class="tool-form">
        <ul>
            <li class="">
                <strong>Nom et forme juridique :</strong><br>
                <span>
                    {{ $summary['name'] }}
@if ($summary['business_type'])
                    ({{ $summary['business_type'] }})
@else
                    <div class="help-block validation-warning">
                        <p>Il manque la forme juridique.</p>
                    </div>
@endif
                </span>
                <p>
                    ⬅️ <a href="{{ route('partners.add.name', compact('partner')) }}">
                        Revenir à cette étape
                    </a>
                </p>
            </li>

            <li class="">
                <strong>Nom de liste :</strong><br>
                <span>
@if ($summary['name_sort'])
                    {{ $summary['name_sort'] }}
@else
                    <div class="help-block validation-error">
                        <p>Cette info manque.</p>
                    </div>
@endif
                </span>
                <p>
                    ⬅️ <a href="{{ route('partners.add.sort-name', compact('partner')) }}">
                        Revenir à cette étape
                    </a>
                </p>
            </li>
            <li class="">
                <strong>Siège social :</strong><br>
@if ($summary['head_office']['address'])
                    {!! $summary['head_office']['address']->toHtml() !!}
@else
                    <div class="help-block validation-error">
                        <p>Il manque l’adresse du siège social.</p>
                    </div>
@endif

@if ($summary['head_office']['phone'])
                    <p>
                        Téléphone :
                        {{ $summary['head_office']['phone']->toNationalFormat() }}
                    </p>
@else
                    <div class="help-block validation-neutral">
                        <p>Aucun numéro de téléphone n’a été indiqué.</p>
                    </div>
@endif

@if ($summary['head_office']['email'])
                    <p>
                        E-mail :
                        {{ Html::mailto($summary['head_office']['email']) }}
                    </p>
@else
                    <div class="help-block validation-neutral">
                        <p>Aucune adresse e-mail n’a été indiquée.</p>
                    </div>
@endif
                {{-- <span class="">Cette adresse est aussi un lieu accessible au public</span> --}}
                <p>
                    ⬅️ <a href="{{ route('partners.add.head-office', compact('partner')) }}">
                        Revenir à cette étape
                    </a>
                </p>
            </li>

            <li class="">
@if (count($summary['locations']) > 1)
                <strong>Lieux :</strong><br>
@else
                <strong>Lieu :</strong><br>
@endif
                <ul>
@forelse ($summary['locations'] as $location)
                    <li>
                        <p>{!! $location['address']->toSimplifiedHtml() !!}</p>
    @if ($location['phone'])
                        <p>
                            Téléphone : {{ $location['phone']->toNationalFormat() }}
                        </p>
    @endif
                    </li>
@empty
                    <li>
                        <div class="help-block validation-neutral">
                            <p>Aucun lieu public n’a été indiqué.</p>
                        </div>
                    </li>
@endforelse
                </ul>
                <p>
                    ⬅️ <a href="{{ route('partners.add.location', compact('partner')) }}">
                        Revenir à cette étape
                    </a>
                </p>
            </li>

            <li class="">
                <strong>Site(s) et réseaux sociaux :</strong><br>
                <ul>
@forelse ($summary['websites'] as $site)
                    <li>
                        <span>
                            {{ Html::link($site->url) }}
                        </span>
                    </li>
@empty
                    <li>
                        <div class="help-block validation-neutral">
                            <p>Aucun site n’a été indiqué.</p>
                        </div>
                    </li>
@endforelse
                </ul>
                <br>

                <ul>
@forelse ($summary['social_networks'] as $network)
                    <li>
                        <span>
                            {{ $network->officialName }} :
                            {{ Html::link($network->url) }}
                        </span>
                    </li>
@empty
                    <li>
                        <div class="help-block validation-neutral">
                            <p>Aucun réseau social n’a été indiqué.</p>
                        </div>
                    </li>
@endforelse
                </ul>
                <p>
                    ⬅️ <a href="{{ route('partners.add.site-and-social-networks', compact('partner')) }}">
                        Revenir à cette étape
                    </a>
                </p>
            </li>

            <li class="">
@if (count($summary['representatives']) > 1)
                <strong>Personnes représentantes :</strong><br>
@else
                <strong>Personne représentante :</strong><br>
@endif
                <ul>
@forelse ($summary['representatives'] as $rep)
                    <li>
                        <p>
                            {{ $rep['given_name'] }}
                            {{ $rep['surname'] }},
                            {{ $rep['role'] }}
                        </p>
    @if ($rep['phone'])
                        <p>
                            Téléphone : {{ $rep['phone']->toNationalFormat() }}
                        </p>
    @endif
    @if ($rep['email'])
                        <p>E-mail : {{ Html::mailto($rep['email']) }}</p>
    @endif
                    </li>
@empty
                    <li>
                        <div class="help-block validation-error">
                            <p>Il faut au moins une personne représentante</p>
                        </div>
                    </li>
@endforelse
                </ul>
                <p>
                    ⬅️ <a href="{{ route('partners.add.representative', compact('partner')) }}">
                        Revenir à cette étape
                    </a>
                </p>
            </li>

            <!--li class="">
                <strong>Documents officiels :</strong><br>
                <ul>
                    <li>X Convention</li>
                    <li>V Charte</li>
                    <li>V Whatever</li>
                </ul>
                <p><a href="">Revenir à cette étape</a></p>
            </li-->
        </ul>

        <div class="tool-form__footer">

            {{--
                If the partner has not been validated yet,
                we provide a button to to just that.
            --}}
            @if ($partner->isNotValidated())

                {{ csrf_field() }}
                {!! Form::hidden('id', $partner->id) !!}

                <div class="help-block validation-warning">
                    <p><strong>De manière temporaire</strong>, les partenaires ajoutés peuvent être automatiquement validés.</p>
                    <p>Dans le futur, pour éviter toute erreur, la validation finale sera réservée aux personnes du comité « membres ». Vous pourrez toujours ajouter de nouveaux partenaires, c’est juste qu’ils devront être validés avant d’apparaître sur le site.</p>
                </div>

                <p>
                    <button type="submit" name="submit" class="btn">Valider ce partenaire</button>
                </p>

            @else
                {{--
                    If the partner has already been validated once, we will
                    display the date of validation. And, if this info is
                    available, we will also indicate which team member
                    did the validation of that partner.
                --}}
                @if ($partner->validator)
                    <p>
                        Ce partenaire a été validé le
                        {{ $partner->validated_at->format('d/m/Y') }}
                        par
                        {{ $partner->validator->given_name }}
                        {{ $partner->validator->surname }}.
                    </p>
                @else
                    <p>
                        Ce partenaire a été validé le
                        {{ $partner->validated_at->format('d/m/Y') }}.
                    </p>
                @endif

            @endif
        </div>
    </form>
@endsection
