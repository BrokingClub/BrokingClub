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
                    <img class="clubAvatar" src="http://stuffpoint.com/spongebob-square-pants/image/164725-spongebob-square-pants-spongebobs-family.jpg"/>
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
            <li>Teaser: <div class="setting-switch">{{ $club->teaser }}</div></li>
            <li>Description: <div class="setting-switch">{{ $club->description }}</div></li>
            <li>Members: <div class="setting-switch">{{ $club->countMembers() }}</div></li>
            <li>Balance: <div class="setting-switch">{{ $club->worth() }}$ <small>(Ø {{ $club->avgWorth() }}$ pp.)</small></div></li>
        </ul>
    {{ Fickle::closeWidget() }}

    {{ Fickle::openPanel('Performance', 8, ['controls' => 'minus,refresh,closepanel', 'padding' => false])}}
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
                        <td>{{ $member->user->username }}</td>
                        <td>{{ $member->totalWorth() }}$</td>
                    </tr>
                @endforeach
            </tbody>
        {{ Fickle::closeTable() }}
    {{ Fickle::closePanel() }}

@endsection