@extends('layouts.game')

@section('buttons')
    @if($theplayer->ownsClub($club))
    <a class="btn btn-info" href="{{ URL::route('clubs.edit', $club->id) }}">
        <i class="fa fa-edit"></i> Edit this club</a>
    @endif
@endsection

@section('content')

    {{ Fickle::openWidget(4, 'setting', 'Club info', 'users') }}
        <ul>
            <li><div class="userHead">
                    <img class="clubAvatar" src="/img/testavatar.png"/>
                    <div class="actions">
                          {{ Fickle::iconBtn('envelope', 'default') }}
                          {{ Fickle::iconBtn('plus-square', 'primary') }}
                          {{ Fickle::iconBtn('mortar-board', 'warning') }}
                          {{ Fickle::iconBtn('exclamation-triangle', 'success') }}
                    </div>
                </div>
            </li>
            <li>Clubname: <div class="setting-switch">{{ $club->name }}</div></li>
            <li>Owner: <div class="setting-switch"><a href="{{ URL::route('players.show', $club->owner->id)  }}">{{ $club->owner->user->username }}</a></div></li>
            <li>Description: <div class="setting-switch">{{ $club->description }}</div></li>
            <li>Members: <div class="setting-switch">{{ $club->countMembers() }}</div></li>
            <li>Playsers Average: <div class="setting-switch">Ø {{ Format::money($club->avgWorth()) }}</div></li>
            <li>Worth: <div class="setting-switch">{{ Format::money($club->worth()) }}</div></li>
            @if($theplayer->canJoin($club->id))
                <li class="clearfix">Join: <div class="setting-switch">
                    <a class="btn btn-success" href="{{ URL::action('PlayersController@joinClub', $club->id) }}"><i class="fa fa-mortar-board"></i> Join this club</a></div></li>
            @elseif($theplayer->club_id == $club->id)
                <li class="clearfix">Leave: <div class="setting-switch">
                    <a class="btn btn-danger btn-confirm" href="{{ URL::action('PlayersController@leaveClub') }}"><i class="fa fa-close"></i> Leave this club</a>
            @endif
        </ul>
    {{ Fickle::closeWidget() }}

    {{ Fickle::openPanel('Players', 8, ['controls' => 'minus,refresh,closepanel', 'padding' => false])}}
        {{ Fickle::openTable() }}
            <thead>
                <th>Rank</th>
                <th>Username</th>
                <th>Worth</th>
            </thead>
            <tbody>
                @foreach($club->members as $i => $member)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $member->link(['showRole' => true]) }}</td>
                        <td>{{ Format::money($member->totalWorth()) }}</td>
                    </tr>
                @endforeach
            </tbody>
        {{ Fickle::closeTable() }}
    {{ Fickle::closePanel() }}

@endsection