@extends('.........layouts.game')

@section('content')

{{ Fickle::openPanel($user->username, 12) }}



{{ Fickle::closePanel() }}

@endsection