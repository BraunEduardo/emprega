@extends('layout')

@section('titulo')
Formulário
@endsection

@section('conteudo')
<div class="container">
    <form action="{{ action('PessoaController@salvar') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label class="text-body" for="nome">Nome completo</label>
                    <input name="nome" required value="{{ old('nome') }}" id="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
                    @error ('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="text-body" for="nascimento">Data de nascimento</label>
                    <input name="nascimento" required value="{{ old('nascimento') }}" id="nascimento" type="date" class="form-control {{ $errors->has('nascimento') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
                    @error ('nascimento')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="text-body" for="cpf">CPF</label>
                    <input name="cpf" type="tel" minlength="14" required value="{{ old('cpf') }}" id="cpf" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
                    @error ('cpf')
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
                    <label class="text-body" for="grau_ensino">Grau de ensino</label>
                    <select name="grau_ensino" required value="{{ old('grau_ensino') }}" id="grau_ensino" class="select2 form-control {{ $errors->has('grau_ensino') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
                        <option></option>
                        @foreach (App\Pessoa::GRAUS_ENSINO as $grau_ensino)
                        <option value="{{ $grau_ensino }}" {{ $grau_ensino===old('grau_ensino') ? 'selected' : '' }}>{{ $grau_ensino }}</option>
                        @endforeach
                    </select>
                    @error ('grau_ensino')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
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
            <div class="col-md-3">
                <div class="form-group">
                    <label class="text-body" for="estado_civil">Estado civil</label>
                    <select name="estado_civil" required id="estado_civil" class="select2 form-control {{ $errors->has('estado_civil') ? 'is-invalid' : ( $errors->isNotEmpty() ? 'is-valid' : '' ) }}">
                        <option></option>
                        @foreach (App\Pessoa::ESTADOS_CIVIS as $estado_civil)
                        <option value="{{ $estado_civil }}" {{ $estado_civil===old('estado_civil') ? 'selected' : '' }}>{{ $estado_civil }}</option>
                        @endforeach
                    </select>
                    @error ('estado_civil')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <fieldset>
                    <legend>Formações</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-body" for="instituicao">Instituição</label>
                                <select id="instituicao" class="select2-tags form-control">
                                    <option></option>
                                    @foreach (old('instituicao', []) as $instituicao)
                                    <option value="{{ $instituicao }}">{{ $instituicao }}</option>
                                    @endforeach
                                    @foreach (App\Formacao::select('instituicao')->whereNotIn('instituicao', old('instituicao', []))->distinct()->pluck('instituicao') as $instituicao)
                                    <option value="{{ $instituicao }}">{{ $instituicao }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-body" for="curso">Curso</label>
                                <select id="curso" class="select2-tags form-control">
                                    <option></option>
                                    @foreach (old('curso', []) as $curso)
                                    <option value="{{ $curso }}">{{ $curso }}</option>
                                    @endforeach
                                    @foreach (App\Formacao::select('curso')->whereNotIn('curso', old('curso', []))->distinct()->pluck('curso') as $curso)
                                    <option value="{{ $curso }}">{{ $curso }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-body" for="situacao">Situação</label>
                                <select id="situacao" class="select2 form-control">
                                    <option></option>
                                    @foreach (App\Formacao::SITUACOES as $situacao)
                                    <option value="{{ $situacao }}" {{ $situacao===old('situacao') ? 'selected' : '' }}>{{ $situacao }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label style="display: block;">&nbsp;</label>
                            <button class="btn btn-primary btn-block form-control" type="button" onclick="inserirFormacao();">
                                <i class="fa fa-plus" aria-hidden="true"> Adicionar</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" id="formacoes">
                            <tbody>
                                @foreach (old('instituicao', []) as $chave => $instituicao)
                                <tr>
                                    <td>
                                        <input class="label-input" readonly name="instituicao[]" value="{{ $instituicao }}">
                                    </td>
                                    <td>
                                        <input class="label-input" readonly name="curso[]" value="{{ old('curso.' . $chave) }}">
                                    </td>
                                    <td>
                                        <input class="label-input {{ $errors->has('situacao.' . $chave) ? 'is-invalid' : '' }}" readonly name="situacao[]" value="{{ old('situacao.' . $chave) }}">
                                        @error ('situacao.' . $chave)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
            </div>
        </div>
        <div class="row">
            <div class="col">
                <fieldset>
                    <legend>Experiências</legend>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label class="text-body" for="organizacao">Organização</label>
                                <select id="organizacao" class="select2-tags form-control">
                                    <option></option>
                                    @if ($errors->isNotEmpty())
                                    @foreach (old('organizacao', []) as $organizacao)
                                    <option value="{{ $organizacao }}">{{ $organizacao }}</option>
                                    @endforeach
                                    @endif
                                    @foreach (App\Experiencia::select('organizacao')->whereNotIn('organizacao', old('organizacao', []))->distinct()->pluck('organizacao') as $organizacao)
                                    <option value="{{ $organizacao }}">{{ $organizacao }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                                <label class="text-body" for="inicio">Período</label>
                                <div class="row">
                                    <div class="col">
                                        <select id="inicio" class="select2 form-control">
                                            <option></option>
                                            @foreach (range(Carbon\Carbon::now()->year, 1960) as $ano)
                                            <option value="{{ $ano }}">{{ $ano }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <b class="text-body" style="padding: 0.375rem 0;">-</b>
                                    <div class="col">
                                        <select name="fim" id="fim" class="select2 form-control">
                                            <option></option>
                                            @foreach (range(Carbon\Carbon::now()->year, 1960) as $ano)
                                            <option value="{{ $ano }}">{{ $ano }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label style="display: block;">&nbsp;</label>
                            <button class="btn btn-primary btn-block form-control" type="button" onclick="inserirExperiencia();">
                                <i class="fa fa-plus" aria-hidden="true"> Adicionar</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered" id="experiencias">
                            <tbody>
                                @foreach (old('organizacao', []) as $chave => $organizacao)
                                <tr>
                                    <td>
                                        <input class="label-input" readonly name="organizacao[]" value="{{ $organizacao }}">
                                    </td>
                                    <td>
                                        <input class="label-input" readonly name="cargo[]" value="{{ old('cargo.' . $chave) }}">
                                    </td>
                                    <td>
                                        <input class="label-input w5" readonly name="inicio[]" value="{{ old('inicio.' . $chave) }}">
                                        <span class="text-body">-</span>
                                        <input class="label-input w5" readonly name="fim[]" value="{{ old('fim.' . $chave) }}">
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
                        <button type="button" class="btn btn-white" onclick="window.location.href='cadastro'">
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
@if (old('nome') === null)
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

    $('#cpf').mask('000.000.000-00');
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

    function inserirFormacao() {
        let instituicao = $('#instituicao').val();
        let curso = $('#curso').val();
        let situacao = $('#situacao').val();

        if (instituicao !== '' && curso !== '' && situacao !== '') {
            $('#instituicao').append(new Option(instituicao)).trigger('change');
            $('#curso').append(new Option(curso)).trigger('change');
            $('#instituicao,#curso').val(null).trigger('change');
            $('#formacoes tbody').append(`
<tr>
    <td>
        <input class="label-input" readonly name="instituicao[]" value="${instituicao}">
    </td>
    <td>
        <input class="label-input" readonly name="curso[]" value="${curso}">
    </td>
    <td>
        <input class="label-input" readonly name="situacao[]" value="${situacao}">
    </td>
    <td>
        <button class="btn btn-sm btn-danger" type="button" onclick="removerLinha(this);">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>`);
        }
    }

    function inserirExperiencia() {
        let organizacao = $('#organizacao').val();
        let cargo = $('#cargo').val();
        let inicio = $('#inicio').val();
        let fim = $('#fim').val();

        if (organizacao !== '' && cargo !== '' && inicio !== '' && fim !== '') {
            $('#organizacao').append(new Option(organizacao)).trigger('change');
            $('#cargo').append(new Option(cargo)).trigger('change');
            $('#organizacao,#cargo,#inicio,#fim').val(null).trigger('change');
            $('#experiencias tbody').append(`
<tr>
    <td>
        <input class="label-input" readonly name="organizacao[]" value="${organizacao}">
    </td>
    <td>
        <input class="label-input" readonly name="cargo[]" value="${cargo}">
    </td>
    <td>
        <input class="label-input w5" readonly name="inicio[]" value="${inicio}">-<input class="label-input w5" readonly name="fim[]" value="${fim}">
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
        inserirExperiencia();
        inserirFormacao();
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
