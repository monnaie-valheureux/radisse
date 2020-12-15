@extends('layouts.public')

@section('title', 'Liste des partenaires prestataires')

@section('content')
    <div class="partner-list">

        <h2 class="partner-list-main-heading">Où dépenser les Val’heureux ?</h2>

        <dl class="list-of-sections">
            <dt class="list-of-sections__section-name">
                <a href="/carte">Carte des commerces</a>
                <div class="badge badge--new">
                    <span class="badge__hidden-text">(</span>
                    nouveau
                    <span class="badge__hidden-text">)</span>
                </div>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>Cette carte interactive répertorie les commerces, comptoirs de change et autres lieux où vous pouvez obtenir et utiliser des val’heureux. C’est un bon moyen de trouver visuellement ceux qui sont proches de chez vous.</p>
            </dd>
            <dt class="list-of-sections__section-name">
                <a href="/partenaires/localites">Liste des villes et villages</a>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>La liste des {{ $cityCount }} villes et villages où l’on peut utiliser le Val’heureux, triés par ordre alphabétique. Idéal pour trouver d’un coup tous les commerces d’une localité en particulier.</p>
            </dd>
            <dt class="list-of-sections__section-name">
                <a href="/partenaires-sans-adresse-precise">Partenaires sans adresse fixe</a>
            </dt>
            <dd class="list-of-sections__section-description">
                <p>Un certain nombre de professionnels n’apparaissent ni sur la carte, ni dans les listes par localité. C’est généralement parce qu’ils ne travaillent pas à une adresse fixe (services ou travaux à domicile, arts du spectacle, etc.). Vous pouvez retouver ces partenaires ici.</p>
            </dd>
        </dl>

        <p class="additional-paragraph">Notez que certains professionnels acceptant le Val’heureux ne sont pas indiqués sur notre site, en général par obligation déontologique ou légale envers la publicité (médecins, etc.).</p>
    </div>
@endsection
