@extends('layouts.game')

@section('content')

    {{ Fickle::openTabbedPanel(12,array('profile' => 'Personal Info', 'password' => 'Change Password',
        'club' => 'My Broking Club', 'delete' => 'Close Account')) }}
        {{ Fickle::openTabContent('profile') }}
            {{ QForm::model($player, array('route' => array('players.update', $player->id), 'method' => 'PUT')) }}

                {{ QForm::label('firstname', 'First name:') }}
                {{ QForm::text('firstname') }}

                {{ QForm::label('lastname', 'Last name:') }}
                {{ QForm::text('lastname') }}

                {{ QForm::label('career', 'Career:') }}
                {{ QForm::readonly('career', $player->careerName()) }}

                {{ QForm::readonly('email', $user->email) }}

                {{ QForm::readonly('username', $user->username) }}

                {{ QForm::btnPrimary('Submit', 'check') }}
            {{ QForm::close() }}
        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('password') }}
            {{ QForm::open(['route' => 'user.changepassword']) }}
                {{ QForm::label('old_password', 'Current Password:') }}
                {{ QForm::password('old_password', '') }}

                {{ QForm::label('new_password', 'New Password:') }}
                {{ QForm::password('new_password', '') }}

                 {{ QForm::label('new_password_confirmation', 'Re-type New Password:') }}
                 {{ QForm::password('new_password_confirmation', '') }}
                {{ QForm::btnWarning('Change password', 'lock') }}
            {{ QForm::close() }}
        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('club') }}
           {{ QForm::label('your_club', 'Your club:') }}
            @if($theplayer->club)
                {{ QForm::readOnly('your_club', $theplayer->club->name) }}
                <a class="btn btn-danger" href="{{ URL::action('PlayersController@leaveClub') }}">Leave this club</a>
            @else
                {{ QForm::readOnly('no_club', 'You are not a member of any club') }}

                <br/>
                <div class="text-right">
                <div class="btn-group" role="group">

                    <a href="{{ URL::route('clubs.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Create a new Club</a>
                     <a href="{{ URL::route('clubs.index') }}" class="btn btn-success"><i class="fa fa-mortar-board"></i> Find a club</a>
                </div>
                </div>

            @endif
        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('delete') }}
            <a href="{{ URL::action('UsersController@delete', ['id' => $user->id]) }}" class="btn btn-danger">
                <i class="fa fa-thumbs-down"></i> Delete account
            </a>

        {{ Fickle::closeTabContent() }}

    {{ Fickle::closeTabbedPanel() }}





@endsection