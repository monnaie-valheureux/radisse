@extends('layouts.public')

@section('title', 'Inscription à notre newsletter')

@section('content')
<div class="long-text">
    <h2>Et voilà !</h2>
    <p>Votre adresse email, <strong>{{ $email }}</strong>, a bien été inscrite à notre « newsletter ». Vous devriez recevoir de nos nouvelles une fois tous les trois mois.</p>
    <p>Merci de votre intérêt pour le Val’heureux ! :-)</p>
    <p>Si jamais vous souhaitez vous désinscrire, il vous suffira de cliquer sur le lien « Se désabonner » situé à la fin de chaque e-mail.</p>
    <p><a href="{{ route('home') }}">Revenir sur la page d’accueil du site</a></p>
</div>
@endsection
