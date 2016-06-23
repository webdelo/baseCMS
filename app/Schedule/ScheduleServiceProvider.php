<?php namespace App\Schedule;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Tests\Controller;

class ScheduleServiceProvider extends ServiceProvider {

	/**
	 * Register the patient provider.
	 */
	public function register()
	{
        
	}

	public function boot(Router $router)
	{
		$router->group(['namespace'=>'App\Schedule\Http\Controllers'], function()
		{
			include 'Http' . DIRECTORY_SEPARATOR . 'schedule_routes.php';
		});
	}
}
