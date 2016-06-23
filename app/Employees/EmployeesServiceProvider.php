<?php namespace App\Employees;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Tests\Controller;

class EmployeesServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 */
	public function register()
	{

	}

	public function boot(Router $router)
	{
		$router->group(['namespace'=>'App\Employees\Http\Controllers'], function()
		{
			include 'Http' . DIRECTORY_SEPARATOR . 'employees_routes.php';
		});
	}
}
