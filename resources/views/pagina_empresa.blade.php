@extends('layout')

@section('titulo')
Minha página
@endsection

@section('conteudo')
<div class="container">

	<div class="row text-center">
		<div class="col-md">
			<h1>Vagas</h1>
		</div>
	</div>

	@foreach($empresa->vagas as $vaga)
	<div>
		<div class="row my-2">
			<div class="col-md">
				<h5 class="pull-left">{{ $vaga->cargo }}</h5>
				<h5 class="pull-right">R${{ $vaga->remuneracao }}</h5>
			</div>
		</div>
		<div class="row my-2">
			<div class="col-md">
				<i class="fa fa-align-justify" aria-hidden="true"></i>
				<span> &emsp; {{ $vaga->descricao }}</span>
			</div>
		</div>
		<div class="row my-2">
			<div class="col text-center">
				<a href="inscritos/{{ $vaga->id }}" class="pt-2 font-weight-bold">Ver inscritos...</a>
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
