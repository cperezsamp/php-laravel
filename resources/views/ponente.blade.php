<!-- Esto devuelve el user name correctamente 
{{ auth()->user()->name }} 
-->
@if (session('rol') == 'Usuario')
    <script>window.location = "/usuario";</script>
@endif
{{ session('rol') }}

Eres ponente