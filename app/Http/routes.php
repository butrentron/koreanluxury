<?php

Route::group(['prefix'=>'admin'], function () {

	Route::get('/login',  ['as' => 'admin.login', 'uses' => 'Admin\Auth\AuthController@getLogin']);
	Route::post('/login', ['as' => 'admin.post.login', 'uses' => 'Admin\Auth\AuthController@postLogin']);
		
	Route::group(['middleware' => 'admin'], function () {
		Route::get('/logout', [ 'as' => 'admin.logout', 'uses' => 'Admin\Auth\AuthController@logout' ]);
		Route::get('/', [ 'as' => 'admin.index', 'uses' => 'Admin\AdminController@index' ]);

		Route::get('/register',  ['as' => 'admin.register', 'uses' => 'Admin\Auth\AuthController@getRegister']);
		Route::post('/register', ['as' => 'admin.post.register', 'uses' => 'Admin\Auth\AuthController@postRegister']);

		Route::get('/orders', [ 'as' => 'admin.orders.index', 'uses' => 'Admin\OrderController@index' ]);
		Route::get('/orders/{id}', [ 'as' => 'admin.orders.show', 'uses' => 'Admin\OrderController@show' ]);
		Route::PUT('/orders', [ 'as' => 'admin.orders.update', 'uses' => 'Admin\OrderController@update' ]);

		Route::resource('/pages', 'Admin\PagesController');
		Route::post('/delete', [ 'as' => 'admin.pages.delete', 'uses' => 'Admin\PagesController@delete' ]);

		Route::resource('/categories', 'Admin\CategoriesController');
		Route::post('/cat-delete', [ 'as' => 'admin.categories.delete', 'uses' => 'Admin\CategoriesController@delete' ]);

		Route::resource('/brands', 'Admin\BrandsController');
		Route::post('/brad-delete', [ 'as' => 'admin.brands.delete', 'uses' => 'Admin\BrandsController@delete' ]);

		Route::resource('/types', 'Admin\TypesController');
		Route::post('/type-delete', [ 'as' => 'admin.types.delete', 'uses' => 'Admin\TypesController@delete' ]);

		Route::resource('/products', 'Admin\ProductsController');
		Route::post('/pro-delete', [ 'as' => 'admin.products.delete', 'uses' => 'Admin\ProductsController@delete' ]);

		Route::resource('/slides', 'Admin\SlidesController');

		Route::resource('/ship', 'Admin\ShipController');
		Route::post('/ship-delete', [ 'as' => 'admin.ship.delete', 'uses' => 'Admin\ShipController@delete' ]);

		Route::get('/settings', ['as' => 'admin.settings.show', 'uses' => 'Admin\SettingController@index']);
		Route::post('/settings', ['as' => 'admin.settings.create', 'uses' => 'Admin\SettingController@create']);
		Route::put('/settings/{id}', ['as' => 'admin.settings.update', 'uses' => 'Admin\SettingController@update']);

		Route::get('/members', [ 'as' => 'admin.list', 'uses' => 'Admin\AdminController@members' ]);
		Route::get('/members/{id}', [ 'as' => 'admin.edit', 'uses' => 'Admin\AdminController@edit' ]);
		Route::PUT('/members/{id}', [ 'as' => 'admin.update', 'uses' => 'Admin\AdminController@update' ]);

	});
});

Route::auth();

Route::get('sms', 'SiteController@sms');

Route::get('feed', 'FeedController@generate');

Route::get('sitemap', 'SitemapController@generate');


Route::get('/', ['uses' => 'SiteController@index']);

Route::get('/dat-hang', ['as' => 'site.info', 'uses' => 'SiteController@getOrder']);

Route::post('/dat-hang', ['as' => 'site.info.create', 'uses' => 'SiteController@postOrder']);

Route::get('/gio-hang', ['as' => 'site.cart.get', 'uses' => 'SiteController@cart']);

Route::get('/xoa-gio-hang', ['as' => 'site.delcart', 'uses' => 'SiteController@destroyCart']);

Route::post('/gio-hang', ['as' => 'site.cart', 'uses' => 'SiteController@cart']);

Route::get('/t{id}-{types}', [ 'as' => 'site.types', 'uses' => 'SiteController@types'])->where([ 'types' => '[a-z0-9-]+', 'id' => '[0-9]+' ]);

Route::get('/b{id}-{brands}', [ 'as' => 'site.brands', 'uses' => 'SiteController@brands'])->where([ 'brands' => '[a-z0-9-]+', 'id' => '[0-9]+' ]);

Route::get('/c{id}-{categories}', [ 'as' => 'site.categories', 'uses' => 'SiteController@categories'])->where([ 'categories' => '[a-z0-9-]+', 'id' => '[0-9]+' ]);

Route::get('/p{id}-{product}', [ 'as' => 'site.products', 'uses' =>'SiteController@products' ])->where(['product' => '[a-z0-9-]+', 'id' => '[0-9-]+']);

Route::get('/tim-kiem', [ 'as' => 'site.search', 'uses' => 'SiteController@search' ]);

Route::get('/{page}', [ 'as' => 'site.pages', 'uses' =>'SiteController@pages' ])->where(['page' => '[a-z0-9-]+']);
