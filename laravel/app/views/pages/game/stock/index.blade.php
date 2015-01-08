@extends('layouts.game')

@section('content')
    {{-- --}}
    <div class="col-md-12">
            {{--
            {{ Fickle::openTable() }}
                <thead>
                    <th>Name</th>
                    <th>Symbol</th>

                    <th>Newest value</th>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td><a href="{{ URL::route('stocks.show', $stock->id)  }}">{{ $stock->name }}</a></td>

                            <td>{{ $stock->symbol }}</td>

                            <td>
                                {{ Fickle::stockValue($stock) }}
                             </td>


                        </tr>
                    @endforeach
                </tbody>


            {{ Fickle::closeTable() }}
            --}}
            <div class="stocks-list clear">
                 @foreach($stocks as $stock)
                    <a href="{{ URL::route('stocks.show', $stock->id)  }}">
                        <div class="stock-panel col-lg-3 col-md-6 col-xs-12 stock-mode-{{ $stock->changeRateMode() }}">
                            <div class="stock-panel-inner clearfix">
                                <table>
                                    <tr>
                                        <td class="name-container">
                                            <div class="name">
                                                <h3>{{ $stock->symbol }}</h3>
                                                <small>{{ $stock->name }}</small>
                                            </div>
                                        </td>
                                        <td class="value-container">
                                            <div class="value">
                                                <b>{{ Format::value($stock->newestValue()) }}</b>
                                                <span>{{ $stock->changeRateIcon() }} {{ $stock->changeRatePercent(true) }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>


                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
    </div>

@endsection