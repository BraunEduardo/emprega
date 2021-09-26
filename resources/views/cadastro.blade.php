@extends('layout')

@section('titulo')
Cadastro
@endsection

@section('conteudo')
<div class="container">
    <form action="{{ action('PessoaController@checar') }}" method="post">
        @csrf
        <div class="row ">
            <div class="text-center col">
                <h3>Insira seus dados para iniciarmos o cadastramento</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label class="text-body" for="nome">Nome completo</label>
                    <input name="nome" id="nome" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="text-body" for="nascimento">Data de nascimento</label>
                    <input name="nascimento" id="nascimento" type="date" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="text-body" for="cpf">CPF</label>
                    <input name="cpf" id="cpf" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-white" onclick="window.location.href = '/';">
                    <i class="fa fa-reply"></i>
                    <b> Voltar</b>
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-arrow-right"></i>
                    <b> Iniciar</b>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
