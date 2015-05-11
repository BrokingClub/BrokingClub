@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Create new stock', 6) }}
        <form action="{{ URL::action('AdminStockController@store') }}" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="symbol" class="control-label col-md-2">Symbol</label>
                <div class="col-md-10">
                    <input id="symbol" type="text" name="symbol" class="form-control" placeholder="Symbol">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Name</label>
                <div class="col-md-10">
                    <input id="name" type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="stock_category_id" class="control-label col-md-2">Category</label>
                <div class="col-md-10">
                    {{ Form::select('stock_category_id', $categories, null, ['class' => 'form-control', 'id' => 'stock_category_id']) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-12">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Categories', 6) }}
        {{ Form::open(array('action' => 'AdminCategoriesController@store', 'method' => 'POST', 'class' => 'form-horizontal')) }}
            <div class="form-group">
                <label for="categoryName" class="control-label col-md-2">Category</label>
                <div class="col-md-8" style="margin-bottom: 10px">
                    <input id="categoryName" type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        {{ Form::close() }}
        <hr/>
        {{ Fickle::openTable() }}
            <thead>
                <th>Category</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($categories as $id => $category)
                    <tr>
                        <td>{{ $category }}</td>
                        <td>
                            {{ Form::open(array('action' => array('AdminCategoriesController@destroy', $id), 'method' => 'DELETE', 'class' => 'pull-right')) }}
                                <button type="submit" class="btn btn-danger btn-xs btn-confirm">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        {{ Fickle::closeTable() }}
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
                            {{ Form::open(array('action' => array('AdminStockController@destroy', $stock->id), 'method' => 'DELETE', 'class' => 'pull-right')) }}
                                <button type="submit" class="btn btn-danger btn-xs btn-confirm">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        {{ Fickle::closeTable() }}
    {{ Fickle::closePanel() }}

@endsection