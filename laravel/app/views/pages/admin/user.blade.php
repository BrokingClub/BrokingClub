@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel($user->username, 12) }}


Edit the fucking guy.

{{ Fickle::closePanel() }}

@endsection