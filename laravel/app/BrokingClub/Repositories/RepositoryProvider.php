<?php
namespace BrokingClub\Repositories;
use Illuminate\Support\ServiceProvider;

/**
 * Project: BrokingClub | RepositoryProvider.php
 * Author: Simon - www.triggerdesign.de
 * Date: 29.04.2015
 * Time: 13:47
 */

class RepositoryProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PurchaseRepository', function()
        {
            return new PurchaseRepository();
        });

        $this->app->singleton('StockRepository', function()
        {
            return new StockRepository();
        });

        $this->app->singleton('PlayerRepository', function()
        {
            return new PlayerRepository();
        });


    }
}