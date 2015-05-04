@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Administration area', 12) }}
        {{Fickle::openTable()}}
            <tr>
            <td>UserId</td>
            <td>Username</td>
            <td>E-Mail</td>
            <td>Role</td>
            <td>Manage</td>
            </tr>
            @foreach($users AS $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == "admin")
                        <i class="fa fa-star-o"></i>
                    @else
                        <i class="fa fa-user"></i>
                    @endif
                </td>
                <td><a href="/admin/user/{{ $user->id }}"><i class="fa fa-pencil-square-o"></i></a></td>
            </tr>
            @endforeach
        {{Fickle::closeTable()}}
    {{ Fickle::closePanel() }}

@endsection