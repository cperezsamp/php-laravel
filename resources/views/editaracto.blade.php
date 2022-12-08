<x-layout.header>

<h2 style="text-align: center">Editar acto</h2>
<div class="bd-example m-5">
    <div class= "d-flex justify-content-center bd-highlight mb-3">
        <div class="card p-5">
            <form action="crearacto" method="POST">
                @csrf
                <label for="fecha">Fecha: {{ $acto->Fecha }}</label>
                <input class="form-control" type="date" name="fecha" id="fecha" required placeholder="{{ $acto->Fecha }}">
                <br>
                <label for="hora">Hora: {{ $acto->Hora }}</label>
                <input class="form-control" type="time" name="hora" id="hora" required placeholder="{{ $acto->Hora }}">
                <br>
                <label for="titulo">Titulo</label>
                <input class="form-control" type="text" name="titulo" id="titulo" required placeholder="{{ $acto->Titulo }}">
                <br>
                <label for="descripcionc">Descripcion corta</label>
                <input class="form-control" type="text" name="descripcionc" id="descricionc" required placeholder="{{ $acto->Descripcion_corta }}">
                <br>
                <label for="descripcionl">Descripcion larga</label>
                <input class="form-control" type="text" name="descripcionl" id="descripcionl" required placeholder="{{ $acto->Descripcion_larga }}">
                <br>
                <label for="nasistentes">Numero asistentes</label>
                <input class="form-control" type="number" name="nasistentes" id="nasistentes" required placeholder="{{ $acto->Num_asistentes }}">
                <br>
                <label for="tipo_acto">Tipo acto</label>
                <select class="form-control" name="tipo_acto" required>
                    @php
                        $tipos= DB::table('Tipo_acto')->get();
                    @endphp
                    @foreach ($tipos as $tipo)
                        <option value='{{ $tipo->Id_tipo_acto }}' @if($acto->Id_tipo_acto == $tipo->Id_tipo_acto) selected="true" @endif>{{ $tipo->Descripcion }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <p><input class="btn btn-primary col-md-6 offset-md-3" type="submit" value="Crear"></p>
            </form>
        </div>
    </div>
</div>

</x-layout>
<x-layout.footer></x-layout>