jQuery(document).ready(function($) {
    'use strict';

    bootstrap_switch_call();
    ladda_call();

    price_calculate_call();

    $('.btn-confirm').confirmation();
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    });

    $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'focus',
        placement: 'bottom'
    });

    $('input[name=leverage]').ionRangeSlider({
        type: "single",
        min: 100,
        max: 500,
        step: 50,
        grid: false,
        grid_snap: true,

        postfix: '%'
    });

    $('.gnews').gnews();


});

/*** bootstrapSwitch Call ***/
function bootstrap_switch_call(){
    'use strict';

    $(".switchCheckBox").bootstrapSwitch();
}

/*** ladda Call ***/
function ladda_call(){
    'use strict';
    Ladda.bind('button.ladda-button', { timeout: 2000 });
}

function price_calculate_call(){
    var $amountField =  $('input[name=amount]');


    $amountField.keydown(function(){
        return calculate_price($(this).parents('form'));
    });

    $amountField.keyup(function(){
        return calculate_price($(this).parents('form'));
    });
}

function calculate_price($form){
    var $amountField =  $form.find('input[name=amount]');
    var $priceField =  $form.find('input[name=purchase_price]');
    var $feesField =  $form.find('input[name=purchase_fees]');

    var amount =    parseFloat($amountField.val())
    var value =     parseFloat($form.find('input[name=value]').val());
    var feerate =   parseFloat($form.find('input[name=feerate]').val());

    var price = amount * value;
    var fee = price  * feerate;
    var totalPrice = price + fee;

    $priceField.val(totalPrice.toFixed(2) + " $");
    $feesField.val(fee.toFixed(2) + " $");



}