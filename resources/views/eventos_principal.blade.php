<x-layout.header>
<div>Identificate...</div>
<div>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">NOMBRE DEL ACTO</th>
				<th scope="col">FECHA DEL ACTO</th>
				<th scope="col">HORA DEL ACTO</th>
				@auth
					<th scope="col">INSCRITO</th>
				@endauth
				<th scope="col">EVENTO</th>
			</tr>
		</thead>
		<tbody>
	 
@foreach($actos as $acto)
			
			<tr>
				<td>{{ $acto->Titulo }}</td>
				<td>{{ $acto->Fecha }}</td>
				<td>{{ $acto->Hora }}</td>
				@auth
    				@php
    					$datosBoton = App\Http\Controllers\ActoController::colorButtonInscribirse($acto->Id_acto);
    				@endphp
    				@if ($datosBoton === null)
                		<td>NO</td>
                	@else
                    	<td>SI</td>
                    @endif
                @endauth
				<td><form action="{{ action('App\Http\Controllers\ActoController@mostrarEvento') }}" method="POST">
						@csrf
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