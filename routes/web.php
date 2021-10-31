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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/run-migrations', function () {
  return Artisan::call('migrate:fresh', ["--force"=> true ]);
});


//Auth::routes(['register' => false]);

Auth::routes();


Route::middleware('auth')->group(function (){
  Route::get('/url-create','UrlsController@create')->name('url_create');
  Route::post('/url-store','UrlsController@store')->name('url_store');
  Route::post('/url-delete','UrlsController@delete')->name('url_delete');
  Route::post('/url-deleteall','UrlsController@deleteAll')->name('url_deleteAll');
  Route::any('/url-search', 'UrlsController@search')->name('url_search');
});


Route::get('/home', 'HomeController@index')->name('home');
