@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel($user->username, 12) }}

    {{ Fickle::openTabbedPanel(12,array('user' => 'User Information', 'Player' => 'Player Information')) }}
        {{ Fickle::openTabContent('user') }}
            {{ QForm::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
                {{ QForm::text('email') }}

                {{ QForm::text('username') }}

                {{ QForm::btnPrimary('Submit', 'check') }}
            {{ QForm::close() }}
        {{ Fickle::closeTabContent() }}

        {{ Fickle::openTabContent('player') }}
            Player
        {{ Fickle::closeTabContent() }}

{{ Fickle::closePanel() }}

@endsection