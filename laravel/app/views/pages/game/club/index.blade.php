@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Your Club', 12) }}
        @if($theplayer->club)
            <a href="{{ URL::route('clubs.show', $theplayer->club->id)  }}">{{ $theplayer->club->name }}</a>
        @else
            You´re not a member of a club
            <hr/>
            <div class="text-right">
                <a href="clubs/create" class="btn btn-info"><i class="fa fa-plus"></i> Create a new Club</a>
            </div>
        @endif

    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Clubs', 12) }}
                <div class="table-responsive ls-table">
                    {{ Fickle::openTable() }}
                        <thead>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Members</th>
                            <td>Worth</td>
                            <th>Become a Member</th>
                        </thead>
                        <tbody>

                            @foreach($clubs as $i => $club)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td><a href="{{ URL::route('clubs.show', $club->id)  }}">{{ $club->name }}</a></td>
                                    <td>{{ $club->countMembers() }}</td>
                                    <td>{{ $club->worth() }}$ <small>(Ø {{ $club->avgWorth() }}$ pp.)</small></td>

                                    @if(!($club->id == $theplayer->club_id))
                                        <td><a class="btn btn-success" href="{{ URL::action('PlayersController@joinClub', $club->id) }}"><i class="fa fa-mortar-board"></i> Join</a></td>
                                    @else <td></td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    {{ Fickle::closeTable() }}
                </div>
            {{ Fickle::closePanel() }}

@endsection