@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel($stock->name, 12) }}
        <div style="height: 550px">
            <!-- TradingView Widget BEGIN -->
            <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
            <script type="text/javascript">
            new TradingView.widget({
              "autosize": true,
              "symbol": "NASDAQ:{{ $stock->symbol }}",
              "interval": "D",
              "timezone": "exchange",
              "theme": "White",
              "style": "8",
              "toolbar_bg": "#f1f3f6",
              "allow_symbol_change": true,
              "hideideas": true,
              "show_popup_button": true,
              "popup_width": "1000",
              "popup_height": "650"
            });
            </script>
            <!-- TradingView Widget END -->

        </div>

    {{ Fickle::closePanel() }}
     asdasd2

    {{ Fickle::openPanel('News about '.$stock->name, 12) }}
        <div style="text-align: center">
        <iframe src="http://www.google.com/uds/modules/elements/newsshow/iframe.html?q=Apple&rsz=9&hl=en"
                frameborder="0" width="728" height="90" marginwidth="0" marginheight="0"></iframe>
        <iframe src="http://www.google.com/uds/modules/elements/newsshow/iframe.html?q=Apple&rsz=9&hl=en"
                        frameborder="0" width="728" height="90" marginwidth="0" marginheight="0"></iframe>
        <iframe src="http://www.google.com/uds/modules/elements/newsshow/iframe.html?q=Apple&rsz=9&hl=en"
                      frameborder="0" width="728" height="90" marginwidth="0" marginheight="0"></iframe>
        <iframe src="http://www.google.com/uds/modules/elements/newsshow/iframe.html?q=Apple&rsz=9&hl=en"
                            frameborder="0" width="728" height="90" marginwidth="0" marginheight="0"></iframe>
        </div>
    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('Trade', 12) }}
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                   Value
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
                    {{ $stock->symbol }} stock
                </td>
                <td>
                    {{ $stock->newestValue()->value }}
                </td>
                <td>
                     <input class="switchCheckBox" type="checkbox" checked data-size="large"
                       data-label-text="<span class='fa fa-line-chart'></span>"
                       data-on-text="<span class='fa fa-thumbs-o-up'></span>"
                       data-off-text="<span class='fa fa-thumbs-o-down'></span>"
                       />
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
                    <button class="btn btn-lg btn-success"><i class="fa fa-shopping-cart"></i></button>
                    <button class="btn btn-lg btn-info"><i class="fa fa-eye"></i></button>
                </td>

            </tr>
            </table>
        </table>
    {{ Fickle::closePanel() }}




@endsection