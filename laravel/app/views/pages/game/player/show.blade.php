@extends('.........layouts.game')

@section('buttons')
@if($theplayer->editAllowed($player->user_id))
    <a class="btn btn-info" href="{{ URL::route('users.edit', $theplayer->user_id) }}">
        <i class="fa fa-edit"></i> Edit profile</a>
@endif
@endsection


@section('content')

        {{ Fickle::openWidget(4, 'setting', $player->name(), 'user') }}
                <ul>
                    <li><div class="userHead">
                                    <img class="img-circle" src="/img/testavatar.png"/>
                                    <div class="actions" style="margin: 10px;">
                                        {{ Fickle::iconBtn('envelope', 'default') }}
                                        {{ Fickle::iconBtn('plus-square', 'primary') }}
                                        {{ Fickle::iconBtn('mortar-board', 'warning') }}
                                        {{ Fickle::iconBtn('exclamation-triangle', 'success') }}
                                    </div>
                                </div></li>
                    <li>Name: <div class="setting-switch">{{ $player->name(false) }}</div></li>
                    <li>Balance: <div class="setting-switch">{{ Format::money($player->balance) }}</div></li>
                    <li>Purchases Worth: <div class="setting-switch">{{ Format::money($player->purchasesWorth()) }}</div></li>
                    <li>Worth: <div class="setting-switch"><b>{{ Format::money($player->totalWorth()) }}</b></div></li>
                    <li>Career: <div class="setting-switch">{{ $player->careerName() }}</div></li>
                    <li>Club:
                        <div class="setting-switch">
                            {{ $player->clubLink() }}
                        </div>

                    </li>
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

    {{ Fickle::openTable('purchase-table') }}
        <thead>
            <th>Stock</th>
            <th class="hidden-sm" >Amount</th>

            <th class="hidden-sm">Paid</th>
            {{-- <th >Total paid</th> --}}
            <th>Mode</th>
            <th>Profit</th>
            <th></th>
        </thead>
        <tbody>
        @foreach($player->purchases->all() as $purchase)
            <tr>
                <td>
                    <div class="clearfix">
                    <div class="pull-left stock-link-wrap">
                    <a  href="{{ URL::route('stocks.show', $purchase->stock->id) }}">

                    {{ $purchase->stock->name }}

                    </a>

                    <br/><small>{{ Fickle::stockValue($purchase->stock, ['big' => false])  }}</small>
                    </div>
                    <div class="pull-left">
                        <span class="mini-stockchart">{{ implode(',', array_reverse($purchase->stock->newestVariationsArray())) }}</span>
                    </div>
                    </div>

                </td>
                <td class="hidden-sm">{{ $purchase->amount }}</td>
                <td class="hidden-sm">
                    <a tabindex="0" data-toggle="popover" title="Purchase price" href="#" data-content="Old price: {{ Format::money($purchase->value)  }} <br/> Fee: {{ Format::money($purchase->fee)  }} <br/> Total paid: {{ Format::money($purchase->total()) }}">
                        {{ Format::money($purchase->paidPerStock()) }}
                    </a>
                </td>
                {{-- <td>
                <span title=""></span></td>
                --}}
                <td>{{ Fickle::purchaseMode($purchase->mode) }} {{ $purchase->leverage }}%</td>

                <td>
                    <span class="mode-{{ $purchase->earnedMode() }}">
                        {{ $purchase->earnedIcon() }}
                        {{ Fickle::earnings($purchase) }}
                    </span>


                </td>

                <td>
                 @if($player->editAllowed())
                {{ QForm::open(['route' => ['purchases.update', $purchase->id], 'method' => 'PUT']) }}
                    {{ QForm::hidden('action', 'sell') }}
                    {{ QForm::btnPrimary(' ', 'legal') }}
                {{ QForm::close() }}
                @endif
                </td>



            </tr>
        @endforeach

        </tbody>
    {{ Fickle::closeTable() }}

    @if($theplayer->id == $player->id)
    <hr/>
    <div class="clearfix">
        <a class="pull-right btn btn-success" href="{{ URL::route('stocks.index') }}">
            <i class="fa fa-list"></i> Buy more stocks</a>
    </div>
    @endif
    {{ Fickle::closePanel() }}

@endsection