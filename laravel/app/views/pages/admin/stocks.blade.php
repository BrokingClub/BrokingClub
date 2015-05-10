@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Manage stocks', 12) }}
        {{ Fickle::openTable() }}
            <thead>
                <th>Symbol</th>
                <th>Name</th>
                <th>Category</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->symbol }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->category->name }}</td>
                        <td>
                            <a class="text-danger" href="{{ URL::action('AdminStockController@destroy') }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        {{ Fickle::closeTable() }}
    {{ Fickle::closePanel() }}

@endsection