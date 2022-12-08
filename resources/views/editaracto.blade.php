<x-layout.header>

<h2 style="text-align: center">Crear acto</h2>
<div class="bd-example m-5">
    <div class= "d-flex justify-content-center bd-highlight mb-3">
        <div class="card p-5">
            <form action="crearacto" method="POST">
                @csrf
                <label for="fecha">Fecha</label>
                <input class="form-control" type="date" name="fecha" id="fecha" required>
                <br>
                <label for="hora">Hora</label>
                <input class="form-control" type="time" name="hora" id="hora" required>
                <br>
                <label for="titulo">Titulo</label>
                <input class="form-control" type="text" name="titulo" id="titulo" required>
                <br>
                <label for="descripcionc">Descripcion corta</label>
                <input class="form-control" type="text" name="descripcionc" id="descricionc" required>
                <br>
                <label for="descripcionl">Descripcion larga</label>
                <input class="form-control" type="text" name="descripcionl" id="descripcionl" required>
                <br>
                <label for="nasistentes">Numero asistentes</label>
                <input class="form-control" type="number" name="nasistentes" id="nasistentes" required>
                <br>
                <label for="tipo_acto">Tipo acto</label>
                <select class="form-control" name="tipo_acto" required>
                    @php
                        $tipos= DB::table('Tipo_acto')->get();
                    @endphp
                    @foreach ($tipos as $tipo)
                        <option value='{{ $tipo->Id_tipo_acto }}'>{{ $tipo->Descripcion }}</option>
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