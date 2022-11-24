@extends('layout')

@section('titulo')
Formulário
@endsection

@section('conteudo')
<div class="container">
	<form action="{{ action('EmpresaController@salvar') }}" method="post">
		@csrf
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
			<div class="col-md">
				<div class="form-group">
					<label class="text-body" for="telefone">Telefone</label>
					<input name="telefone" required type="tel" value="{{ old('telefone') }}" id="telefone" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
					@error ('telefone')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			</div>
			<div class="col-md">
				<div class="form-group">
					<label class="text-body" for="email">E-mail</label>
					<input name="email" required type="email" value="{{ old('email') }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
					@error ('email')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<label class="text-body" for="municipio_id">Cidade</label>
					<select name="municipio_id" required value="{{ old('municipio_id') }}" id="municipio_id" class="select2-min form-control {{ $errors->has('municipio_id') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
						<option></option>
						@foreach (App\Estado::with('municipios')->get() as $estado)
						<optgroup label="{{ $estado->sigla }}">
							@foreach ($estado->municipios as $municipio)
							<option value="{{ $municipio->id }}" {{ $municipio->id == old('municipio_id') ? 'selected' : '' }}>{{ $municipio->nome . ' - ' . $estado->sigla }}</option>
							@endforeach
						</optgroup>
						@endforeach
					</select>
					@error ('municipio_id')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<fieldset>
					<legend>Vagas</legend>
					<div class="row">
						<div class="col-md">
							<div class="form-group">
								<label class="text-body" for="cargo">Cargo</label>
								<select id="cargo" class="select2-tags form-control">
									<option></option>
									@if ($errors->isNotEmpty())
									@foreach (old('cargo', []) as $cargo)
									<option value="{{ $cargo }}">{{ $cargo }}</option>
									@endforeach
									@endif
									@foreach (App\Experiencia::select('cargo')->whereNotIn('cargo', old('cargo', []))->distinct()->pluck('cargo') as $cargo)
									<option value="{{ $cargo }}">{{ $cargo }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md">
							<div class="form-group">
								<label class="text-body" for="remuneracao">Remuneração</label>
								<input id="remuneracao" class="form-control">
							</div>
						</div>
						<div class="col-md">
							<div class="form-group">
								<label class="text-body" for="remuneracao">Remuneração</label>
								<textarea id="descricao" class="form-control"></textarea>
							</div>
						</div>
						<div class="col-md-2">
							<label style="display: block;">&nbsp;</label>
							<button class="btn btn-primary btn-block form-control" type="button" onclick="inserirVaga();">
								<i class="fa fa-plus" aria-hidden="true"> Adicionar</i>
							</button>
						</div>
					</div>
				</fieldset>
				<div class="row">
					<div class="col">
						<table class="table table-bordered" id="vagas">
							<tbody>
								@foreach (old('cargo', []) as $chave => $cargo)
								<tr>
									<td>
										<input class="label-input" readonly name="cargo[]" value="{{ $cargo }}">
									</td>
									<td>
										<input class="label-input" readonly name="remuneracao[]" value="{{ old('remuneracao.' . $chave) }}">
									</td>
									<td>
										<textarea class="label-input" readonly name="descricao[]">{{ old('descricao.' . $chave) }}</textarea>
									</td>
									<td>
										<button class=" btn btn-sm btn-danger" type="button" onclick="removerLinha(this);">
											<i class="fa fa-trash"></i>
										</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-check text-center h5">
							<input class="form-check-input {{ $errors->has('aceite') ? 'is-invalid' : '' }}" type="checkbox" name="aceite" id="aceite">
							<label class="form-check-label {{ $errors->has('aceite') ? 'is-invalid' : '' }}" for="aceite">
								Concordo com a utilização de meus dados para os fins funcionais desse site, sabendo que os mesmos serão exibidos em resultados de consultas públicas
							</label>
							@error ('aceite')
							<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col text-center">
						<button type="button" class="btn btn-white" onclick="window.location.href = '{{ route('cadastro') }}';">
							<i class=" fa fa-reply"></i>
							<b> Voltar</b>
						</button>
						<button type="submit" class="btn btn-success">
							<i class="fa fa-save"></i>
							<b> Salvar</b>
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection

@section('script')
@if (old('razao_social') === null)
<script>
	Swal.fire({
		icon: 'info',
		title: 'Não encontramos nenhum cadastro existente com os dados informados',
		timer: 2000
	});
</script>
@endif
@if (session('sucesso'))
<script>
	Swal.fire({
		icon: 'success',
		title: "{{ session('sucesso') }}",
		timer: 2000
	})
</script>
@endif
<script>
	$('.select2').select2({
		allowClear: true,
		placeholder: '',
	});
	$('.select2-tags').select2({
		tags: true,
		allowClear: true,
		placeholder: '',
	});
	$('.select2-min').select2({
		minimumInputLength: 3,
		matcher: matchStart,
	});

	$('#cnpj').mask('00.000.000/0000-00');
    $('#remuneracao').mask("#.##0,00", {reverse: true});

	var masks = ['(00) 00000-0000', '(00) 0000-00009'],
		maskBehavior = function(val, e, field, options) {
			return val.length > 14 ? masks[0] : masks[1];
		};
	$('#telefone').mask(maskBehavior, {
		onKeyPress: function(val, e, field, options) {
			field.mask(maskBehavior(val, e, field, options), options);
		}
	});

	function matchStart(params, data) {
		// If there are no search terms, return all of the data
		if ($.trim(params.term) === '') {
			return data;
		}

		// Skip if there is no 'children' property
		if (typeof data.children === 'undefined') {
			return null;
		}

		// `data.children` contains the actual options that we are matching against
		var filteredChildren = [];
		$.each(data.children, function(idx, child) {
			if (child.text.toUpperCase().replace('-', '').replace('  ', ' ').indexOf(params.term.toUpperCase().replace('-', '').replace('  ', ' ')) == 0) {
				filteredChildren.push(child);
			}
		});

		// If we matched any of the timezone group's children, then set the matched children on the group
		// and return the group object
		if (filteredChildren.length) {
			var modifiedData = $.extend({}, data, true);
			modifiedData.children = filteredChildren;

			// You can return modified objects from here
			// This includes matching the `children` how you want in nested data sets
			return modifiedData;
		}

		// Return `null` if the term should not be displayed
		return null;
	}

	function inserirVaga() {
		let cargo = $('#cargo').val();
		let descricao = $('#descricao').val();
		let remuneracao = $('#remuneracao').val();

		if (cargo !== '' && descricao !== '' && remuneracao !== '') {
			$('#cargo').append(new Option(cargo)).trigger('change');
			$('#cargo,#descricao,#remuneracao').val(null).trigger('change');
			$('#vagas tbody').append(`
<tr>
    <td>
        <input class="label-input" readonly name="cargo[]" value="${cargo}">
    </td>
    <td>
        <input class="label-input" readonly name="remuneracao[]" value="${remuneracao}">
    </td>
    <td>
        <textarea class="label-input" readonly name="descricao[]">${descricao}</textarea>
    </td>
    <td>
        <button class="btn btn-sm btn-danger" type="button" onclick="removerLinha(this);">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>`);
		}
	}

	function removerLinha(botao) {
		$(botao).parents('tr').remove();
	}

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

	$('form').on('submit', function() {
		inserirVaga();
	})
</script>

@endsection

<style>
	.label-input {
		border: none;
		color: #6c757d;
		width: 100%;
		pointer-events: none;
	}

	.flex-center {
		display: block !important;
		padding: 30px 0px;
	}

	body,
	.full-height {
		height: unset !important;
	}

	table tbody td:last-child {
		width: 1px;
	}

	.w5 {
		width: 5ch;
	}
</style>
