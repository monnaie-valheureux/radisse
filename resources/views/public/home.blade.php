@extends('layouts.public')

@push('body-scripts')
    <script src="{{ mix('js/home.js') }}"></script>
@endpush


@section('content')

    <div class="homepage-intro">
        <div class="citizen-notes-hand">
            <div class="citizen-notes-hand-container">
                <div class="citizen-note citizen-note-05"></div>
                <div class="citizen-note citizen-note-1"></div>
                <div class="citizen-note citizen-note-5"></div>
                <div class="citizen-note citizen-note-10"></div>
                <div class="citizen-note citizen-note-20"></div>
            </div>
        </div>
        <div class="homepage-intro__intro-text">
            <h2>Le Val’heureux est une monnaie citoyenne</h2>
            <div class="homepage-intro__intro-paragraphs">
                <p>Il circule dans le bassin économique de la région liégeoise : entre Huy et Verviers, en Hesbaye, Condroz, Ourthe-Amblève et dans le pays de Herve.</p>
                <p>Le Val’heureux soutient les entrepreneurs locaux, renforce les circuits courts, et retient et fait circuler la richesse créée dans la région.</p>
            </div>
        </div>
    </div>

    <style>
        .general-assembly-wrapper {
            display: grid;
            grid-template-columns: 1fr minmax(calc(32rem - 3.2rem - 2px), 69rem) 1fr;
            grid-template-areas: '. content .';
            margin: 1.6rem 1.6rem 0;
        }
        .general-assembly {
            grid-area: content;
            padding-left: 1.6rem;
            padding-right: 1.6rem;
            border: 3px solid #c30045;
            border-radius: 4px;
        }
        .general-assembly h2 {
            text-align: center;
            color: #00819c;
        }
        .ag-when-where {
            text-align: center;
            font-weight: bold;
        }

        @media (min-width: 1000px) {
            .general-assembly-wrapper {
                grid-template-columns: 1fr minmax(calc(32rem - 3.2rem - 2px), 94.6rem) 1fr;
                margin: 3.2rem 3.2rem 0;
            }
            .general-assembly {
                padding-left: 3.2rem;
                padding-right: 3.2rem;
                font-size: 1.5em;
            }
        }
    </style>
    <div class="general-assembly-wrapper" id="assemblee-generale">
        <div class="general-assembly">
            <h2>Assemblée générale</h2>
            <div class="ag-when-where">
                Jeudi 13 juin, à partir de 18h<br>
                À Novacitis, rue de l'Académie 53, Liège
            </div>

            <p>Revoici venu ce moment important dans la vie de notre monnaie, qui est <em>entièrement gérée par des citoyennes et citoyens</em> : volontaires, commerçant(e)s et autres prestataires.</p>
            <p>Nous pensons qu’il est aujourd’hui temps de <em>franchir une nouvelle étape</em> dans le projet, en décidant collectivement de la gestion de la réserve de contrepartie, c’est-à-dire le stock d’euros équivalent à tous les val’heureux en circulation.</p>
            <p>De <strong>18h30 à 19h30, assemblée générale extraordinaire</strong> consacrée à la gestion de la réserve de contrepartie.</p>
            <p>À partir de <strong>20h15, assemblée générale ordinaire</strong> de l’ASBL le Val’heureux.</p>
            <p>Inscriptions : {!! Html::mailto('info@valheureux.be') !!}</p>
        </div>
    </div>

    <div class="text text--2columns">
        <div class="text__section">
            <h2>Comment en obtenir ?</h2>
            <p>Le moyen le plus simple pour échanger vos euros contre des Val’heureux est de vous rendre dans un <a href="/comptoirs">comptoir de change</a>.</p>
            <p>Vous pouvez également demander que l’on vous rende la monnaie en Val’heureux quand vous faites vos achats chez un commerçant qui les accepte.</p>
            <p>Enfin, vous pouvez également échanger vos euros lors de nos « <a href="/aperos-du-valheureux">apéros du Val’heureux</a> », tout en en profitant pour rencontrer et boire un verre avec les gens qui font vivre ce projet !</p>
        </div>
        <div class="text__section">
            <h2>Où les utiliser ?</h2>
            <p>Les commerces et prestataires acceptant la monnaie ont généralement un autocollant « Ici circule le Val’heureux » devant chez eux.</p>
            <p>Vous pouvez aussi jeter un œil à la vaste <a href="/partenaires">liste des membres du réseau</a> et ainsi, qui sait, découvrir de nouveaux lieux sympathiques !</p>

            <h2>Être tenu au courant</h2>
            <p>Envie de recevoir, une fois par trimestre, les dernières nouvelles du Val’heureux dans votre boîte mail ? Il vous suffit de vous inscrire ici !</p>

            <form action="{{ route('newsletter-subscription') }}" method="POST"
            class="newsletter-subscription-form">
                <input type="email" name="email" required
                class="newsletter-subscription-form__email-input"
                placeholder="email@exemple.com">
                <button type="submit" class="button">S’inscrire</button>
            </form>

            <p>Vous pourrez vous désinscrire à n’importe quel moment.</p>
        </div>
    </div>

@push('body-styles')
<style>
    .old-bills-announcement {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1.6rem;
        padding-right: 1.6rem;
        margin-bottom: 2em;
        font-size: 1.4rem;
        line-height: 1.8rem;
    }
    .icon--information {
        width: 2.5rem;
        margin-right: 1.5rem;
        fill: rgb(0, 97, 116);
    }
    @media (min-width: 750px) {
        .old-bills-announcement {
            max-width: 62rem;
            font-size: 2rem;
            line-height: 2.5rem;
        }
    }
    @media (min-width: 1000px) {
        .old-bills-announcement {
            max-width: 80rem;
        }
    }
</style>
@endpush

    <div class="old-bills-announcement">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon--information"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
        </div>
        <div>
            <p>
                Vous possédez encore des anciens billets de valeureux ? Vous pouvez les échanger contre de nouveaux billets lors de nos <a href="/aperos-du-valheureux">apéros</a>, ou bien en contactant l’ASBL le Val’heureux.
                <a href="/remplacement-anciens-billets">Cliquez ici pour plus d’infos</a>.
            </p>
        </div>
    </div>

@endsection
