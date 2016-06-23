<?php namespace App\Patients;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Tests\Controller;

class PatientsServiceProvider extends ServiceProvider {

	/**
	 * Register the patient provider.
	 */
	public function register()
	{
        
	}

	public function boot(Router $router)
	{
		$router->group(['namespace'=>'App\Patients\Http\Controllers'], function()
		{
			include 'Http' . DIRECTORY_SEPARATOR . 'patients_routes.php';
		});
	}
}
