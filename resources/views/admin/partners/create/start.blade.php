@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')
    <h2>Ajouter un nouveau prestataire partenaire</h2>

    <div class="tool-introduction">
        <div class="tool-introduction__description">
            <h3>Qu’est-ce que c’est ?</h3>
            <p>Cet outil permet d’ajouter un nouveau partenaire dans la base de données du Val’heureux. Quand il aura été ajouté, il devra ensuite être accepté par le comité membres pour pouvoir devenir un partenaire officiel.</p>
        </div>

        <div class="tool-introduction__what-do-i-need">
            <h3>De quoi ai-je besoin ?</h3>
            <ul>
                <li>De versions scannées <em>(de bonne qualité)</em> des documents signés par le partenaire (convention, charte, etc.).</li>
            </ul>
            <p class="tool-introduction__alternative-choice">Ou bien, si vous n’avez pas encore de versions scannées :</p>
            <ul>
                <li>Des documents papier signés par le partenaire.</li>
            </ul>
        </div>

        <div class="tool-introduction__steps-to-follow">
            <h3>Comment ça va se passer ?</h3>
            <p>L’ajout d’un partenaire se fait en plusieurs étapes. <em>Si vous ne pouvez pas toutes les faire maintenant, pas de panique : vous pourrez faire ça en plusieurs fois si vous en avez besoin.</em></p>
            <p>Les étapes sont :</p>
            <ol>
                <li>Remplir le nom et la forme juridique ;</li>
                <li>Choisir un nom de liste ;</li>
                <li>Indiquer le siège social du partenaire ;</li>
                <li>(optionnel) Ajouter un ou plusieurs lieux (magasin, restaurant, etc.) ;</li>
                <li>Indiquer un/des site(s) Internet et réseaux sociaux ;</li>
                <li>Ajouter une ou plusieurs personne(s) représentante(s) ;</li>
                <li>Envoyer les scans des documents signés (<em>ça, ça ne marche pas encore</em>).</li>
            </ol>
        </div>

        <p>Vous êtes prêt·e ? Cliquez sur le bouton pour commencer :-)</p>

        <form action="/gestion/partenaires/nom" method="get" class="tool-form">
            <p>
                <button type="submit" class="btn">Commencer</button>
            </p>
        </form>
    </div>
@endsection
