@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel("Edit " . $user->username, 12) }}

    {{ QForm::model($player, array('route' => array('admin.user.update', $player->id), 'method' => 'PUT')) }}

                    {{ QForm::label('firstname', 'First name:') }}
                    {{ QForm::text('firstname') }}

                    {{ QForm::label('lastname', 'Last name:') }}
                    {{ QForm::text('lastname') }}

                    {{ QForm::text('email', $user->email) }}

                    {{ QForm::text('username', $user->username) }}

                    {{ QForm::btnPrimary('Submit', 'check') }}
                {{ QForm::close() }}

{{ Fickle::closePanel() }}

@endsection