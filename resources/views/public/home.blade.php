@extends('layouts.public')

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
        </div>
    </div>

@endsection

@push('body-scripts')
    <!--
        Randomly select the series of bills that will be displayed.

        This small script randomly selects a region among the existing ones.
        It then adds a class with this region’s name on the <body> element,
        thus causing the bills of that region to be displayed in the shape
        of a fan in the header of the home page.
    -->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

          // Abort if `Element.classList` is not supported. The bills
          // from the ‘liege’ region will be displayed as a fallback.
          if (('classList' in document.body) === false) {
            return;
          }

          var regions =
            [
                'herve',
                'huy-hesbaye-condroz',
                'liege',
                'ourthe-ambleve',
                'verviers',
            ];

          // Get a random integer between 0 and 4.
          var i = Math.floor(Math.random() * 5);

          document.body.classList.add('region-'+regions[i]);
        });
    </script>
@endpush
