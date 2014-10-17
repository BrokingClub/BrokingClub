@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel() }}
        Debug this

    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('What What', 6) }}
        Debug this

    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('In tha but', 6) }}
        Debug that

    {{ Fickle::closePanel() }}


@endsection