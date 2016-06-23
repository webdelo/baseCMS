<?php

Route::group(['middleware' => 'adminAccess'], function ()
{

	Route::resource('admin/visits/categories', 'CategoriesAdminController');
	Route::put('admin/visits/uploadImage', [
		'as' => 'visits.uploadImage',
		'uses' => 'VisitsAdminController@uploadImage'
	]);
	Route::resource('admin/visits', 'VisitsAdminController');

});