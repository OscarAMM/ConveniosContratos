@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css\proyect.css')}}">
    <title>SICC</title>
</head>

<body>
    <div class="gradient">
        <img src="{{asset('images\Edificio_Central.jpg')}}" alt="Edificio-Central">
    </div>

    <div class="container">


        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if(Auth::user()->hasRole('admin'))
        <!-- INICIO DE CATALOGOS -->
        <!-- Inicio CONTRATO-->

        <div class="card">
            <div class="card-header text-muted text-center">
                <h4>Convenio - Contrato</h4>
            </div>
            <div class="card-body">
<<<<<<< HEAD
                
                <p class="card-text">Se administran los convenios y contratos permitiendo agregar, editar, observar y eliminar lo
                    registrado.</p>
                <a href="{{route('Contract.index')}}" class="btn btn-primary">Contratos</a>
                <a href="{{route('Agreement.index')}}" class="btn btn-primary">Convenios</a>
                @if(count (Auth::user()->getContracts))
                <a href="{{route('Revision')}}" class="btn btn-primary">Asignados</a>
=======
                <p class="text">Se realiza una administración de contratos y convenios.
                    En este apartado podrás agregar, editar, eliminar, observar y dar revisión de los contratos y
                    convenios que se agreguen al sistema.
                </p>
                <a href="{{route('Contract.index')}}" class="btn boton">Contratos</a>
                <a href="{{route('Agreement.index')}}" class="btn boton">Convenios</a>
                @if(count (Auth::user()->getContracts))
                <a href="{{route('Revision')}}" class="btn boton">Asignados</a>
>>>>>>> eddacda327fe351663e14aa11343ad4bc52bf000
                @endif
            </div>

        </div>

        <br>
        <!-- Fin Contrato-->

        <!--Inicio INST/DEP-->

        <div class="card">
            <div class="card-header text-muted text-center">
                <h4>Institución - Dependencia</h4>
            </div>
            <div class="card-body">
                <p class="text">Se administran instituciones y dependendencias permitiendo agregar, editar,
                    eliminar y observar lo registrado.</p>
                <a href="{{route('Institute.index')}}" class="btn boton">Instituciones</a>
                <a href="{{route('Dependence.index')}}" class="btn boton">Dependencias</a>
            </div>
        </div>

        <br>
        <!--FIN INST/DEP-->
        <!--REGISTRO ADMINISTRADORES-->
        <!--Inicio ADMINS-->

        <div class="card ">
            <div class="card-header text-muted text-center">
                <h4>Usuarios</h4>
            </div>
            <div class="card-body">
                <p class="text">Se administran usuarios y administradores permitiendo agregar, editar, eliminar
                    y
                    observar lo registrado.</p>
                <a href="{{route('admin.index')}}" class="btn boton">Registrar</a>
                <a href="{{route('users.index')}}" class="btn boton">Consultar</a>
                <a href="{{route('mail.index')}}" class="btn boton">Enviar Correo</a>
            </div>

        </div>


        <!-- Fin ADMINS-->
        @else
        <!--{{(Auth::user()->name)}}-->

        <div class="card text-center ">
            <div class="card-header text-muted">
                VISTAS PÚBLICAS
            </div>
            <div class="card-body">
                <h5 class="card-title">VISTAS PÚBLICAS</h5>
                <p class="card-text">Se despliega todos los convenios que se tiene firmado entre la UADY y otra
                    dependencia.</p>

                <a href="#" class="btn btn-primary">CONSULTAR</a>
            </div>

        </div>
    </div>

    @endif
</body>
</html>
@endsection
