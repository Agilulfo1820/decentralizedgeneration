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

//Route::get('/', 'PagesController@index');
Route::get('/', 'HomeController@index');
//Route::get('/about', 'PagesController@about');
Route::get('/projects', 'ProjectsController@index');


Route::resource('post','PostController');
Route::resource('projects','ProjectsController');
//Route::resource('home','HomeController');

Route::get('/home_edit','HomeController@home_edit');
Route::put('/home_update','HomeController@update');
Route::get('/home_create', 'HomeController@create');
Route::put('/home_create_template', 'HomeController@store');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
