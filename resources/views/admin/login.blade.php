@extends('layouts.admin')

@section('title', 'Connexion - Interface de gestion - Le Val’heureux')

@section('content')

    <h2>Se connecter</h2>

    <form method="POST" action="{{ route('login') }}" class="tool-form">

        {{ csrf_field() }}

        <div class="tool-form__control{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="label">Adresse e-mail :</label>

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

        <div class="tool-form__control{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="label">Mot de passe :</label>

            <div>
                <input id="password" type="password" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="tool-form__footer">
            <button type="submit" name="submit" class="btn">Me connecter</button>
        </div>
    </form>


@endsection
