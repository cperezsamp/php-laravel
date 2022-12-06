@if (session('rol') == 'Ponente')
<script>window.location = "/ponente";</script>
@endif
<x-layout.header> 
Bienvenido {{ session('username') }}

<div align="center">
	@php
    	$tipoVistaColorXdia = "btn btn-primary";
        $tipoVistaColorXsemana = "btn btn-primary";
        $tipoVistaColorXmes = "btn btn-primary";
	@endphp
	@if ($botonClicado === '2')
    	@php
    		$tipoVistaColorXsemana = "btn btn-success"
    	@endphp
    @elseif ($botonClicado === '1')
    	@php
    		$tipoVistaColorXdia = "btn btn-success"
    	@endphp
    @else
    	@php
    		$tipoVistaColorXmes = "btn btn-success"
    	@endphp
	@endif
	<form action="{{ action('App\Http\Controllers\ActoController@index') }}" method="get">
		<button type="submit" name="mostrarVista" value="1"
			class="{{ $tipoVistaColorXdia }}">Vista por dia</button>
		<button type="submit" name="mostrarVista" value="2"
			class="{{ $tipoVistaColorXsemana }}">Vista ultimos siete
			dias</button>
		<button type="submit" name="mostrarVista" value="3"
			class="{{ $tipoVistaColorXmes }}">Vista por mes</button>
	</form>
	<br>
</div>
<div>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">NOMBRE DEL ACTO</th>
				<th scope="col">FECHA DEL ACTO</th>
				<th scope="col">HORA DEL ACTO</th>
				<th scope="col">INSCRITO</th>
				<th scope="col">EVENTO</th>
			</tr>
		</thead>
		<tbody>
	 
@foreach($actos as $acto)
			@php
				$datosBoton = App\Http\Controllers\ActoController::colorButtonInscribirse($acto->Id_acto);
				
			@endphp
			
			<tr>
				<td>{{ $acto->Titulo }}</td>
				<td>{{ $acto->Fecha }}</td>
				<td>{{ $acto->Hora }}</td>
				@if ($datosBoton === null)
                <td><form action="{{ action('App\Http\Controllers\ActoController@inscribirseBorrarse') }}" method="GET">
						<input name="id_acto" type="hidden" value="{{ $acto->Id_acto }}">
						<input name="id_persona" type="hidden" value="{{ session('id_persona') }}">
						<button type="submit" name="inscribirBorrar" value="inscribirse" class="btn btn-primary">Inscribirse</button>
					</form>
				</td>
                @else
                    <td><form action="{{ action('App\Http\Controllers\ActoController@inscribirseBorrarse') }}" method="GET">
						<input name="id_acto" type="hidden" value="{{ $acto->Id_acto }}">
						<input name="id_persona" type="hidden" value="{{ session('id_persona') }}">
						<button type="submit" name="inscribirBorrar" value="borrarse" class="btn btn-warning">Borrarse</button>
					</form>
				</td>
                @endif
				
				<td><form action="{{ action('App\Http\Controllers\ActoController@mostrarEvento') }}" method="GET">
						<input name="id_acto" type="hidden" value="{{ $acto->Id_acto }}">
						<button type="submit" class="btn btn-primary">Ver evento</button>

					</form>
				</td>
			</tr>
		
@endforeach
</tbody>
	</table>
</div> 
</x-layout> <x-layout.footer> </x-layout>