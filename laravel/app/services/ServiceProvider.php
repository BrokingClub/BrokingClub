<?php
use Illuminate\Support\ServiceProvider;

/**
 * Project: BrokingClub | Services.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:12
 */

class Services extends ServiceProvider{

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
}