@extends('layout')

@section('titulo')
Detalhes
@endsection

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label class="text-body">Nome completo</label>
                <span>{{ $pessoa->nome }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="text-body">Data de nascimento</label>
                <span>{{ $pessoa->nascimento->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="text-body">CPF</label>
                <span>{{ $pessoa->cpf }} </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label class="text-body">Telefone</label>
                <a href="tel:{{ $pessoa->telefone }}">{{ $pessoa->telefone }}</a>
                <button type="button" class="btn btn-sm btn-primary" onclick="copy_text_from_element(this.previousElementSibling);">
                    <i class="fa fa-copy"></i>
                </button>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label class="text-body">E-mail</label>
                <a href="mailto:{{ $pessoa->email }}">{{ $pessoa->email }}</a>
                <button type="button" class="btn btn-sm btn-primary" onclick="copy_text_from_element(this.previousElementSibling);">
                    <i class="fa fa-copy"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label class="text-body">Grau de ensino</label>
                <span>{{ $pessoa->grau_ensino }}</span>
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                <label class="text-body">Cidade</label>
                <span>{{ $pessoa->municipio->nome }} - {{ $pessoa->municipio->estado->sigla }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="text-body">Estado civil</label>
                <span>{{ $pessoa->estado_civil }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Formações</h3>
            <table class="table table-bordered">
                <tbody>
                    @foreach ($pessoa->formacoes as $formacao)
                    <tr>
                        <td>
                            <span>{{ $formacao->instituicao }}</span>
                        </td>
                        <td>
                            <span>{{ $formacao->curso }}</span>
                        </td>
                        <td>
                            <span>{{ $formacao->situacao }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Experiências</h3>
            <table class="table table-bordered" id="experiencias">
                <tbody>
                    @foreach ($pessoa->experiencias as $experiencia)
                    <tr>
                        <td>
                            <span>{{ $experiencia->organizacao }}</span>
                        </td>
                        <td>
                            <span>{{ $experiencia->cargo }}</span>
                        </td>
                        <td>
                            <span>{{ $experiencia->inicio }} - {{ $experiencia->fim }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <button type="button" class="btn btn-white" onclick="window.history.back()">
                <i class=" fa fa-reply"></i>
                <b> Voltar</b>
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function copy_text_from_element(element) {
        var textArea = document.createElement("textarea");
        textArea.value = element.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();

        Swal.fire({
            icon: 'success',
            text: 'Conteúdo copiado para a área de transferência',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    }
</script>
@endsection

<style>
    .table {
        color: inherit !important;
    }

    .container label {
        display: block !important;
    }

    .flex-center {
        display: block !important;
        padding: 30px 0px;
    }

    body,
    .full-height {
        height: unset !important;
    }

    .w5 {
        width: 5ch;
    }
</style>
