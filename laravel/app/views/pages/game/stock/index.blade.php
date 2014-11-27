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
                            <td><a href="{{ URL::route('stocks.show', $stock->id)  }}">{{ $stock->name }}</a></td>
                            <td>{{ $stock->symbol }}</td>
                            <td>{{ $stock->category }}</td>
                            <td></td>
                            <td>
                                {{ Fickle::stockValue($stock) }}
                             </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    {{ Fickle::closePanel() }}

@endsection