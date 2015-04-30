<?php
/**
 * Project: BrokingClub | CacheServiceProvider.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 21:49
 */

namespace BrokingClub\Cache;


use Zizaco\Confide\ServiceProvider;

class CacheServiceProvider extends ServiceProvider {
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //Bind Cache Manager as a singleton to the Laravel IoC container
        $this->app->singleton('CacheManager', function()
        {
            return new CacheManager();
        });
    }
} 