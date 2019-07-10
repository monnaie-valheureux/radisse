@extends('layouts.public')

@section('title', 'Le projet')

@section('content')
    <style>
        .search-form {
            margin-left: 2.4rem;
            margin-bottom: 2.4rem;
        }
        form > div {
            margin-bottom: .8rem;
        }
        label {
            margin-right: .8rem;
        }
        .modes {
            display: none;
        }
        input[type="search"] {
            padding: 0.7rem 0.5em;
            border: 1px solid #999;
            border-radius: 6px;
            font-family: "museo_sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        }
        .score {
            display: none;
        }
        .search-results li:hover .score {
            display: inline;
            color: #ccc;
        }
        .search-results li {
            margin-bottom: .8rem;
        }
        mark {
            /*background-color: orange;*/
        }
    </style>

    <div class="search-form">
        <h2>Rechercher</h2>
        <form action="{{ route('search-query') }}" method="POST">
            <div class="modes">
                {!! Form::select('mode', [
                    'a' => 'Mode A',
                    'b' => 'Mode B',
                ], request('mode')) !!}
            </div>
            <input type="search" name="query" size="25" required
            placeholder="Commerce, village, etc."
            value="{{ request('query') }}">
            <button type="submit" class="button">Chercher</button>
        </form>

        @if (!isset($results))
            <p>Les résultats apparaîtront ici.</p>
        @elseif ($results->isEmpty())
            <p><strong>Aucun résultat ne correspond à votre recherche :(</strong></p>
        @else
            <h3>Résultats</h3>

            <ol class="search-results">
                @foreach ($results as $result)
                <li>
                    <a href="{{ $result['url'] }}">
                        <span class="formatted-result">{!! $result['text'] !!}</span>
                    </a>
                    <span class="result-type">({{ $result['type'] }})</span>
                    <span class="score">score : {{ $result['score'] }}</span>
                </li>
                @endforeach
            </ol>

            <p>(résultats calculés en {{ $elapsedTime }})</p>
        @endif
    </div>
@endsection
