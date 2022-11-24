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

Route::get('/', 'SystemController@index')->name('index');
Route::get('inicio', function () {
    return view('inicio');
})->name('inicio');

Route::get('minha_pagina', 'SystemController@minhaPagina')->name('minha_pagina');

Route::get('cadastro', 'PessoaController@cadastro')->name('cadastro');
Route::get('formulario', 'PessoaController@formulario')->name('formulario');
Route::get('formulario/{id}', 'PessoaController@show')->name('formulario.edit');
Route::post('checar', 'PessoaController@checar')->name('checar');
Route::post('salvar', 'PessoaController@salvar')->name('salvar');
Route::get('busca', 'SystemController@buscar')->name('busca');
Route::get('detalhes/{id}', 'PessoaController@detalhes')->name('detalhes');
Route::get('inscrever/{id}', 'PessoaController@inscrever')->name('inscrever');

Route::get('cadEmpresa', 'EmpresaController@cadastro')->name('cadEmpresa');
Route::get('formEmpresa', 'EmpresaController@formulario')->name('formEmpresa');
Route::get('formEmpresa/{id}', 'EmpresaController@show')->name('formEmpresa.edit');
Route::post('checarEmpresa', 'EmpresaController@checar')->name('checarEmpresa');
Route::post('salvarEmpresa', 'EmpresaController@salvar')->name('salvarEmpresa');
Route::get('inscritos/{id}', 'EmpresaController@inscritos')->name('inscritos');

Route::get('default', function () {
    return view('default');
});
