@extends('admin.base-layout')

@section('title', $partner->name)

@section('content')
    <h1>{{ $partner->name }}</h1>

    <p>Nom de liste : <strong>{{ $partner->name_sort or '---' }}</strong></p>
    <p>Forme juridique : <strong>{{ $partner->business_type or 'inconnue' }}</strong></p>
@endsection
