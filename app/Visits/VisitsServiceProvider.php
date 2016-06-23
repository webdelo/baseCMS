<?php namespace App\Visits;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Tests\Controller;

class VisitsServiceProvider extends ServiceProvider {

	/**
	 * Register the patient provider.
	 */
	public function register()
	{
        
	}

	public function boot(Router $router)
	{
		$router->group(['namespace'=>'App\Visits\Http\Controllers'], function()
		{
			include 'Http' . DIRECTORY_SEPARATOR . 'visits_routes.php';
		});
	}
}
