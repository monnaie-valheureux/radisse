@extends('layouts.admin')

@section('title', 'Interface de gestion - Le Val’heureux')

@section('content')

    <p>Bienvenue, {{ auth()->user()->given_name }}. Que souhaitez-vous faire ?</p>

    @if(Auth::user()->hasAnyPermission(['add partners', 'endorse partners']))
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
                    {{ Html::linkRoute('partners.index', 'Gérer les partenaires') }}
                </dt>
                <dd>
                    Une fois qu’un partenaire a signé, vous pouvez ajouter ses infos ici pour qu’il puisse être validé, ajouté au site, etc.
                    <br>
                    C’est aussi ici que l’on peut modifier les partenaires existants.
                </dd>
            </div>
            @endcan
        </dl>
    </div>
    @endif

    @if(Auth::user()->hasAnyPermission('add team members'))
    <div class="available-tasks">
        <h2>Gestion interne</h2>
        <dl>
            @can('add team members')
            <div>
                <dt>
                    {{ Html::linkRoute(
                        'manage-team-members',
                        'Gérer les bénévoles du val '.Auth::user()->team->name
                    ) }}
                </dt>
                <dd>
                    Cette page permet notamment de créer un compte pour un nouveau volontaire, ou de répartir les rôles entre eux.
                </dd>
            </div>
            @endcan
        </dl>
    </div>
    @endif

@endsection
