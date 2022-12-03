<x-layout.header>
@foreach($personas as $persona)
    <p>{{ $persona->Id_persona }}</p>
    <br>
    <p>{{ $persona->Nombre }}</p>
    <br>
    <p>{{ $persona->Apellido1 }}</p>
    <br>
    <p>{{ $persona->Apellido2 }}</p>
    <br>
@endforeach
</x-layout>
<x-layout.footer></x-layout>
