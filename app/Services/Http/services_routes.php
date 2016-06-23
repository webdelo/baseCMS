<?php

// ===== Services
Route::get('services', [
	'as' => 'services.all',
	'uses' => 'ServicesController@showAll'
]);

Route::group(['middleware' => 'adminAccess'], function ()
{

	Route::resource('admin/services/categories', 'CategoriesAdminController');
	Route::resource('admin/services', 'ServicesAdminController');
//	Route::get('admin/services/categories', [
//		'as' => 'servicesCategories.all',
//		'uses' => 'ServicesCategoriesAdminController@showAll'
//	]);
});

Route::get('services/{slug}', [
	'as' => 'services.show',
	'uses' => 'ServicesController@show'
]);
