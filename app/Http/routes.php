<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('admin', 'HomeController@index');

Route::get('contacts', [
    'as'   => 'contacts',
    'uses' => 'ContactsController@contacts'
]);

Route::get('about', [
    'as'   => 'about',
    'uses' => 'ArticlesController@about'
]);

Route::post('contacts/ajaxSendMessage', [
    'as'   => 'ajaxSendMessage',
    'uses' => 'ContactsController@ajaxSendMessage'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
