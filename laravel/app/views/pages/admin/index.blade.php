@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Administration area', 12) }}
        @if(Player::auth() && Player::auth()->user->role == 'admin')
            Administrate your shit
        @else
            <h2>Authentification failed</h2>
        @endif
    {{ Fickle::closePanel() }}

@endsection