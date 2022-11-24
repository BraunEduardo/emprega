@extends('layout')

@section('titulo')
Inscritos
@endsection

@section('conteudo')
<div class="container">

	<div class="row text-center">
		<div class="col-md">
			<h1>Vaga de {{ $vaga->cargo }}</h1>
		</div>
	</div>

	@each('resultado', $inscritos, 'resultado', 'sem_inscritos')

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
