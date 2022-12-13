@extends("layout.layout")

@section("content")

<tr>

    <td>Titulo del acto -> {{$acto->Titulo}} </td>
</tr>
<br/>
                       
<tr>
    <td>Fecha del acto -> {{ $acto->Fecha }}</td>
</tr>
<br/>
<tr>
    <td>Hora del Acto ->  {{ $acto->Hora }}</td>
</tr>
<br/>
<tr>
    <td>Descripcion -> {{$acto->Descripcion_larga }}</td>
</tr>
<br/>
<tr>
    <td>Numero de asistentes -> {{$acto->Num_asistentes}}</td>
</tr>
<br/>
<tr>

    <td>Nombre ponente ->  {{ $acto->nombre . ' ' . $acto->apellido1 . ' ' . $acto->apellido2 }}</td>

</tr>
<br/>
<tr>
    <td>
        <a href="{{ URL('ponente') }}"> 
            
            <button type="submit" name="mostrarEvento"  class="btn btn-primary">Volver a eventos</button>
         
        </a>
    </td>
</tr>

@endsection