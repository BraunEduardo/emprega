@extends('layout')

@section('titulo')
Busca
@endsection

@section('conteudo')
<div class="container">

	<div class="row text-center">
		<div class="col-md">
			<div class="form-group" style="font-size: 1.8em">
				<label class="text-body" for="busca">Insira aqui os termos pelos quais deseja buscar</label>
				<form action="{{ action('SystemController@buscar') }}">
					@csrf
					<div class="row">
						<div class="col-md-10">
							<select name="busca" required id="busca" class="form-control form-control-lg">
								<option></option>
								@foreach (App\Empresa::select('razao_social', 'id')->distinct()->pluck('razao_social', 'id') as $id => $empresa)
								<option value="empresa_{{ $id }}">{{ $empresa }}</option>
								@endforeach
								@foreach (App\Vaga::select('cargo')->distinct()->pluck('cargo') as $cargo)
								<option value="cargo_{{ $cargo }}">{{ $cargo }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-block btn-primary">
								<i class="fa fa-fw fa-search"></i> Buscar
							</button>
						</div>
					</div>
				</form>
				<i id="descricao" class="form-text" style="font-size: 0.8em">
					É possível realizar busca por cargos, empresas e descrição de vagas
				</i>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col text-center">
			<button type="button" class="btn btn-white" onclick="window.location.href = '{{ route('inicio') }}';">
				<i class="fa fa-reply"></i>
				<b> Voltar</b>
			</button>
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

	$(document).on('select2:open', function(e) {
		window.setTimeout(function() {
			let search_field = $('.select2-container--open .select2-search__field').get(0);

			if (search_field !== undefined) {
				search_field.focus();
			}
		}, 200);
	});

	// on first focus (bubbles up to document), open the menu
	$(document).on('focus', '.select2-selection.select2-selection--single', function(e) {
		$(this).closest(".select2-container").siblings('select:enabled').select2('open');
	});

	// steal focus during close - only capture once and stop propogation
	$('select.select2,select.select2-tags,select.select2-min').on('select2:closing', function(e) {
		$(e.target).data("select2").$selection.one('focus focusin', function(e) {
			e.stopPropagation();
		});
	});
</script>
@endsection

<style>
	@media (max-width: 768px) {
		button[type=submit] {
			margin-top: 1em;
		}
	}
</style>
