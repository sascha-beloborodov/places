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



Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('places', 'PlaceController@getPlaces')->name('places');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth.login');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.login-post');;
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('auth.logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('auth.register');
Route::post('auth/register', 'Auth\AuthController@postRegister')->name('auth.register-post');

$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect', 'uses' => 'Auth\AuthController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle', 'uses' => 'Auth\AuthController@getSocialHandle']);