@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Players', 12) }}
            <div class="table-responsive ls-table">
                <table class="table">
                    <thead>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>

                        @foreach($players as $i => $player)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><a href="{{ URL::route('players.show', $player->id)  }}">{{ $player->user->username }}</a></td>
                                <td>{{ $player->balance }} $</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{ Fickle::closePanel() }}

@endsection