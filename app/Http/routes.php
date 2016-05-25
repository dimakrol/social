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

    Route::get('/friends/add/{username}', [
        'uses' => 'FriendController@getAdd',
        'middleware' => 'auth'
    ]);

    Route::get('/friends/accept/{username}', [
        'uses' => 'FriendController@getAccept',
        'middleware' => 'auth'
    ]);

    Route::post('/friends/delete/{username}', [
        'uses' => 'FriendController@postDelete',
        'middleware' => 'auth'
    ]);

/**
 * Statuses
 */

    Route::post('/status', [
        'uses' => 'StatusController@postStatus',
        'middleware' => 'auth'
    ]);

    Route::post('/status/{statusId}/reply', [
        'uses' => 'StatusController@postReply',
        'middleware' => 'auth'
    ]);

    //
/**
 * Like ability
 */
    Route::get('/status/{statusId}/like', [
        'uses' => 'StatusController@getLike',
        'middleware' => 'auth'
    ]);
