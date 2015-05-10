@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Create new stock', 6) }}
        <form action="{{ URL::action('AdminStockController@create') }}" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="symbol" class="control-label col-xs-2">Symbol</label>
                <div class="col-xs-10">
                    <input id="symbol" type="text" name="symbol" class="form-control" placeholder="Symbol">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-xs-2">Name</label>
                <div class="col-xs-10">
                    <input id="name" type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-12">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Create new category', 6) }}

    {{ Fickle::closePanel() }}

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
                            <form action="{{ URL::action('AdminStockController@delete', $stock->id) }}" class="pull-right">
                                <button type="submit" class="btn btn-danger btn-xs btn-confirm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        {{ Fickle::closeTable() }}
    {{ Fickle::closePanel() }}

@endsection