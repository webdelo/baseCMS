<?php namespace App\Services;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Tests\Controller;

class ServicesServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 */
	public function register()
	{
        
	}

	public function boot(Router $router)
	{
		$router->group(['namespace'=>'App\Services\Http\Controllers'], function()
		{
			include 'Http' . DIRECTORY_SEPARATOR . 'services_routes.php';
		});
	}
}
