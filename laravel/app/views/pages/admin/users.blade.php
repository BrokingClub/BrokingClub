@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Manage users', 12) }}
        {{Fickle::openTable()}}
            <tr>
            <td>UserId</td>
            <td>Username</td>
            <td>E-Mail</td>
            <td>Role</td>
            <td>Manage</td>
            <td>Profile</td>
            </tr>
            @foreach($users AS $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge">
                    @if($user->role == "admin")
                        <i class="fa fa-star-o"></i>
                    @else
                        <i class="fa fa-user"></i>
                    @endif
                </span></td>
                <td><a href="/admin/users/{{ $user->id }}/edit" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                </td>
                <td><a href='/players/{{ $user->id }}' target="_blank" class="btn btn-default"><i class="fa fa-external-link"></i></a></td>
            </tr>
            @endforeach

        {{Fickle::closeTable()}}

            <div class="text-center">
                {{ $users->links() }}
            </div>

    {{ Fickle::closePanel() }}

@endsection