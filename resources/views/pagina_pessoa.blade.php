@extends('layout')

@section('titulo')
Minha página
@endsection

@section('conteudo')
<div class="container">

	<div class="row text-center">
		<div class="col-md">
			<h1>Incrições</h1>
		</div>
	</div>
    @foreach ($pessoa->inscricoes as $inscricao)
<div>
	<div class="row my-2">
		<div class="col-md">
			<h5 class="pull-left">{{ $inscricao->vaga->cargo }}</h5>
			<h5 class="pull-right">{{ $inscricao->vaga->remuneracao }}</h5>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-4">
			<i class="fa fa-building" aria-hidden="true"></i>
			<b> {{ $inscricao->vaga->empresa->razao_social }} ({{ $inscricao->vaga->empresa->cnpj }})</b>
			<br>
			<i class="fa fa-map-marker" aria-hidden="true"></i>
			<b> {{ $inscricao->vaga->empresa->municipio->nome }} - {{ $inscricao->vaga->empresa->municipio->estado->sigla }}</b>


		</div>
		<div class="col">
			<i class="fa fa-align-justify" aria-hidden="true"></i>
			<b> &emsp;{{ $inscricao->vaga->descricao }}</b>
		</div>
		<div class="col-2">
			<a href="tel:{{ $inscricao->vaga->empresa->telefone }}" class="fa fa-phone-square" aria-hidden="true"></a>
			<a href="mailto:{{ $inscricao->vaga->empresa->email }}" class="fa fa-envelope" aria-hidden="true"></a>
		</div>
	</div>
	<hr>
</div>

    @endforeach
	<div class="row">
		<div class="col text-center">
			<button type="button" class="btn btn-white" onclick="history.back();">
				<i class="fa fa-reply"></i>
				<b> Voltar</b>
			</button>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
