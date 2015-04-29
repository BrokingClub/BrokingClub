<?php
namespace BrokingClub\Service;

use Illuminate\Support\ServiceProvider as IlluminateProvider;

/**
 * Project: BrokingClub | Services.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:12
 */

class ServiceProvider extends IlluminateProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CalculationService', function()
        {
            return new CalculationService();
        });
    }

    public function bill($stock_id){

    }
}