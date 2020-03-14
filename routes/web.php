<?php

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

Auth::routes([
    'register' => false
]);

Route::namespace('Publico')->name('publico.')->group(function (){

    Route::get('/', 'LojaController@index')->name('loja');
    Route::resource('carrinho', 'CategoriaController');
    Route::get('categoria/{id}', 'CategoriaController@index')->name('categoria');
    Route::resource('conta', 'ContaController');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function (){
    Route::resource('user', 'UserController');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('produto', 'ProdutoController');
    Route::get('lista-categorias', 'CategoriaController@listarCategorias')->name('lista.categorias');
});
