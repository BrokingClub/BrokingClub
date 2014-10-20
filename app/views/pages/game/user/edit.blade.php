@extends('layouts.game')

@section('content')
     {{ Fickle::openPanel('User', 4) }}

    {{ Fickle::closePanel() }}

    {{ Fickle::openTabbedPanel(8,array('profile' => 'Personal Info', 'password' => 'Change Password',
        'club' => 'My Broking Club', 'delete' => 'Close Account')) }}
        {{ Fickle::openTabContent('profile') }}
            {{ QForm::open() }}
                {{ QForm::label('first_name', 'First Name:') }}
                {{ QForm::text('first_name', 'Simon') }}

                {{ QForm::label('last_name', 'Last Name:') }}
                {{ QForm::text('last_name', 'Schneider') }}

                {{ QForm::label('email', 'Email-Adress:') }}
                {{ QForm::text('email', 'simon@broking.club') }}
                {{ QForm::submit('Submit') }}
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
                {{ QForm::submit('Change password') }}
            {{ QForm::close() }}
        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('club') }}
            {{ QForm::open() }}
                {{ QForm::label('old_password', 'Current Password:') }}
                {{ QForm::text('my_club', 'Money Club', ['readonly' => 'readonly']) }}
                {{ QForm::button('Get out of club', array('class' => 'btn btn-danger')) }}
            {{ QForm::close() }}

        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('delete') }}
            {{ QForm::button('Delete account :(', array('class' => 'btn btn-danger')) }}
        {{ Fickle::closeTabContent() }}

    {{ Fickle::closeTabbedPanel() }}





@endsection