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
    <div class="container">
        
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ URL('/ponente')}}">Ponente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL('logout') }}">Cerrar sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL('user-profile') }}">{{session("username")}}</a>
          </li>
        </ul>

            @if(!empty(session("msg")))

                <p class="alert alert-info">{{session("msg")}}</p>

            @endif  

            @section("content")
            @show


            <footer class="text-center fixed-bottom container" style="background-color:#343a40;padding:10px;color:white">
                UOC 2022
            </footer>
    </div>
</body>
</html>