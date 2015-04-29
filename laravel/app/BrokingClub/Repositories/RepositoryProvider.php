<?php
namespace BrokingClub\Repository;
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
        $this->app->bind('PurchaseRepository', function()
        {
            return new PurchaseRepository();
        });

        $this->app->bind('StockRepository', function()
        {
            return new StockRepository();
        });
    }
}