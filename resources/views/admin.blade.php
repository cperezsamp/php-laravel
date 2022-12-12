@if (session('rol') == 'Ponente')
<script>window.location = "/ponente";</script>
@endif
@if (session('rol') == 'Usuario')
<script>window.location = "/usuario";</script>
@endif
<x-layout.header> 
Bienvenido {{ session('username') }}

<div text-align="center">
	<button class="btn btn-primary" name="crearActo" onclick="window.location='{{ route("crearacto") }}'">Crear Acto</button>
	<br>
    <br>
</div>
<div>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">NOMBRE DEL ACTO</th>
				<th scope="col">FECHA DEL ACTO</th>
				<th scope="col">HORA DEL ACTO</th>
				<th scope="col">EDITAR</th>
				<th scope="col">INSCRITOS</th>
			</tr>
		</thead>
		<tbody>
	 
@foreach($actos as $acto)
			                     <tr>
				<td>{{ $acto->Titulo }}</td>
				<td>{{ $acto->Fecha }}</td>
				<td>{{ $acto->Hora }}</td>
                <td><form action="{{ action('App\Http\Controllers\ActoController@edit') }}" method="GET">
						<input name="id_acto" type="hidden" value="{{ $acto->Id_acto }}">
						<button type="submit" class="btn btn-primary">Editar</button>
					</form>
				</td>
				<td><form action="{{ action('App\Http\Controllers\ActoController@inscritos') }}" method="GET">
						<input name="id_acto" type="hidden" value="{{ $acto->Id_acto }}">
						<button type="submit" class="btn btn-primary">Inscritos</button>

					</form>
				</td>
			</tr>
		
@endforeach
</tbody>
	</table>
</div> 
</x-layout> <x-layout.footer> </x-layout>