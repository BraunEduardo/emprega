@extends('layout')

@section('titulo')
Busca
@endsection

@section('conteudo')
<div class="container pt-4" id="buscaContainer" style="position: fixed; top: 0px; z-index: 50; background-color: white;">
	<div class="row text-center">
		<div class="col-md">
			<div class="form-group">
				<form action="{{ action('SystemController@buscar') }}">
					@csrf
					<div class="row">
						<div class="col-md-10">
							<select name="busca" required id="busca" class="form-control form-control-lg">
								<option></option>
								@foreach (App\Formacao::select('curso')->distinct()->pluck('curso') as $curso)
								<option value="curso_{{ $curso }}">{{ $curso }}</option>
								@endforeach
								@foreach (App\Experiencia::select('cargo')->distinct()->pluck('cargo') as $cargo)
								<option value="cargo_{{ $cargo }}">{{ $cargo }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-block btn-primary" style="white-space: nowrap;">
								<i class="fa fa-fw fa-search"></i> Buscar
							</button>
						</div>
					</div>
				</form>
				<i id="descricao" class="form-text" style="font-size: 0.8em">
					É possível realizar busca por cargos, nomes, e-mail e cursos
				</i>
			</div>
		</div>
	</div>
</div>
<div class="container" id="resultadosContainer">
	@each('resultado', $resultados, 'resultado')

	<div class="row">
		<div class="col text-center">
			<a class="btn btn-white" href="{{ route('inicio') }}">
				<i class="fa fa-reply"></i>
				<b> Voltar</b>
			</a>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$('select').select2({
		tags: true,
		minimumInputLength: 4,
		placeholder: '',
	});

	$('#resultadosContainer').css('margin-top', $('#buscaContainer').outerHeight(true));
</script>
@endsection

<style>
	.full-height {
		height: unset !important;
	}

	@media (max-width: 768px) {
		button[type=submit] {
			margin-top: 1em;
		}
	}
</style>
