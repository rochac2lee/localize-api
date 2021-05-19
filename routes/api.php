<?php

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Route;

/**
 * Endpoints da API
 */

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('address', "AddressController@index"); // Endpoint para listar todos os endereços cadastrados
    Route::post('address', "AddressController@new"); // Endpoint para cadastrar um novo endereço
    Route::put('address/{id}', "AddressController@update"); // Endpoint para atualizar um endereço existente
    Route::delete('address/{id}', "AddressController@remove"); // Endpoint para excluir um endereço existente
});
