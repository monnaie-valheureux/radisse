@extends('layouts.admin')

@section('title', 'Interface de gestion - Le Val’heureux')

@section('content')

    <p>Bienvenue, {{ auth()->user()->given_name }}. Que souhaitez-vous faire ?</p>

    @if(Gate::any('add partners'))
    <div class="available-tasks">
        <h2>Gestion des prestataires partenaires</h2>
        <dl>
            @can('endorse partners')
            <div>
                <dt>
                    {{ Html::linkRoute('canvass-partner', 'Faire signer un nouveau partenaire') }}
                </dt>
                <dd>
                    Vous trouverez ici les documents de démarchage nécessaires pour faire signer un nouveau prestataire partenaire.
                </dd>
            </div>
            @endcan
            @can('add partners')
            <div>
                <dt>
                    {{ Html::linkRoute('create-partner', 'Ajouter un nouveau partenaire') }}
                </dt>
                <dd>
                    Une fois qu’un partenaire a signé, vous pouvez ajouter ses infos ici pour qu’il puisse être validé, ajouté au site, etc.
                </dd>
            </div>
            @endcan
        </dl>
    </div>
    @endif

@endsection
