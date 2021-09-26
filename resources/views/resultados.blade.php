@extends('layout')

@section('titulo')
Busca
@endsection

@section('conteudo')
<div class="container pt-4" style="position: fixed; top: 0px; z-index: 50; background-color: white;">
    {{-- <div class="row text-center">
        <div class="col-md">
            <div class="form-group mb-0">
                <select name="busca" id="busca" class="form-control">
                    <option value="{{ $busca }}">{{ in_array(substr($busca, 0, 6), ['curso_', 'cargo_']) ? substr($busca, 6) : $busca }}</option>
                    @foreach ($cursos as $curso)
                    <option value="curso_{{ $curso }}">{{ $curso }}</option>
                    @endforeach
                    @foreach ($cargos as $cargo)
                    <option value="cargo_{{ $cargo }}">{{ $cargo }}</option>
                    @endforeach
                </select>
                <i id="descricao" class="form-text">
                    É possível realizar busca por cargos, nomes, e-mail e palavras contidas na descrição de habilidades
                </i>
            </div>
        </div>
    </div> --}}
    <div class="row text-center">
        <div class="col-md">
            <div class="form-group">
                <form action="{{ action('PessoaController@buscar') }}" method="post">
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
                            <button type="submit" class="btn btn-block btn-primary">
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
<div class="container" style="margin-top: 110px">
    @each('resultado', $resultados, 'resultado')

    <div class="row">
        <div class="col text-center">
            <button type="button" class="btn btn-white" onclick="window.location.href = '/';">
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
</script>
@endsection

<style>
    .full-height {
        height: unset !important;
    }
</style>
