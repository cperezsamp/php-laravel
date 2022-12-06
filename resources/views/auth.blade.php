<!-- Esto devuelve el user name correctamente 
{{ auth()->user()->name }} 
-->
@if (session('rol') == 'Ponente')
    <script>window.location = "/ponente";</script>
@endif

@if (session('rol') == 'Usuario')
    <script>window.location = "/usuario";</script>
@endif
{{ session('rol') }}

Eres administrador