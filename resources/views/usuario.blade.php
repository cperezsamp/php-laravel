<!-- Esto devuelve el user name correctamente 
{{ auth()->user()->name }} 
-->
@if (session('rol') == 'Ponente')
    <script>window.location = "/ponente";</script>
@endif

{{ session('rol') }}

Eres usuairo