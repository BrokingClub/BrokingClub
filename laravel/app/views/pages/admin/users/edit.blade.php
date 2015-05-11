@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel("Edit " . $user->username, 12) }}

    {{ QForm::model($player, array('route' => array('admin.users.update', $player->id), 'method' => 'PUT')) }}

        {{ QForm::label('firstname', 'First name:') }}
        {{ QForm::text('firstname') }}

        {{ QForm::label('lastname', 'Last name:') }}
        {{ QForm::text('lastname') }}

        {{ QForm::text('email', $user->email) }}

        {{ QForm::text('username', $user->username) }}

        {{ Form::select('role', array('admin' => 'Administrator', 'user' => 'User'), $user->role, ['class' => 'form-control']) }}

        {{ QForm::btnPrimary('Submit', 'check') }}
    {{ QForm::close() }}

{{ Fickle::closePanel() }}

@endsection