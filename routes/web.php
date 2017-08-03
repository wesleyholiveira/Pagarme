<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Index
$app->get('/', 'IndexController@get');

// Fantasia
$app->get('/fantasia[/{id}]', 'FantasiaController@get');
$app->post('/fantasia', 'FantasiaController@post');
$app->put('/fantasia', 'FantasiaController@put');
$app->delete('/fantasia[/{id}]', 'FantasiaController@delete');

// Fornecedor
$app->get('/fornecedor[/{id}]', 'FornecedorController@get');
$app->post('/fornecedor', 'FornecedorController@post');
$app->put('/fornecedor', 'FornecedorController@put');
$app->delete('/fornecedor[/{id}]', 'FornecedorController@delete');

// Imagem
$app->get('/imagem[/{id}]', 'ImagemController@get');
$app->post('/imagem', 'ImagemController@post');
$app->put('/imagem', 'ImagemController@put');
$app->delete('/imagem[/{id}]', 'ImagemController@delete');

// Checkout
$app->post('/checkout', 'CheckoutController@doCheckout');
