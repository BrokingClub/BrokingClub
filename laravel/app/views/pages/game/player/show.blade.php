@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('User information', 4) }}
            <img class="img-circle" style="margin-bottom: 10px;"
                        src="http://fc05.deviantart.net/fs71/f/2011/019/1/9/spongebob_avatar_by_me969-d37kddc.jpg"/>
        <table class="table">
            <tr>
                <td>Username:</td>
                <td>{{ $player->user->username }}</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{ $player->firstname }} {{ $player->lastname }}</td>
            <tr>
            <tr>
                <td>E-Mail:</td>
                <td>{{ $player->user->email }}</td>
            </tr>
        </table>
    {{Fickle::closePanel()}}

    {{ Fickle::openPanel('Users stocks', 8) }}

    <table class="table">
        <thead>
            <th>Stock</th>
            <th>Paid</th>
            <th>Amount</th>
            <th>Total</th>
        </thead>
        <tbody>

        @foreach($player->purchases as $purchase)
            <tr>
                <td>{{ $purchase->stock->name }}</td>
                <td>{{ $purchase->amount }}</td>
                <td>{{ $purchase->amount }}</td>
                <td>{{ $purchase->amount }}</td>
            </tr>


        @endforeach

        </tbody>
    </table>


    {{ Fickle::closePanel() }}

@endsection