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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('cadastro', 'PessoaController@cadastro')->name('cadastro');
Route::get('formulario', 'PessoaController@formulario')->name('formulario');
Route::get('formulario/{id}', 'PessoaController@show');
Route::post('checar', 'PessoaController@checar');
Route::post('salvar', 'PessoaController@salvar');
Route::get('busca', function () {
    return view('busca');
});
Route::post('busca', 'PessoaController@buscar');
Route::get('detalhes/{id}', 'PessoaController@detalhes');
Route::get('default', function () {
    return view('default');
});
