
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <style>
            html, body {
                background-color: #c79316;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        
        <div>@section('header')</div>
        @show
        
        <div class="content flex-center">
            
            <form action="{{url('/registro_usuario')}}" method="post">
            <h1>Registro Usuarios</h1>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">Nombres</label>
      <input type="name" class="form-control" id="inputName" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="inputApellidoPaterno">Apellido Paterno</label>
      <input type="apellidoPaterno" class="form-control" id="inputApellidoPaterno" placeholder="Apellido Materno">
    </div>
    <div class="form-group col-md-6">
      <label for="inputApellidoMaterno">Apellido Materno</label>
      <input type="apellidoMaterno" class="form-control" id="inputApellidoMaterno" placeholder="Apellido Materno">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputArea">Área Perteneciente</label>
      <input type="area" class="form-control" id="inputArea" placeholder="Área Perteneciente">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Contraseña">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Tipo</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
                

                
            
        </div>
        <div>@include('footer')</div>
    </body>
</html>
