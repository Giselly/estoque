<?php

Route::get('/', function() {
    return 'Primeira Lógica com Laravel';
});


Route::group(['middleware' => ['web']], function () {
    Route::get('/produtos', 'ProdutoController@lista');
    Route::get('/produtos/mostra/{id}', 'ProdutoController@mostra')->where('id', '[0-9]+');
    Route::get('/produtos/novo', 'ProdutoController@novo');
    Route::post('/produtos/adiciona', 'ProdutoController@adiciona');
});
//Route::método('caminho', 'função com a resposta a ser enviada');