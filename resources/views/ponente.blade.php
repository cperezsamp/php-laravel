<x-layout.header> 
@if (session('rol') == 'Usuario')
<script>window.location = "/usuario";</script>
@endif

    <div align="center">
        <form action="{{ URL('/hanldeButton') }}" method="post">
            @csrf()
            <button type="submit" name="mostrarVista" value="1" class="{{ $tipoVistaColorXdia}}">Vista por dia</button>
            <button type="submit" name="mostrarVista" value="2" class="{{ $tipoVistaColorXsemana}}">Vista ultimos siete dias</button>
            <button type="submit" name="mostrarVista" value="3" class="{{ $tipoVistaColorXmes}}">Vista por mes</button>
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
                    <th scope="col">ERES PONENTE</th>
                    <th scope="col">PONENTE</th>    
                    <th scope="col">INSCRITO</th>
                    <th scope="col">EVENTO</th>
                </tr>
            </thead>
            <tbody>

                @forelse($data as $acto)
                    
                    <tr>
                        <td>{{ $acto->Titulo}}</td>
                        <td>{{ $acto->Fecha}}</td>
                        <td>{{ $acto->Hora}}</td>
                        <td>{{ $acto->esPonente}}</td>
                        <td>
                            <form action="{{ URL('removeSpeaker') }}" method="POST">
                                @csrf()
                                <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}">
                                <button type="submit" name="esPonente" value="{{ $acto->valueBotonPonente}}"  class="{{ $acto->colorBotonPonente}}">
                                    {{$acto->nombreBotonPonente}}
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ URL('removeSpeaker') }}" method="POST">
                                @csrf()
                                <input name="id_acto" type="hidden" value="{{$acto->Id_acto}}"/>
                                <button type="submit" name="inscribirBorrar" value="{{$acto->valueBoton}}" class="{{$acto->colorBoton}}">
                                    {{ $acto->nombreBoton }}</button>
                            </form>
                        </td>
                        <td>
                            <form  action="{{ URL('event_detail') }}" method="post">
                                    @csrf()
                                    <input name="id_acto" type="hidden" value="{{ $acto->Id_acto}}">
                                    <button type="submit" class="btn btn-primary">Ver evento</button>
                                             
                            </form>
                        </td>
                    </tr>
               @empty
                    <tr>
                        <td colspan="4">Data not Found!</td>
                    </tr>
               @endforelse
            </tbody>
        </table>
    </div>

</x-layout.header> 
<x-layout.footer></x-layout.footer>