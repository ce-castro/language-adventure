<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cart', 'CartController@view')->name('cart.view');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/categories', 'CategoryController@index')->name('categories.index');
Route::get('/admin/categories/create', 'CategoryController@create')->name('categories.create');
Route::get('/admin/categories/{category}/edit/{tab}', 'CategoryController@edit')->name('categories.edit');
Route::post('/admin/categories', 'CategoryController@store')->name('categories.store');
Route::patch('/admin/categories/{id}', 'CategoryController@update')->name('categories.update');
Route::get('/admin/categories/{category}/delete', 'CategoryController@destroy')->name('categories.delete');

Route::get('/admin/sliders', 'SliderController@index')->name('sliders.index');
Route::get('/admin/sliders/create', 'SliderController@create')->name('sliders.create');
Route::get('/admin/sliders/{slider}/edit', 'SliderController@edit')->name('sliders.edit');
Route::post('/admin/sliders', 'SliderController@store')->name('sliders.store');
Route::patch('/admin/sliders/{id}', 'SliderController@update')->name('sliders.update');
Route::get('/admin/sliders/{slider}/delete', 'SliderController@destroy')->name('sliders.delete');

Route::get('/admin/pages', 'PageController@index')->name('pages.index');
Route::get('/admin/pages/create', 'PageController@create')->name('pages.create');
Route::get('/admin/pages/{page}/edit', 'PageController@edit')->name('pages.edit');
Route::post('/admin/pages', 'PageController@store')->name('pages.store');
Route::patch('/admin/pages/{id}', 'PageController@update')->name('pages.update');
Route::get('/admin/pages/{page}/delete', 'PageController@destroy')->name('pages.delete');

Route::post('/admin/photos', 'PhotoController@store')->name('photos.store');
Route::get('/admin/photos/{photo}/edit', 'PhotoController@edit')->name('photos.edit');
Route::patch('/admin/photos/{id}', 'PhotoController@update')->name('photos.update');
Route::get('/admin/photos/{photo}/{tour_id}/delete', 'PhotoController@destroy')->name('photos.delete');
Route::get('/admin/photos/{photo}/{category_id}/deletecat', 'PhotoController@destroycat')->name('photos.deletecat');

Route::get('/admin/reviews', 'ReviewController@index')->name('reviews.index');
Route::get('/admin/reviews/create', 'ReviewController@create')->name('reviews.create');
Route::get('/admin/reviews/{review}/edit', 'ReviewController@edit')->name('reviews.edit');
Route::post('/admin/reviews', 'ReviewController@store')->name('reviews.store');
Route::patch('/admin/reviews/{id}', 'ReviewController@update')->name('reviews.update');
Route::get('/admin/reviews/{review}/delete', 'ReviewController@destroy')->name('reviews.delete');

Route::get('/admin/tours', 'TourController@index')->name('tours.index');
Route::get('/admin/tours/create', 'TourController@create')->name('tours.create');
Route::get('/admin/tours/{tour}/edit/{tab}', 'TourController@edit')->name('tours.edit');
Route::post('/admin/tours', 'TourController@store')->name('tours.store');
Route::patch('/admin/tours/{id}', 'TourController@update')->name('tours.update');
Route::get('/admin/tours/{tour}/delete', 'TourController@destroy')->name('tours.delete');

Route::get('/admin/users', 'UserController@index')->name('users.index');
Route::get('/admin/users/create', 'UserController@create')->name('users.create');
Route::get('/admin/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::post('/admin/users', 'UserController@store')->name('users.store');
Route::patch('/admin/users/{id}', 'UserController@update')->name('users.update');
Route::get('/admin/users/{user}/delete', 'UserController@destroy')->name('users.delete');

Route::post('/admin/schedules', 'TourScheduleController@store')->name('schedules.store');
Route::get('/admin/schedules/{schedule}/edit', 'TourScheduleController@edit')->name('schedules.edit');
Route::patch('/admin/schedules/{id}', 'TourScheduleController@update')->name('schedules.update');
Route::get('/admin/schedules/{schedule}/{tour_id}/delete', 'TourScheduleController@destroy')->name('schedules.delete');

Route::post('/admin/tourprices', 'TourPriceController@store')->name('tourprices.store');
Route::get('/admin/tourprices/{tourprice}/edit', 'TourPriceController@edit')->name('tourprices.edit');
Route::patch('/admin/tourprices/{id}', 'TourPriceController@update')->name('tourprices.update');
Route::get('/admin/tourprices/{tourprice}/{tour_id}/delete', 'TourPriceController@destroy')->name('tourprices.delete');

Route::get('/login', 'SessionController@login')->name('login');
Route::post('/login', 'SessionController@loginStore')->name('login.store');
Route::get('/logout', 'SessionController@destroy')->name('logout');

Route::get('/', 'MainController@index')->name('main');
Route::get('/home.html', 'MainController@home')->name('home');
Route::get('/destinations.html', 'MainController@destinations')->name('destinations');
Route::get('/catchatour.html', 'MainController@catchatour')->name('catchatour');
Route::get('/tour/{slug}', 'ViewTourController@show')->name('tour.show');

//Route::get('/{id}', 'MainController@page')->name('page');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
