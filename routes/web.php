<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::group(['prefix' => 'jogadores'], function () {
    Route::get('', ['as' => 'jogadores', 'uses' => 'JogadoresController@index']);
    Route::get('create', ['as' => 'jogadores.create', 'uses' => 'JogadoresController@create']);
    Route::post('save', ['as' => 'jogadores.save', 'uses' => 'JogadoresController@save']);
    Route::get('{id}/edit', ['as' => 'jogadores.edit', 'uses' => 'JogadoresController@edit']);
    Route::put('{id}/update', ['as' => 'jogadores.update', 'uses' => 'JogadoresController@update']);
    Route::get('{id}/delete', ['as' => 'jogadores.delete', 'uses' => 'JogadoresController@delete']);
    Route::post('montar-time/{qtde}', ['as' => 'jogadores.montar-time', 'uses' => 'JogadoresController@montartime']);
});
