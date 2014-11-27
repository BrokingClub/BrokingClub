@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('User information', 12) }}
        {{ $player->user->username }} <br/>
        {{ $player->user->email }} <br/>
        {{ $player->user->created_at }} <br/>
        {{ $player->balance }} US$<br/>
        {{ $player->firstname }} <br/>
        {{ $player->lastname }} <br/>

        <table class="table">
            <tr>
                <td>Username:</td>
                <td>{{ $player->user->username }}</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{ $player->firstname }} {{ $player->lastname }}</td>
            <tr>
            <tr>
                <td>E-Mail:</td>
                <td>{{ $player->user->email; }}</td>
            </tr>
        </table>


    {{Fickle::closePanel()}}

@endsection