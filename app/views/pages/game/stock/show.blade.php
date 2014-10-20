@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel('Apple') }}

        <div style="width:1300px;height:400px;"><img src="http://chartserver.net/Apple-Aktienchart-a89bf0fb49d699e22e978416cb087f79.png" width="1300" height="400"></div>

    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Trade', 12) }}
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                   Money
                 </th>
                  <th>
                     Strategy
                  </th>
                 <th>
                    Number of stocks
                 </th>
                 <th>
                    Price
                 </th>
                  <th>
                     Fees
                  </th>
                <th>
                   Actions
                </th>
            </tr>
            <tr>
                <td>
                    AAPL stock
                </td>
                <td>
                    96,02$
                </td>
                <td>
                     <input class="switchCheckBox" type="checkbox" checked data-size="large"
                       data-label-text="<span class='fa fa-line-chart'></span>"
                       data-on-text="<span class='fa fa-thumbs-o-down'></span>"/>
                </td>
                <td>
                    <input type="number" class="form-control" />
                </td>
                <td>
                    <input type="number" readonly="readonly" class="form-control" />
                </td>

                <td>
                    <input type="number" readonly="readonly" class="form-control" />
                </td>
                <td class="text-center">
                    <button class="btn btn-xs btn-success"><i class="fa fa-shopping-cart"></i></button>
                    <button class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></button>
                </td>

            </tr>
            </table>
        </table>
    {{ Fickle::closePanel() }}




@endsection