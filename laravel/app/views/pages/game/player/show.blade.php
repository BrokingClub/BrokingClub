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
                    <li>Balance: <div class="setting-switch">{{ Format::money($player->balance) }}</div></li>
                    <li>Purchases Worth: <div class="setting-switch">{{ Format::money($player->purchasesWorth()) }}</div></li>
                    <li>Worth: <div class="setting-switch"><b>{{ Format::money($player->totalWorth()) }}</b></div></li>
                    <li>Club: <div class="setting-switch">{{ $player->club_id }}</div></li>
                    <li>Club role: <div class="setting-switch">{{ $player->club_role }}</div></li>
                </ul>
            {{ Fickle::closeWidget() }}
    {{ Fickle::openPanel('Worth', 8, ['class' => 'fickle-panel hidden-sm']) }}
        <div class="player-worth-panel row">
           <div class="col-md-3">
                <h3>Balance</h3>
                <b>{{ Format::money($player->balance) }}</b>
           </div>
           <div class="col-md-1">
           +
           </div>
           <div class="col-md-3">
                   <h3>Purchases worth</h3>
                   <b>{{ Format::money($player->purchasesWorth()) }}</b>
           </div>
           <div class="col-md-1">
                     =
            </div>
            <div class="col-md-4 total-worth">
                        <h3>Player is worth</h3>
                        <b>{{ Format::money($player->totalWorth()) }}</b>
                   </div>
       </div>
    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Users stocks', 8) }}

    {{ Fickle::openTable() }}
        <thead>
            <th>Stock</th>
            <th class="hidden-sm" >Amount</th>
            <th class="hidden-sm">Paid</th>
            <th >Total paid</th>
            <th>Mode</th>
            <th>Offer</th>
            <th>Actions</th>
        </thead>
        <tbody>

        @foreach($player->purchases->all() as $purchase)
            <tr>
                <td>
                    <a href="{{ URL::route('stocks.show', $purchase->stock->id) }}">
                    {{ $purchase->stock->name }}
                    </a>
                    <br/><small>{{ Fickle::stockValue($purchase->stock, ['big' => false])  }}</small>

                </td>
                <td class="hidden-sm">{{ $purchase->amount }}</td>
                <td class="hidden-sm">{{ Format::money($purchase->paidPerStock()) }}</td>
                <td>
                {{ Format::money($purchase->totalPaid()) }}</td>
                <td>{{ Fickle::purchaseMode($purchase->mode) }}</td>

                <td>
                {{ Format::money($purchase->sellOffer()) }}
                {{ Fickle::earnings($purchase) }}

                </td>

                <td>
                 @if($player->editAllowed())
                {{ QForm::open(['route' => ['purchases.update', $purchase->id], 'method' => 'PUT']) }}
                    {{ QForm::hidden('action', 'sell') }}
                    {{ QForm::btnPrimary('Sell', 'usd') }}
                {{ QForm::close() }}
                @endif
                </td>



            </tr>
        @endforeach

        </tbody>
    {{ Fickle::closeTable() }}

    {{ Fickle::closePanel() }}

@endsection