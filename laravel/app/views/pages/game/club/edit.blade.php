@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel("Edit club", 6) }}
        {{ QForm::model($club, array('route' => array('clubs.update', $club->id), 'method' => 'PUT')) }}

                {{ QForm::readonly('owner', $club->owner->name(false)) }}
                {{ QForm::readonly('name', $club->name) }}
                {{ QForm::readonly('slug', $club->slug) }}

                {{ QForm::label('teaser', 'Teaser:') }}
                {{ QForm::text('teaser') }}

                {{ QForm::label('description', 'Description:') }}
                {{ QForm::textarea('description') }}

                {{ QForm::btnPrimary('Update', 'check') }}
            {{ QForm::close() }}
    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Members', 6) }}
        {{ Fickle::openTable() }}
            <tr>
                <th>User</th>
                <th>Role</th>
                <th></th>
            </tr>
            @foreach($club->members as $member)
                <tr>
                    <th>{{ $member->link() }}</th>
                    <td>{{ $member->role() }}</td>
                    <td>
                        @if(!$member->ownsClub($club))
                        <a class="btn btn-warning" href="{{ URL::action('PlayersController@kickPlayer', $member->id) }}">
                            <i class="fa fa-plane"></i> Kick Player
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        {{ Fickle::closeTable() }}
    {{ Fickle::closePanel() }}





@endsection