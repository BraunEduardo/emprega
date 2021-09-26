@extends('layout')

@section('titulo')
Início
@endsection

@section('conteudo')
<div class="content">
    <div class="title text-center">
        Emprega
    </div>

    <div class="row text-center" style="width: 60vw;">
        <a href="cadastro" class="badge col-md bg-primary text-white p-4 m-4">
            <i class="fa fa-user-o fa-fw fa-5x text-white" aria-hidden="true"></i>
            <div style="margin-top: 1em">
                <b class="icon-subtext">Busco emprego</b>
            </div>
        </a>
        <a href="busca" class="badge col-md bg-primary text-white p-4 m-4">
            <i class="fa fa-building-o fa-fw fa-5x text-white" aria-hidden="true"></i>
            <div style="margin-top: 1em">
                <b class="icon-subtext">Sou empregador</b>
            </div>
        </a>
    </div>
</div>
@endsection

<style>
    .icon-subtext {
        font-size: 1.5em;
    }

    @media (min-width: 768px) {
        .icon-subtext {
            font-size: 2.5em;
        }
    }
</style>
