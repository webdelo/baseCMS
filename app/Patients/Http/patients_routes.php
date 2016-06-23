<?php

Route::group(['middleware' => 'adminAccess'], function ()
{

	Route::resource('admin/patients/categories', 'CategoriesAdminController');
	Route::put('admin/patients/uploadImage', [
		'as' => 'patients.uploadImage',
		'uses' => 'PatientsAdminController@uploadImage'
	]);
	Route::resource('admin/patients', 'PatientsAdminController');

});