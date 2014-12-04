@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel("Edit club", 12) }}
        {{ QForm::model($club, array('route' => array('clubs.update', $club->id), 'method' => 'PUT')) }}

                {{ QForm::readonly('username', $user->username) }}

                {{ QForm::label('firstname', 'First name:') }}
                {{ QForm::hidden('firstname') }}

                {{ QForm::label('lastname', 'Last name:') }}
                {{ QForm::text('lastname') }}

                {{ QForm::label('career', 'Career:') }}
                {{ QForm::readonly('career', $player->career) }}

                {{ QForm::readonly('email', $user->email) }}

                {{ QForm::readonly('username', $user->username) }}

                {{ QForm::btnPrimary('Submit', 'check') }}
            {{ QForm::close() }}
    {{ Fickle::closePanel() }}





@endsection