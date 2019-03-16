@extends('layouts.public')

@section('title', 'Le Valeureux est devenu le Val’heureux')

@section('content')
<style>
    .currency-name {
        font-weight: bold;
        color: rgb(0, 148, 179);
    }
    .hhhhh {
        font-weight: bold;
        text-decoration: underline;
        color: rgb(195, 0, 69);
    }
    .old-new-bill {
        text-align: center;
    }
    .old-new-bill img {
        max-width: 100%;
    }
</style>

<div class="long-text">
    <h2 id="petit-rappel">Le Valeureux est devenu le Val<span class="hhhhh">’h</span>eureux</h2>

    <p>En octobre 2017, le « <span class="currency-name">Valeureux</span> » s’est transformé en « <span class="currency-name">Val<span class="hhhhh">’h</span>eureux</span> ».</p>

    <div class="old-new-bill">
        <img src="{{ asset('img/valeureux_valheureux.jpg') }}"
             srcset="{{ asset('img/valeureux_valheureux.jpg') }} 1x,
                     {{ asset('img/valeureux_valheureux@2x.jpg') }} 2x"
             alt="Une image d’un ancien et d’un nouveau billet de 1.">
    </div>

    <p>Notre monnaie circule maintenant dans une grande partie de la province de Liège. Nos billets ont évolué (<a href="/remplacement-anciens-billets" target="_blank" rel="noopener">les anciens billets sont échangeables contre des nouveaux</a>).</p>
    <p>Et notre site a changé ! L’adresse <span class="currency-name">valeureux.be</span> redirige maintenant sur <span class="currency-name">val<span class="hhhhh">h</span>eureux.be</span>. La seule différence, c’est le « h » en plus :-)</p>
    <p>Si vous utilisez toujours l’ancienne adresse du site, merci de la mettre à jour.</p>
    <p>Aller sur la <a href="/">page d’accueil du site</a>.</p>
</div>
@endsection
