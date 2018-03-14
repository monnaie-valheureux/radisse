@extends('layouts.admin')

@section('title', 'Ajouter un nouveau prestataire partenaire')

@section('content')
    <h2>Envoyer une copie des documents officiels</h2>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum fugit suscipit nemo laboriosam, natus minima eaque maiores numquam vero est quis tempora incidunt tenetur obcaecati illum? Eius obcaecati cupiditate, quo.</p>
    <p>Nisi laborum ipsa aspernatur eaque, ab commodi odit beatae doloremque aperiam architecto libero, non dicta quibusdam, provident quam adipisci animi maiores consectetur.</p>

    <form action="/gestion/partenaires/ajouter/recapitulatif">
        <p>(Déterminer dynamiquement quels documents sont nécessaires, sachant que certains sont toujours obligatoires)</p>
        <div>
            <label for="">Convention :</label>
            <input type="file" name="" id="">
        </div>
        <div>
            <label for="">Charte :</label>
            <input type="file" name="" id="">
        </div>
        <div>
            <label for="">Whatever :</label>
            <input type="file" name="" id="">
        </div>

        <div><button type="submit" name="submit">Valider</button></div>
        <p>ou bien</p>
        <div><button type="submit" name="skip">Sauter cette étape</button></div>
    </form>
@endsection
