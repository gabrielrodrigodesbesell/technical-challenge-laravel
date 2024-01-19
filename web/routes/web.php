<?php
    Route::get('/', 'HomeController@index')->name('home');

    // Pessoa
    Route::delete('pessoas/destroy', 'PessoaController@massDestroy')->name('pessoas.massDestroy');
    Route::resource('pessoas', 'PessoaController');

    // Endereco
    Route::get('enderecos/{pessoa}/createPessoa', 'EnderecoController@create')->name('enderecos.createPessoa');
    Route::delete('enderecos/destroy', 'EnderecoController@massDestroy')->name('enderecos.massDestroy');
    Route::resource('enderecos', 'EnderecoController');

    // Conta
    Route::delete('conta/destroy', 'ContaController@massDestroy')->name('conta.massDestroy');
    Route::resource('conta', 'ContaController');

    // Movimentacao
    Route::resource('movimentacoes', 'MovimentacaoController');

    