<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return 'welcome';
});

Route::post('/admin/login', 'Admin\LoginController@postLogin');
Route::get('/admin/login', 'Admin\LoginController@getLogin');
Route::get('/admin/logout', 'HomeController@getLogout');
//Route::get('/admin/logout', 'Auth\AuthController@getLogout')

Route::get('/admin/register', 'Admin\RegisterController@getRegister');
Route::post('/admin/register', 'Admin\RegisterController@postRegister');

Route::get('/twitter', 'Admin\HomeController@index');
Route::post('/twitter/post', 'Admin\HomeController@twitt');
Route::post('/twitter/post/load', 'Admin\HomeController@load');


