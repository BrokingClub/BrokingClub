@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel() }}
        Edit user
    {{ Fickle::closePanel() }}

    {{ Fickle::openTabbedPanel(12,array('profile' => 'Personal Info', 'password' => 'Change Password', 'delete' => 'Close Account')) }}
        {{ Fickle::openTabContent('profile') }}

        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('password') }}

        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('delete') }}

        {{ Fickle::closeTabContent() }}

    {{ Fickle::closeTabbedPanel() }}





@endsection