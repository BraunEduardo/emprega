<div>
	<div class="row my-2">
		<div class="col-md">
			<h5 class="pull-left">{{ $resultado->cargo }}</h5>
			<h5 class="pull-right">{{ $resultado->remuneracao }}</h5>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-4">
			<i class="fa fa-building" aria-hidden="true"></i>
			<b> {{ $resultado->empresa->razao_social }} ({{ $resultado->empresa->cnpj }})</b>
			<br>
			<i class="fa fa-map-marker" aria-hidden="true"></i>
			<b> {{ $resultado->empresa->municipio->nome }} - {{ $resultado->empresa->municipio->estado->sigla }}</b>


		</div>
		<div class="col">
			<i class="fa fa-align-justify" aria-hidden="true"></i>
			<b> &emsp;{{ $resultado->descricao }}</b>
		</div>
		<div class="col-2">
			<a href="tel:{{ $resultado->empresa->telefone }}" class="fa fa-phone-square" aria-hidden="true"></a>
			<a href="mailto:{{ $resultado->empresa->email }}" class="fa fa-envelope" aria-hidden="true"></a>
		</div>
	</div>
	<div class="row my-2">
		<div class="col text-center">
			<button onclick="inscrever({{ $resultado->id }})" class="pt-2 font-weight-bold btn btn-link">Inscrever-se...</button>
		</div>
	</div>
	<hr>
</div>
