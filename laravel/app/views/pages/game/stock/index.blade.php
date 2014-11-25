@extends('layouts.game')

@section('content')
    {{-- --}}
    {{ Fickle::openPanel('Stocks', 12) }}
        <div class="table-responsive ls-table">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Category</th>
                    <th>Values</th>
                    <th>Newest value</th>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $stock->name }}</td>
                            <td>{{ $stock->symbol }}</td>
                            <td>{{ $stock->category }}</td>
                            <td>{{ $stock->values->count() }}</td>
                            <td>

                                @if($stock->changeRate() > 1)
                                    <div style="color: green">
                                @elseif($stock->changeRate() < 1)
                                    <div style="color: red">

                                @endif

                                {{ $stock->newestValue()->value }} ({{ $stock->changeRate() }})</div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    {{ Fickle::closePanel() }}

@endsection