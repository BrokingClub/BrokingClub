@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Your Club <button class="btn ls-light-blue-btn btn-round"><i class="fa fa-plus"></i></button>', 12) }}
        @if($theplayer->club)
            <a href="{{ URL::route('clubs.show', $theplayer->club->id)  }}">{{ $theplayer->club->slug }}</a>
        @else
            You´re not a member of a club
        @endif

    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Clubs', 12) }}
                <div class="table-responsive ls-table">
                    <table class="table">
                        <thead>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Members</th>
                            <th>Become a Member</th>
                        </thead>
                        <tbody>

                            @foreach($clubs as $i => $club)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $club->slug }}</td>
                                    <td></td>
                                    <td>{{ QForm::btnPrimary('Join', 'users') }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{ Fickle::closePanel() }}

@endsection