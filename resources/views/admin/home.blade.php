@extends('layouts.admin')

@section('title', 'Interface de gestion - Le Val’heureux')

@section('content')

    <h2>Bienvenue, {{ auth()->user()->given_name }}.</h2>

@endsection
