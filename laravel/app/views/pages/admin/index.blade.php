@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Administration area', 12) }}
        {{Fickle::openTable()}}
            <tr>
            <td>UserId</td>
            <td>Username</td>
            <td>E-Mail</td>
            <td>Role</td>
            </tr>
            @foreach($users AS $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
            </tr>
            @endforeach
        {{Fickle::closeTable()}}
    {{ Fickle::closePanel() }}

@endsection