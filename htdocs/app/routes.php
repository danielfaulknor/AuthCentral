<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::filter('auth', function($route, $request)
{
  if (!Auth::check()) return Redirect::to("login"); // /login url
});


Route::get('/', 'HomeController@showWelcome');

Route::when('*', 'csrf', array('post', 'put', 'delete'));

Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@handleLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));

Route::get('create', array('as' => 'login', 'uses' => 'UsersController@create'));
Route::post('create', array('as' => 'login', 'uses' => 'UsersController@store'));

Route::group(array('before' => 'auth'), function()
{
  Route::get('/panel', array('as' => 'panel', 'uses' => 'UsersController@panel'));
  Route::get('/settings', array('as' => 'settings', 'uses' => 'SettingsController@index'));
  Route::get('/settings/authy/register', array('as' => 'settings/authy', 'uses' => 'SettingsController@authyRegister'));
  Route::post('/settings/authy/register', array('as' => 'settings/authy', 'uses' => 'SettingsController@authyRegisterStore'));
});
