<?php namespace App\Gallery;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Tests\Controller;

class GalleryServiceProvider extends ServiceProvider {

	/**
	 * Register the Gallery provider.
	 */
	public function register()
	{
        
	}

	public function boot(Router $router)
	{
		$router->group(['namespace'=>'App\Gallery\Http\Controllers'], function()
		{
			include 'Http' . DIRECTORY_SEPARATOR . 'gallery_routes.php';
		});
	}
}
