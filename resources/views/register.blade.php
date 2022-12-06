<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <div class="bd-example m-5">
        <div class= "d-flex justify-content-center bd-highlight mb-3">
            <div class="card p-5">
                <form action="{{ route('usuario.create') }}" method="POST">
                    @csrf
                    <label for="nombre" >Nombre:</label>
                    <input class="form-control" type='text' name='nombre' id='nombre' required>
                    </br>
                    <label for="apellido">Apellido:</label>
                    <input class="form-control" type='text' name='apellido' id='apellido' required>
                    </br>
                    <label for="apellido2">Apellido2:</label>
                    <input class="form-control" type='text' name='apellido2' id='apellido2' required>
                    </br>
                    <label for="passoword">Password:</label>
                    <input class="form-control" type='password' name='password' id='password' required>
                    </br>
                    <label for="rol">Rol:</label>
                    <select class="form-control" name="role">
                        <option value="2">Usuario</option>
                        <option value="3">Ponente</option>
                    </select>
                    </br>
                    <p><input class="btn btn-primary col-md-6 offset-md-3" type="submit" value="Resgistrarse"></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>