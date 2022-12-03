<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Eventos</title>
</head>
<body>
    <div class="bd-example m-5">
        <div class= "d-flex justify-content-center bd-highlight mb-3">
            <div class="card p-5">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    @error('incorrect')
                    <p style="text-align: center; text-color: red">{{ $message }}</p>
                    <br>
                    @enderror
                    Usuario: <input class="form-control" type="text" name="name" id="name" required>
                    <br>
                    Contraseña: <input class="form-control" type="password" name="password" id="password" required>
                    <br>
                    <br>
                    <input type="checkbox" name="recuerdame"><span class= "m-2">Recordarme</span>
                    <br>
                    <br>
                    <input type="submit" class="btn btn-primary col-md-6 offset-md-3" value="Entrar">
                    
                </form>
            </div>
        </div>
        <div class= "d-flex justify-content-center bd-highlight m-5">
            <div class="card p-5">
                <p>¿No estas registrado?</p>
                <button class="btn btn-info" onclick="window.location='{{ route("usuario.create") }}'" >Registrarse</button>
            </div>
        </div>
    </div>
<x-layout.footer></x-layout>