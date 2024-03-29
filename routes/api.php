<?php

use Illuminate\Support\Facades\Route;

/**
 * Endpoints da API
 */

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('address', "AddressController@index"); // Endpoint para listar todos os endereços cadastrados
    Route::get('address/{id}', "AddressController@show"); // Endpoint para listar o endereço pelo id local
    Route::post('address', "AddressController@new"); // Endpoint para cadastrar um novo endereço
    Route::put('address/{id}', "AddressController@update"); // Endpoint para atualizar um endereço existente
    Route::delete('address/{id}', "AddressController@remove"); // Endpoint para excluir um endereço existente

    Route::get('address/cep/{cep}', "AddressController@findByCep"); // Endpoint retorna os endereços encontrados baseado na busca por CEP
    Route::post('address/find', "AddressController@find"); // Endpoint retorna os endereços baseado no logradouro
});
