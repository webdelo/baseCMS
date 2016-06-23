<?php

// ===== Gallery
Route::get('gallery', [
	'as' => 'gallery.all',
	'uses' => 'GalleryController@showAll'
]);

Route::get('gallery/galleryJson', [
	'as' => 'gallery.json',
	'uses' => 'GalleryController@showJson'
]);

Route::group(['middleware' => 'adminAccess'], function ()
{
	Route::put('admin/gallery/uploadImage', [
		'as' => 'gallery.uploadImage',
		'uses' => 'GalleryAdminController@uploadImage'
	]);

	Route::put('admin/gallery/setImagesPriority', [
		'as' => 'gallery.setImagesPriority',
		'uses' => 'GalleryAdminController@setImagesPriority'
	]);
	Route::delete('admin/gallery/deleteImage/{slug}', [
		'as' => 'gallery.deleteImage',
		'uses' => 'GalleryAdminController@deleteImage'
	]);

	Route::resource('admin/gallery', 'GalleryAdminController');

});

Route::get('gallery/{slug}', [
	'as' => 'gallery.show',
	'uses' => 'GalleryController@show'
]);
