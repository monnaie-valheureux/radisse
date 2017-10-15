@extends('admin.base-layout')

@section('title', 'Liste des partenaires prestataires')

@section('content')
    <ul>
        @foreach ($partners as $partner)
            <li>{{ $partner->name }}</li>
        @endforeach
    </ul>
@endsection
