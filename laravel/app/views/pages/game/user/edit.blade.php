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
                {{ QForm::readonly('career', $player->career) }}

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
            {{ QForm::open() }}
                {{ QForm::label('your_club', 'Your club:') }}
                @if($theplayer->club)
                    {{ QForm::readOnly('your_club', $theplayer->club->slug) }}
                    {{ QForm::btnDanger( 'Get out of club', 'remove') }}
                    <a href="{{ URL::action('PlayersController@leaveClub') }}">Leave club</a>
                @else
                    {{ QForm::readOnly('no_club', 'You are not a member of any club') }}
                @endif
            {{ QForm::close() }}

        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('delete') }}
            <a href="{{ URL::action('UsersController@delete', ['id' => $user->id]) }}" class="btn btn-danger">
                <i class="fa fa-thumbs-down"></i> Delete account
            </a>

        {{ Fickle::closeTabContent() }}

    {{ Fickle::closeTabbedPanel() }}





@endsection