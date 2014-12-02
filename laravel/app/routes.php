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





Route::group(array('before' => 'auth'), function(){
    Route::get('/', 'HomeController@showWelcome');
    Route::resource('stocks', 'StocksController');
    Route::resource('clubs', 'ClubsController');
    Route::resource('players', 'PlayersController');
    Route::get('clubs/{id}/join', 'PlayersController@joinClub');
    Route::resource('images', 'ImagesController');
    Route::resource('purchases', 'PurchasesController');

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'PlayersController@dashboard']);
    Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@edit']);
    Route::post('profile', 'UsersController@update');

    Route::post('profile/leaveclub', 'PlayersController@leaveClub');

    Route::post('changePassword', 'UsersController@changepassword');
    Route::post('users/{id}', ['as' => 'user.update', 'uses' => 'UsersController@update']);
    Route::post('users/{id}/changepassword', ['as' => 'user.changepassword', 'uses' => 'UsersController@changePassword']);

    Route::get('users/{id}/delete', 'UsersController@delete');
    Route::post('users/{id}/delete', 'UsersController@doDelete');
});

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

Route::get('register', ['as' => 'register', 'uses' => 'UsersController@create']);
Route::get('login', ['as' => 'login', 'uses' => 'UsersController@login']);
Route::post('login', ['as' => 'doLogin', 'uses' => 'UsersController@doLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'UsersController@logout']);

include('menu.php');



