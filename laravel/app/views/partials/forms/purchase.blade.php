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
    <div class="col-md-6">
        {{ QForm::label('amount', 'Amount:') }}
        {{ QForm::text('amount') }}
    </div>
    <div class="col-md-6">
        {{ QForm::label('betOnRise', 'Mode:') }}<br/>
        <input class="switchCheckBox" name="betOnRise" type="checkbox" checked data-size="large"
            data-label-text="<span class='fa fa-line-chart'></span>"
            data-on-text="<span class='fa fa-thumbs-o-up'></span>"
            data-off-text="<span class='fa fa-thumbs-o-down'></span>"
        />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div style="display: none">
            {{ QForm::hidden('value', $stock->newestValue()) }}
            {{ QForm::hidden('feerate', Purchase::feeRate()) }}
        </div>
        {{ QForm::label('purchase_price', 'Total price:') }}
        {{ QForm::readonly('purchase_price', "0.00 $") }}
    </div>
    <div class="col-md-6">

        {{ QForm::label('purchase_fees', 'Fees:') }}
        {{ QForm::readonly('purchase_fees', "0.00 $") }}

    </div>
</div>











