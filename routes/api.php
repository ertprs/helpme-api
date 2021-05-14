<?php

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('users', "UsersController@new");
    Route::post('permissions', "PermissionsController@new");
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function () {

    /** Usuários */
    Route::get('users', "UsersController@index");
    Route::post('auth/login', "AuthController@login");
    Route::put('users/{id}', "UsersController@update");
    Route::delete('users/{id}', "UsersController@remove");

    /** Permissões */
    Route::get('permissions', "PermissionsController@index");

    /** Tickets */
    Route::get('tickets', 'SitesComponentsController@index');
    Route::post('tickets', 'SitesComponentsController@new');
    Route::patch('tickets/{id}', "SitesComponentsController@update");
    Route::delete('tickets/{id}', 'SitesComponentsController@remove');

});

