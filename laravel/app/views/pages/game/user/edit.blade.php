@extends('layouts.game')

@section('content')

    {{ Fickle::openTabbedPanel(12,array('profile' => 'Personal Info', 'password' => 'Change Password',
        'club' => 'My Broking Club', 'delete' => 'Close Account')) }}
        {{ Fickle::openTabContent('profile') }}
            {{ QForm::open() }}

                {{ QForm::text('username', 'SimonSchneider') }}

                {{ QForm::label('first_name', 'First name:') }}
                {{ QForm::text('first_name', 'Simon') }}

                {{ QForm::label('last_name', 'Last name:') }}
                {{ QForm::text('last_name', 'Schneider') }}

                {{ QForm::label('career', 'Career:') }}
                {{ QForm::readonly('career', 'Newly rich Snob') }}

                {{ QForm::label('email', 'Email-Adress:') }}
                {{ QForm::readonly('email', 'simon@broking.club') }}

                {{ QForm::btnPrimary('Submit', 'check') }}
            {{ QForm::close() }}
        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('password') }}
            {{ QForm::open() }}
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
                {{ QForm::label('old_password', 'Current Password:') }}
                {{ QForm::text('my_club', 'Money Club', ['readonly' => 'readonly']) }}
                {{ QForm::btnDanger( 'Get out of club', 'remove') }}
            {{ QForm::close() }}

        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('delete') }}
            {{ QForm::btnDanger('Delete account', 'thumbs-down') }}
        {{ Fickle::closeTabContent() }}

    {{ Fickle::closeTabbedPanel() }}





@endsection