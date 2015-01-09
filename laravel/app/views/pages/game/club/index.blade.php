@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Your Club', 4) }}
        @if($theplayer->club)
            <p>You are Member of <b>"{{ $theplayer->club->name }}".</b></p>
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-danger btn-confirm btn-block" href="{{ URL::action('PlayersController@leaveClub') }}"><i class="fa fa-close"></i> Leave this club</a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-default btn-block" href="{{ URL::route('clubs.show', $theplayer->club->id)  }}"><i class="fa fa-eye"></i> Show club page</a>
                </div>
            </div>
        @else
            <p>You´re not a member of a club.</p>
            <a href="clubs/create" class="btn btn-info btn-block"><i class="fa fa-plus"></i> Create a new Club</a>
        @endif

    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Clubs', 8) }}
                <div class="table-responsive ls-table">
                    {{ Fickle::openTable() }}
                        <thead>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Members</th>
                            <th>Average Worth</th>
                            <th>Performance</th>
                        </thead>
                        <tbody>

                            @foreach($clubs as $i => $club)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td><a href="{{ URL::route('clubs.show', $club->id)  }}">{{ $club->name }}</a></td>
                                    <td>{{ $club->countMembers() }}</td>
                                    <td>Ø {{ Format::money($club->avgWorth()) }} pp.</td>
                                    <td>

                                         <span class="mini-stockchart">{{ Fickle::randomChartValues() }}</span>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    {{ Fickle::closeTable() }}
                </div>
            {{ Fickle::closePanel() }}

@endsection