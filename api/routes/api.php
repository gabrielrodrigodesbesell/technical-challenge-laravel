<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1'], function () {
    

    // Cep
    Route::apiResource('ceps', 'CepApiController');

    // Conta
    Route::get('contas/{account}/extrato', 'ContaApiController@extrato')->name('contas.extrato');
    Route::get('contas/{cpf}/cpf', 'ContaApiController@cpf')->name('contas.cpf');
    Route::apiResource('contas', 'ContaApiController');

    // Movimentacao
    Route::apiResource('movimentacoes', 'MovimentacaoApiController');
});
