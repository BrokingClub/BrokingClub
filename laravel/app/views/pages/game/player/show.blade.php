@extends('.........layouts.game')

@section('content')

        {{ Fickle::openWidget(4, 'setting', $player->user->username, 'user') }}
                <ul>
                    <li><div class="userHead" style="text-align: center;">
                                    <img class="img-circle" src="http://fc05.deviantart.net/fs71/f/2011/019/1/9/spongebob_avatar_by_me969-d37kddc.jpg"/>
                                    <div class="userActions" style="margin: 10px;">
                                        {{ Fickle::iconBtn('envelope', 'default') }}
                                        {{ Fickle::iconBtn('plus-square', 'primary') }}
                                        {{ Fickle::iconBtn('mortar-board', 'warning') }}
                                        {{ Fickle::iconBtn('exclamation-triangle', 'success') }}
                                    </div>
                                </div></li>
                    <li>Username: <div class="setting-switch">{{ $player->user->username }}</div></li>
                    <li>E-Mail: <div class="setting-switch">{{ $player->user->email }}</div></li>
                    <li>Balance: <div class="setting-switch">{{ $player->balance }}$</div></li>
                    <li>Club: <div class="setting-switch">{{ $player->club_id }}</div></li>
                    <li>Club role: <div class="setting-switch">{{ $player->club_role }}</div></li>
                </ul>
            {{ Fickle::closeWidget() }}

    {{ Fickle::openPanel('Users stocks', 8) }}

    <table class="table">
        <thead>
            <th>Stock</th>
            <th>Amount</th>
            <th>Paid</th>
            <th>Total paid</th>
            <th>Mode</th>
            <th>Value</th>
            <th>Total</th>
            <th>Earning</th>
            <th>Actions</th>
        </thead>
        <tbody>

        @foreach($player->purchases as $purchase)
            <tr>
                <td>{{ $purchase->stock->name }}</td>
                <td>{{ $purchase->amount }}</td>
                <td>{{ $purchase->paid }} US$</td>
                <td>{{ $purchase->total() }}</td>
                <td>{{ $purchase->mode }}</td>
                <td>{{ $purchase->stock->newestValue()->value }}</td>
                <td>{{ $purchase->price() }}</td>
                <td>{{ Fickle::earnings($purchase->total(), $purchase->price()) }}</td>
                <td>{{ QForm::btnPrimary('Sell', 'usd') }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ Fickle::closePanel() }}

@endsection