@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Players', 12) }}
            {{ Fickle::openTable() }}
                    <thead>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Balance</th>
                        <th>Performance</th>
                    </thead>
                    <tbody>

                        @foreach($players as $i => $player)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><a href="{{ URL::route('players.show', $player->id)  }}">{{ $player->name() }}</a></td>
                                <td>{{ $player->balance }} $</td>
                                <td>

                                     <span class="mini-stockchart">100,85.125040597596,91.349139330952,87.690808704124,76.583306268269,72.718415069828,41.474504709321,12.439103605067,8.9314712569016,0.35725885027611,50.097434231893383,80</span>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            {{ Fickle::closeTable() }}
        {{ Fickle::closePanel() }}

@endsection