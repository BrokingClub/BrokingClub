<?php

/*
|--------------------------------------------------------------------------
| application routes
|--------------------------------------------------------------------------
|
| here is where you can register all of the routes for an application.
| it's a breeze. simply tell laravel the uris it should respond to
| and give it the closure to execute when that uri is requested.
|
*/

route::group(array('before' => 'auth'), function(){


    route::resource('stocks', 'stockscontroller');
    route::resource('clubs', 'clubscontroller');
    route::resource('players', 'playerscontroller');

    route::get('setcarreer', 'playerscontroller@setcareer');
    route::post('setcarreer', 'playerscontroller@dosetcareer');

    route::get('clubs/{id}/join', 'playerscontroller@joinclub');
    route::get('profile/leaveclub', 'playerscontroller@leaveclub');
    route::resource('images', 'imagescontroller');
    route::resource('purchases', 'purchasescontroller');

    route::get('dashboard', ['as' => 'dashboard', 'uses' => 'playerscontroller@dashboard']);
    route::get('profile', ['as' => 'profile', 'uses' => 'userscontroller@edit']);
    route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'userscontroller@edit']);
    route::post('profile', 'userscontroller@update');

    route::post('profile/leaveclub', 'playerscontroller@leaveclub');

    route::post('changepassword', 'userscontroller@changepassword');
    route::post('users/{id}', ['as' => 'user.update', 'uses' => 'userscontroller@update']);
    route::post('users/{id}/changepassword', ['as' => 'user.changepassword', 'uses' => 'userscontroller@changepassword']);

    route::get('clubs/kick/{id}', 'playerscontroller@kickplayer');

    route::get('users/{id}/delete', 'userscontroller@delete');
    route::post('users/{id}/delete', 'userscontroller@dodelete');

    route::get('administrate', 'admincontroller@index');

});

route::get('/', 'homecontroller@showwelcome');
route::get('start', 'homecontroller@showlanding');

// confide routes
route::get('users/create', 'userscontroller@create');
route::post('users', 'userscontroller@store');
route::get('users/login', 'userscontroller@login');
route::post('users/login', 'userscontroller@dologin');
route::get('users/confirm/{code}', 'userscontroller@confirm');
route::get('users/forgot_password', 'userscontroller@forgotpassword');
route::post('users/forgot_password', 'userscontroller@doforgotpassword');
route::get('users/reset_password/{token}', 'userscontroller@resetpassword');
route::post('users/reset_password', 'userscontroller@doresetpassword');
route::get('users/logout', 'userscontroller@logout');

route::get('register', ['as' => 'register', 'uses' => 'userscontroller@create']);
route::get('login', ['as' => 'login', 'uses' => 'userscontroller@login']);
route::post('login', ['as' => 'dologin', 'uses' => 'userscontroller@dologin']);
route::get('logout', ['as' => 'logout', 'uses' => 'userscontroller@logout']);

include('menu.php');



