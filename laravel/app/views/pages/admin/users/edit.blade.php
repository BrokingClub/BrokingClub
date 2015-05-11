@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel("Edit " . $user->username . ", UserID: " . $user->id, 12) }}

    <div class="col-md-6">
    {{ QForm::model($player, array('route' => array('admin.users.update', $player->id), 'method' => 'PUT')) }}
        {{ QForm::label('firstname', 'First name:') }}
        {{ QForm::text('firstname') }}

        {{ QForm::label('lastname', 'Last name:') }}
        {{ QForm::text('lastname') }}

        {{ QForm::text('email', $user->email) }}

        {{ QForm::text('username', $user->username) }}

        {{ QForm::label('role', 'Role') }}
        {{ Form::select('role', array('admin' => 'Administrator', 'user' => 'User'), $user->role, ['class' => 'form-control']) }}

        <br/>{{ QForm::btnPrimary('Submit', 'check') }}
    </div>
    <div class="col-md-6">
        {{ QForm::label('career', 'Career') }}
        {{ Form::select('career', $careers, $player->career_id, ['class' => 'form-control']) }}
        <br/>
        {{ QForm::label('club', 'Club') }}
        {{ Form::select('club', $clubs, $user->club_id, ['class' => 'form-control']) }}
        <br/>
        {{ QForm::label('club_role', 'Club Role') }}
        {{ Form::select('club_role', array('member' => 'Member', 'founder' => 'Founder'), $user->club_role, ['class' => 'form-control']) }}

        {{ QForm::label('balance', 'Balance') }}
        {{ QForm::text('balance') }}

        {{ QForm::label('exp', 'Experience') }}
        {{ QForm::text('exp') }}


    </div>

    {{ QForm::close() }}

{{ Fickle::closePanel() }}

@endsection