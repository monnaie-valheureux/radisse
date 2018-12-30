@extends('layouts.public')

@section('title', 'Remplacement des anciens billets')

@section('content')
<style>
    .bills-fan {
        text-align: center;
    }
    .bills-fan img {
        width: 100%;
        max-width: 350px;
    }
    hr {
        margin-top: 4rem;
        margin-bottom: 4rem;
        border: 1px solid #0094b3;
    }
</style>

<div class="long-text">
    <div class="long-text__table-of-contents">
        <h2>Remplacement des anciens billets</h2>

        <div class="bills-fan">
            <img src="{{ asset('img/series1_fan.jpg') }}" alt="">
        </div>

        <p>Vous possédez encore des anciens billets de valeureux ? Vous pouvez les échanger contre de nouveaux billets lors de nos <a href="/aperos-du-valheureux">apéros</a>, ou bien en contactant l’ASBL le Val’heureux.</p>

        <ol>
            <li>
                <a href="#petit-rappel">Petit rappel</a>
            </li>
            <li>
                <a href="#pourquoi-retirer-les-anciens-billets-de-la-circulation">
                    Pourquoi retirer les anciens billets de la circulation ?
                </a>
            </li>
            <li>
                <a href="#que-se-passera-t-il-a-partir-de-septembre">
                    Est-ce que mes billets vont perdre leur valeur ?
                </a>
            </li>
            <li>
                <a href="#que-deviennent-les-anciens-billets">
                    Que deviennent les anciens billets ?
                </a>
            </li>
            <li>
                <a href="#garder-anciens-billets-comme-souvenir">
                    Moi j’aimais bien les anciens billets… Je peux les garder comme souvenir ?
                </a>
            </li>
        </ol>
    </div>

    <h2 id="petit-rappel">Petit rappel</h2>

    <p>En octobre 2017, le « Valeureux » s’est transformé en « Val<strong>’h</strong>eureux ». Depuis, la monnaie circule dans la majorité de la province de Liège.</p>
    <p>À cette occasion, de nouveaux billets ont été mis en circulation, principalement pour deux raisons :</p>
    <ol>
        <li>Tandis qu’il y avait encore assez de billets pour que la monnaie circule dans la ville de Liège, le stock aurait été insuffisant pour couvrir la nouvelle zone élargie ;</li>
        <li>Les anciens billets représentaient uniquement des symboles liégeois. Maintenant que le Val’heureux circule au delà de la Cité ardente, les nouveaux billets permettent de mettre en avant des particularités de tout le territoire (fromage de Herve, château de Jehay, Paix de Fexhe,…).</li>
    </ol>
    <p>Par ailleurs, vu la manière dont le Valeureux avait évolué durant les quelques années précédentes, nous souhaitions aussi mettre en circulation des billets de 20 (avant cela, le billet de 10 était la plus grosse coupure).</p>

    <h2 id="pourquoi-retirer-les-anciens-billets-de-la-circulation">Pourquoi retirer les anciens billets de la circulation ?</h2>

    <p>Avoir deux séries de billets différents en circulation, c’est un peu confus. D’autant plus que les billets n’ont pas les mêmes dimensions ni le même style graphique. Mettre les anciens billets à la retraite permet de clarifier les choses.</p>
    <p>Ensuite, gérer deux séries en parallèle représente un certain travail pour l’ASBL du Val’heureux, et nous aimerions pouvoir libérer du temps et de l’énergie (entièrement bénévoles) pour les consacrer à des choses plus importantes pour le projet, comme par exemple le réseau de commerçants qui ne cesse de grandir.</p>

    <h2 id="que-se-passera-t-il-a-partir-de-septembre">Est-ce que mes billets vont perdre leur valeur ?</h2>

    <p>Non. <strong>Les anciens billets de Valeureux garderont toujours leur valeur.</strong> Mais nous vous conseillons de les échanger contre des nouveaux. Pour cela, contactez directement l’ASBL, ou venez à l’un de nos évènements (comme par exemple les <a href="/aperos-du-valheureux">apéros du Val’heureux</a>).</p>

    <h2 id="que-deviennent-les-anciens-billets">Que deviennent les anciens billets ?</h2>

    <p>Ils sont tous rassemblés par une personne responsable au sein de l’ASBL. Ensuite, ils sont tous scrupuleusement recomptés plusieurs fois, un par un, par trois personnes différentes, puis nous les sortons officiellement de la circulation au niveau comptable. Enfin, ils sont physiquement détruits et rejoignent le paradis des monnaies locales, après presque cinq ans de bons et loyaux services :-)</p>

    <h2 id="garder-anciens-billets-comme-souvenir">Moi j’aimais bien les anciens billets… Je peux les garder comme souvenir ?</h2>

    <p>Bien sûr ! Vous pouvez tout à fait garder des anciens billets si vous le souhaitez. Gardez juste à l’esprit que cela reste de « vrais » sous, et qu’ils resteront toujours échangeables dans le futur.</p>
</div>
@endsection
