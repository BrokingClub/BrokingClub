@extends('layouts.game')

@section('content')

    {{ Fickle::openWidget(6, 'setting', 'Club info', 'users') }}
        <ul>
            <li>Name: <div class="setting-switch">Some club</div></li>
            <li>Tag: <div class="setting-switch">someclub</div></li>
            <li>Money: <div class="setting-switch">133.737 $</div></li>
            <li>Members: <div class="setting-switch">42</div></li>
            <li>Owner: <div class="setting-switch">Simon Schneider</div></li>
        </ul>
    {{ Fickle::closeWidget() }}

    {{ Fickle::openPanel('Performance', 6, ['controls' => 'minus,refresh,closepanel', 'padding' => false])}}
        <div id="hero-area"></div>
    {{ Fickle::closePanel() }}

@endsection