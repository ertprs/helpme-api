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
    Route::get('tickets', 'TicketsController@index');
    Route::post('tickets', 'TicketsController@new');
    Route::patch('tickets/{id}', "TicketsController@update");
    Route::delete('tickets/{id}', 'TicketsController@remove');

    /** Status de Tickets */
    Route::get('statusTicket', 'StatusTicketController@index');
    Route::post('statusTicket', 'StatusTicketController@new');
    Route::patch('statusTicket/{id}', "StatusTicketController@update");
    Route::delete('statusTicket/{id}', 'StatusTicketController@remove');

});

