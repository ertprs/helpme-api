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

    /** Clientes */
    Route::get('clients', "ClientsController@index");
    Route::post('clients', "ClientsController@new");
    Route::put('clients/{id}', "ClientsController@update");
    Route::delete('clients/{id}', "ClientsController@remove");

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

    /** Acompanhamento de Tickets */
    Route::get('followTicket', 'FollowTicketsController@index');
    Route::get('followTicketById/{id}', 'FollowTicketsController@show');
    Route::post('followTicket', 'FollowTicketsController@new');
    Route::patch('followTicket/{id}', "FollowTicketsController@update");
    Route::delete('followTicket/{id}', 'FollowTicketsController@remove');

    /** Usuários */
    Route::get('notifications/{id}', "NotificationsController@show");
    Route::get('notifications/allUnreaded/{id}', "NotificationsController@showUnreaded");
    Route::post('notifications/{id}', "NotificationsController@new");
    Route::get('notifications/readAll/{id}', "NotificationsController@readAll");
    Route::patch('notifications/read/{id}', "NotificationsController@read");
    Route::patch('notifications/unread/{id}', "NotificationsController@unread");

    /** Resumos para o dashboard */
    Route::get('dashboard', 'DashboardController@dashboard');
});
