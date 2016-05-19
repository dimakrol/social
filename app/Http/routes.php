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
/**
 * Home
 */
Route::get('/', 'HomeController@index');
/**
 * Authentication
 */
Route::get('/signup',  [
                'uses' => 'AuthController@getSignup',
                'middleware' => 'guest'
]);

Route::post('/signup',  [
                'uses' => 'AuthController@postSignup',
                'middleware' => 'guest'
]);

Route::get('/signin',  [
                'uses' => 'AuthController@getSignin',
                'middleware' => 'guest'
]);

Route::post('/signin',  [
                'uses' => 'AuthController@postSignin',
                'middleware' => 'guest'
]);
Route::get('/signout',  'AuthController@getSignout');