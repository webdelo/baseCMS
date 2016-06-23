<?php

Route::get('employees', [
	'as' => 'employees.all',
	'uses' => 'EmployeesController@showAll'
]);

Route::get('employees/{slug}', [
	'as' => 'employees.show',
	'uses' => 'EmployeesController@show'
]);

Route::group(['middleware' => 'adminAccess'], function () {

	Route::resource('admin/employees/categories', 'CategoriesAdminController');

	Route::put('admin/employees/uploadImage', [
		'as' => 'employees.uploadImage',
		'uses' => 'EmployeesAdminController@uploadImage'
	]);

	Route::resource('admin/employees', 'EmployeesAdminController');
});
