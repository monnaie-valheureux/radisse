@extends('layouts.public')

@section('title', 'Système de paiement électronique')

@section('content')
<style>
    h2 {
        text-align: center;
    }
    form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 3rem;
        text-align: center;
    }
    button {
        /* Spec asked to make the button bigger… (designer joke) */
        font-size: 5rem;
    }
    form div + div {
        margin-top: 5rem;
    }
</style>

<h2>Système de paiement électronique</h2>
<form>
    <div>
        <button>Adhérer</button>
    </div>
    <div>
        <button>Mon compte</button>
    </div>
</form>
@endsection
