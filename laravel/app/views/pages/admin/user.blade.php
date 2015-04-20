@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel($user->username, 12) }}

            {{ QForm::model($player, array('route' => array('players.update', $player->id), 'method' => 'PUT')) }}

                {{ QForm::label('firstname', 'First name:') }}
                {{ QForm::text('firstname'), 'asd' }}

                {{ QForm::label('lastname', 'Last name:') }}
                {{ QForm::text('lastname') }}

                {{ QForm::label('career', 'Career:') }}
                {{ QForm::text('career', $player->careerName()) }}

                {{ QForm::text('email', $user->email) }}

                {{ QForm::text('username', $user->username) }}

                {{ QForm::btnPrimary('Submit', 'check') }}
            {{ QForm::close() }}

{{ Fickle::closePanel() }}

@endsection