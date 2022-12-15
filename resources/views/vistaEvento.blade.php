@if (session('rol') == 'Ponente')
<script>window.location = "/ponente";</script>
@endif
<x-layout.header>
<div align="center">
<table class="table">
	@foreach($acto as $a)
    	<tr><td>Numero de evento -> {{ $a->Id_acto }}</td></tr>
    	<tr><td>Fecha del evento -> {{ $a->Fecha }}</td></tr>
    	<tr><td>Hora del evento -> {{ $a->Hora }}</td></tr>
    	<tr><td>Titulo del evento -> {{ $a->Titulo }}</td></tr>
    	<tr><td>Descripcion corta del evento -> {{ $a->Descripcion_corta }}</td></tr>
    	<tr><td>Descripcion larga del evento -> {{ $a->Descripcion_larga }}</td></tr>
    	<tr><td>Numero de asistentes del evento -> {{ $a->Num_asistentes }}</td></tr>
    	<!-- <tr><td>id persona -> {{ session('id_persona') }}</td></tr> -->
	@endforeach
	<tr>
    	<td>
    	<form action="{{ action('App\Http\Controllers\ActoController@index') }}" method="GET">
    		@csrf 
           <button type="submit" name="mostrarEvento" class="btn btn-primary">Volver a eventos</button>
        </form>
        <br>
        
        	
        	@auth
        	@php
				$datosBoton = App\Http\Controllers\ActoController::colorButtonInscribirse($a->Id_acto);
			@endphp
			@if ($datosBoton === null)
        		<form action="{{ action('App\Http\Controllers\ActoController@inscribirseBorrarse') }}" method="POST">
        			@csrf
            		<input name="id_acto" type="hidden" value="{{ $a->Id_acto }}">
    				<input name="id_persona" type="hidden" value="{{ session('id_persona') }}">
    				<button type="submit" name="inscribirBorrar" value="inscribirse" class="btn btn-primary">Inscribirse</button>
				</form>
           @else
           		<form action="{{ action('App\Http\Controllers\ActoController@inscribirseBorrarse') }}" method="POST">
        			@csrf
					<input name="id_acto" type="hidden" value="{{ $a->Id_acto }}">
					<input name="id_persona" type="hidden" value="{{ session('id_persona') }}">
					<button type="submit" name="inscribirBorrar" value="borrarse" class="btn btn-warning">Borrarse</button>
           		</form>
           @endif
           @endauth
           @guest
           <form action="{{ action('App\Http\Controllers\ActoController@doLogin') }}" method="GET">
           @csrf 
           <button type="submit" name="logearse" class="btn btn-success">Logearse</button>
           </form>
           @endguest
        </form>
        </td
    </tr>
</table>
</div>
</x-layout> 
<x-layout.footer> 
</x-layout>