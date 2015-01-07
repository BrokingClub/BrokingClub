{{ QForm::hidden('stock_id', $stock->id) }}

<div class="row">
    <div class="col-md-6">
        {{ QForm::label('stock_name', 'Stock:') }}
        {{ QForm::readonly('stock_name', $stock->name) }}
    </div>
    <div class="col-md-6">
        {{ QForm::label('stock_value', 'Value:') }}
        {{ QForm::readonly('stock_value', $stock->newestValueObject()->value . " $") }}

    </div>
</div>

<div class="row">
<div class="col-md-4">
        <a tabindex="0" data-toggle="popover" title="Purchase price" href="#" data-content="Do you think the stock will rise or fall in the future? Bet on thumbs up and you will win if the quotation goes up, bet on thumbs down and you will get money if the stock price falls.">
        {{ QForm::label('betOnRise', 'Mode:') }}
        </a>
        <br/>
        <input class="switchCheckBox" name="betOnRise" type="checkbox" checked data-size="large"
            data-label-text="<span class='fa fa-line-chart'></span>"
            data-on-text="<span class='fa fa-thumbs-o-up'></span>"
            data-off-text="<span class='fa fa-thumbs-o-down'></span>"
        />
    </div>
<div class="col-md-8">
        <a tabindex="0" data-toggle="popover" title="Leverage / Risk" href="#" data-content="Example: Buy stocks for 100$ and if the price of the stock increases by 10%, than you will earn 20$ instead of 10$ if your risk is at 200%. High leverage comes with higher risk, but a chance to earn way more money.">
        {{ QForm::label('levarage', 'Risk:') }}
        </a>
        {{ QForm::text('leverage') }}
    </div>


</div>

<div class="row">
    <div class="col-md-4">
        {{ QForm::label('amount', 'Amount:') }}
        {{ QForm::text('amount') }}
    </div>
    <div class="col-md-4">
        <div style="display: none">
            {{ QForm::hidden('value', $stock->newestValue()) }}
            {{ QForm::hidden('feerate', Purchase::feeRate()) }}
        </div>
        {{ QForm::label('purchase_price', 'Total price:') }}
        {{ QForm::readonly('purchase_price', "0.00 $") }}
    </div>
    <div class="col-md-4">

        {{ QForm::label('purchase_fees', 'Fees:') }}
        {{ QForm::readonly('purchase_fees', "0.00 $") }}

    </div>
</div>











