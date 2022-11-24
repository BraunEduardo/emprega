@extends('layout')

@section('titulo')
Cadastro
@endsection

@section('conteudo')
<div class="container">
	<form action="{{ action('EmpresaController@checar') }}" method="post">
		@csrf
		<div class="row ">
			<div class="text-center col">
				<h3>Insira seus dados para iniciarmos o cadastramento</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-body" for="razao_social">Razão social</label>
					<input name="razao_social" required value="{{ old('razao_social') }}" id="razao_social" class="form-control {{ $errors->has('razao_social') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
					@error ('razao_social')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="text-body" for="cnpj">CNPJ</label>
					<input name="cnpj" type="tel" minlength="18" required value="{{ old('cnpj') }}" id="cnpj" class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
					@error ('cnpj')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				<button type="button" class="btn btn-white" onclick="window.location.href = '{{ route('inicio') }}';">
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
@section('script')
<script>
	$('#cnpj').mask('00.000.000/0000-00');
</script>
@endsection
