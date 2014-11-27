@extends('.........layouts.game')

@section('content')

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