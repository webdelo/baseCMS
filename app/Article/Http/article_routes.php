<?php

Route::group(['middleware' => 'adminAccess'], function ()
{
	Route::resource('admin/articles/categories', 'CategoriesAdminController');
	Route::resource('admin/articles', 'ArticleAdminController');
});


Route::get('articles/{slug}', [
	'as' => 'articles.show',
	'uses' => 'ArticleController@show'
]);
