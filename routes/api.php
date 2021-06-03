<?php

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    /** Usuários */
    Route::post('agentes', "AgentesController@new");
    Route::get('agentes', "AgentesController@index");
    Route::post('auth/login', "AuthController@login");
    Route::put('agentes/{id}', "AgentesController@update");
    Route::delete('agentes/{id}', "AgentesController@remove");

    /** Status de Ocorrências */
    Route::get('statusOcorrencias', 'StatusOcorrenciaController@index');
    Route::post('statusOcorrencias', 'StatusOcorrenciaController@new');
    Route::patch('statusOcorrencias/{id}', "StatusOcorrenciaController@update");
    Route::delete('statusOcorrencias/{id}', 'StatusOcorrenciaController@remove');

    /** Denúncias */
    Route::get('denuncias', 'TicketsController@index');
    Route::post('denuncias', 'TicketsController@new');
    Route::patch('denuncias/{id}', "TicketsController@update");
    Route::delete('denuncias/{id}', 'TicketsController@remove');

    /** Acompanhamento de Denúncias */
    Route::get('denunciasAcompanhamento', 'DenunciasAcompanhamentoController@index');
    Route::get('denunciasAcompanhamentoById/{id}', 'DenunciasAcompanhamentoController@show');
    Route::post('denunciasAcompanhamento', 'DenunciasAcompanhamentoController@new');
    Route::patch('denunciasAcompanhamento/{id}', "DenunciasAcompanhamentoController@update");
    Route::delete('denunciasAcompanhamento/{id}', 'DenunciasAcompanhamentoController@remove');

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
