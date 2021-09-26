@extends('layout')

@section('titulo')
Busca
@endsection

@section('conteudo')
<div class="container pt-4" style="position: fixed; top: 0px; z-index: 50; background-color: white;">
    <div class="text-center">
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
    </div>
</div>
<div class="container" style="margin-top: 100px">
    @each('resultado', $resultados, 'resultado')
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
