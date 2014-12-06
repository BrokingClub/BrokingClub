jQuery(document).ready(function($) {
    'use strict';

    bootstrap_switch_call();
    ladda_call();

    price_calculate_call();
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

}