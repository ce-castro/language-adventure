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

Route::get('/admin/school', 'SchoolController@index')->name('schools.index');
Route::get('/admin/school/create', 'SchoolController@create')->name('schools.create');
Route::get('/admin/school/{slider}/edit', 'SchoolController@edit')->name('schools.edit');
Route::post('/admin/school', 'SchoolController@store')->name('schools.store');
Route::get('/admin/school/{slider}/delete', 'SchoolController@destroy')->name('schools.delete');

//Route::get('/schools/categories', 'CategoryController@index')->name('categories.index');
//Route::get('/schools/categories/create', 'CategoryController@create')->name('categories.create');
//Route::get('/schools/categories/{category}/edit/{tab}', 'CategoryController@edit')->name('categories.edit');
//Route::post('/schools/categories', 'CategoryController@store')->name('categories.store');
//Route::patch('/schools/categories/{id}', 'CategoryController@update')->name('categories.update');
//Route::get('/schools/categories/{category}/delete', 'CategoryController@destroy')->name('categories.delete');

//Route::get('/schools/sliders', 'SliderController@index')->name('sliders.index');
//Route::get('/schools/sliders/create', 'SliderController@create')->name('sliders.create');
//Route::get('/schools/sliders/{slider}/edit', 'SliderController@edit')->name('sliders.edit');
//Route::post('/schools/sliders', 'SliderController@store')->name('sliders.store');
//Route::patch('/schools/sliders/{id}', 'SliderController@update')->name('sliders.update');
//Route::get('/schools/sliders/{slider}/delete', 'SliderController@destroy')->name('sliders.delete');
//
//Route::get('/schools/pages', 'PageController@index')->name('pages.index');
//Route::get('/schools/pages/create', 'PageController@create')->name('pages.create');
//Route::get('/schools/pages/{page}/edit', 'PageController@edit')->name('pages.edit');
//Route::post('/schools/pages', 'PageController@store')->name('pages.store');
//Route::patch('/schools/pages/{id}', 'PageController@update')->name('pages.update');
//Route::get('/schools/pages/{page}/delete', 'PageController@destroy')->name('pages.delete');
//
//Route::post('/schools/photos', 'PhotoController@store')->name('photos.store');
//Route::get('/schools/photos/{photo}/edit', 'PhotoController@edit')->name('photos.edit');
//Route::patch('/schools/photos/{id}', 'PhotoController@update')->name('photos.update');
//Route::get('/schools/photos/{photo}/{tour_id}/delete', 'PhotoController@destroy')->name('photos.delete');
//Route::get('/schools/photos/{photo}/{category_id}/deletecat', 'PhotoController@destroycat')->name('photos.deletecat');
//
//Route::get('/schools/reviews', 'ReviewController@index')->name('reviews.index');
//Route::get('/schools/reviews/create', 'ReviewController@create')->name('reviews.create');
//Route::get('/schools/reviews/{review}/edit', 'ReviewController@edit')->name('reviews.edit');
//Route::post('/schools/reviews', 'ReviewController@store')->name('reviews.store');
//Route::patch('/schools/reviews/{id}', 'ReviewController@update')->name('reviews.update');
//Route::get('/schools/reviews/{review}/delete', 'ReviewController@destroy')->name('reviews.delete');
//
//Route::get('/schools/tours', 'TourController@index')->name('tours.index');
//Route::get('/schools/tours/create', 'TourController@create')->name('tours.create');
//Route::get('/schools/tours/{tour}/edit/{tab}', 'TourController@edit')->name('tours.edit');
//Route::post('/schools/tours', 'TourController@store')->name('tours.store');
//Route::patch('/schools/tours/{id}', 'TourController@update')->name('tours.update');
//Route::get('/schools/tours/{tour}/delete', 'TourController@destroy')->name('tours.delete');

Route::get('/admin/users', 'UserController@index')->name('users.index');
Route::get('/admin/users/create', 'UserController@create')->name('users.create');
Route::get('/admin/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::post('/admin/users', 'UserController@store')->name('users.store');
Route::patch('/admin/users/{id}', 'UserController@update')->name('users.update');
Route::get('/admin/users/{user}/delete', 'UserController@destroy')->name('users.delete');

//Route::post('/schools/schedules', 'TourScheduleController@store')->name('schedules.store');
//Route::get('/schools/schedules/{schedule}/edit', 'TourScheduleController@edit')->name('schedules.edit');
//Route::patch('/schools/schedules/{id}', 'TourScheduleController@update')->name('schedules.update');
//Route::get('/schools/schedules/{schedule}/{tour_id}/delete', 'TourScheduleController@destroy')->name('schedules.delete');
//
//Route::post('/schools/tourprices', 'TourPriceController@store')->name('tourprices.store');
//Route::get('/schools/tourprices/{tourprice}/edit', 'TourPriceController@edit')->name('tourprices.edit');
//Route::patch('/schools/tourprices/{id}', 'TourPriceController@update')->name('tourprices.update');
//Route::get('/schools/tourprices/{tourprice}/{tour_id}/delete', 'TourPriceController@destroy')->name('tourprices.delete');

Route::get('/login', 'SessionController@login')->name('login');
Route::post('/login', 'SessionController@loginStore')->name('login.store');
Route::get('/logout', 'SessionController@destroy')->name('logout');

//Route::get('/', 'MainController@index')->name('main');
//Route::get('/home.html', 'MainController@home')->name('home');
//Route::get('/destinations.html', 'MainController@destinations')->name('destinations');
//Route::get('/catchatour.html', 'MainController@catchatour')->name('catchatour');
//Route::get('/tour/{slug}', 'ViewTourController@show')->name('tour.show');

//Route::get('/{id}', 'MainController@page')->name('page');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
