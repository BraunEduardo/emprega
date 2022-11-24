<div>
    <div class="row my-2">
        <div class="col-md">
            <h5>{{ $resultado->nome }}, {{ $resultado->nascimento->age }}</h5>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-3">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <b> {{ $resultado->municipio->nome }} - {{ $resultado->municipio->estado->sigla }}</b>
        </div>
        <div class="col-4">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
            <b> Possuí {{ $resultado->experiencias->count() }} experiências prévias</b>
        </div>
        <div class="col-3">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <b> {{ $resultado->grau_ensino }}</b>
        </div>
        <div class="col-2">
            <a href="tel:{{ $resultado->telefone }}" class="fa fa-phone-square" aria-hidden="true"></a>
            <a href="mailto:{{ $resultado->email }}" class="fa fa-envelope" aria-hidden="true"></a>
        </div>
    </div>
    <div class="row my-2">
        <div class="col text-center">
            <a href="{{ route('detalhes', [$resultado->id]) }}" class="pt-2 font-weight-bold">Ver mais...</a>
        </div>
    </div>
    <hr>
</div>
