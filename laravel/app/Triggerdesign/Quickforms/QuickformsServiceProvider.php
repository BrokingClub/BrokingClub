<?php namespace Triggerdesign\Quickforms;

use Illuminate\Support\ServiceProvider;

class QuickformsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('triggerdesign/quickforms', 'quickforms');

        $this->app->bindShared('quickforms::form', function($app)
        {
            $qform = new Form($app['html'], $app['url'], $app['session.store']->getToken());


            return $qform->setSessionStore($app['session.store']);
        });
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
