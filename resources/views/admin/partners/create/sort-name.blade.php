@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')
    <div class="tool-page-header">
        <p class="tool-page-header__tool-name">Ajouter un nouveau prestataire partenaire</p>
        <h2>Nom de liste</h2>
    </div>

    <form method="post" class="tool-form">
        <div class="tool-form__control">
            <div class="contextual-help">
                <p>Le « nom de liste » est le nom utilisé le plus fréquemment pour nommer un partenaire. Par extension, c’est ce nom qui est utilisé dans les listes, pour que le partenaire soit plus facile à trouver.</p>
                <p>Par exemple, le « Centre liégeois du Beau-Mur » est le plus souvent appelé « Beau-Mur ». Et, en cherchant ce partenaire dans une liste, les gens vont spontanément regarder à la lettre « B », comme « Beau-Mur » (et pas à la lettre « C », comme « Centre »). Son nom de liste est donc « Beau-Mur (centre liégeois du) ».</p>
                <p>Autre exemple : à quelle lettre chercheriez-vous la célèbre boucherie Sanzot (des aventures de Tintin) ? À la lettre « B », comme « Boucherie » ? Non : si on faisait comme ça, elle serait perdue au milieu de nombreuses autres boucheries, boulangeries, etc. On choisira plutôt la lettre « S », et le nom de liste sera « Sanzot (boucherie) ».</p>
                <p>Pour trouver un bon nom de liste, il faut d’abord se poser la question : « à quelle lettre est-ce que je chercherais spontanément ce partenaire ? ». Si vous ne trouvez pas, ce n’est pas très grave : il n’y a pas vraiment de bonne ou de mauvaise réponse. Au final, le nom de liste est simplement une aide pour trouver plus facilement un partenaire.</p>

                <p>Rappel : le nom officiel est « <span>{{ $partner->name }} »</span>.</p>
            </div>

            {!! Form::label('name_sort', 'Nom de liste :', ['class' => 'label']) !!}

            @errorhandling('name_sort')

            <p>{!! Form::text('name_sort', $partner->name_sort, ['size' => 30]) !!}</p>
            {{-- {{ dd(session('draftPartner')) }} --}}
        </div>
        <div class="tool-form__footer">
            {{ csrf_field() }}
            {!! Form::hidden('id', $partner->id) !!}

            <div class="btn-group btn-group__submit-or-skip">
                <p>
                    <button type="submit" name="submit" class="btn">Valider</button>
                </p>
                <p class="or">ou bien</p>
                <p>
                    <button type="submit" name="skip" class="btn btn--skip">Décider plus tard</button>
                </p>
            </div>
        </div>
    </form>

    {{-- Display a button to go back to the previous step. --}}
    <form action="{{ route('partners.add.name', compact('partner')) }}" method="GET"
    class="tool-form tool-form--go-back">
        <p>
            Vous pouvez aussi
            <button type="submit" class="btn btn--link">revenir à l’étape précédente</button>.
        </p>
    </form>
@endsection
