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
	@endforeach
	<tr>
    	<td>
    	<form action="{{ action('App\Http\Controllers\ActoController@index') }}" method="GET">
    		@csrf 
           <button type="submit" name="mostrarEvento" class="btn btn-primary">Volver a eventos</button>
        </form>
        <br>
        <form action="{{ action('App\Http\Controllers\ActoController@doLogin') }}" method="POST"> 
        	@csrf
           <button type="submit" name="Inscribirse" class="btn btn-success">Inscribirse</button>
        </form>
        </td
    </tr>
</table>
</div>
</x-layout> 
<x-layout.footer> 
</x-layout>