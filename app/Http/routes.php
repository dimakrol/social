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

Route::group(['middleware' => 'web'], function () {
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

    /**
     * Search
     */

    Route::get('/search',  'SearchController@getResults');

    /**
     * User profile
     */
    Route::get('/user/{username}', 'ProfileController@getProfile');

    Route::get('/profile/edit',  [
        'uses' => 'ProfileController@getEdit',
        'middleware' => 'auth'
    ]);

    Route::post('/profile/edit',  [
        'uses' => 'ProfileController@postEdit',
        'middleware' => 'auth'
    ]);

    /**
     * Friends
     */

    Route::get('/friends', [
        'uses' => 'FriendController@getIndex',
        'middleware' => 'auth'
    ]);

});


