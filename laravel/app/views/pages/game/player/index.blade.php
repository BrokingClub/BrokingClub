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

                        @foreach($entries as $i => $entry)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>


                                <a href="{{ URL::route('players.show', $entry->player->id)  }}">{{ $entry->player->name() }}</a></td>
                                <td>{{ Format::money($entry->player->balance) }} $</td>
                                <td>
                                     <span class="mini-performance">{{ implode(',', $entry->steppedPerformance) }}</span>
                                     <b>{{ Format::money($entry->performance) }}</b>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            {{ Fickle::closeTable() }}
        {{ Fickle::closePanel() }}

@endsection