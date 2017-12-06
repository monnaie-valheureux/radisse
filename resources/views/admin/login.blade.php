@extends('layouts.admin')

@section('title', 'Connexion - Interface de gestion - Le Val’heureux')

@section('content')

    <h2>Se connecter</h2>

    <form method="POST" action="{{ route('login') }}">

        {{ csrf_field() }}

        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Adresse e-mail</label>

            <div>
                <input type="email" id="email"
                name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Mot de passe</label>

            <div>
                <input id="password" type="password" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
        </div>

        <div>
            <button type="submit">Valider</button>
        </div>
    </form>


@endsection
