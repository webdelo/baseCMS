<?php

Route::group(['middleware' => 'adminAccess'], function ()
{

	Route::get('admin/schedule/json/doctors', 'ScheduleAdminJsonController@doctors');
	Route::get('admin/schedule/json/patients', 'ScheduleAdminJsonController@patients');
	Route::get('admin/schedule/json/date/{slug}', 'ScheduleAdminJsonController@date');
	Route::get('admin/schedule/json/today', 'ScheduleAdminJsonController@today');

	Route::resource('admin/schedule/categories', 'CategoriesAdminController');
	Route::put('admin/schedule/uploadImage', [
		'as' => 'schedule.uploadImage',
		'uses' => 'ScheduleAdminController@uploadImage'
	]);

//	Route::get('admin/schedule/date', 'ScheduleAdminController@date');
	Route::resource('admin/schedule', 'ScheduleAdminController');

});
