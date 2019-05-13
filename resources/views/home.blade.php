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
        <div class="container">
            <div class="jumbotron">
                <h1>Sistema de Convenio y Contratos</h1>
                <p class="lead">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
            </div>
            <h2>Administración de documentos</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Contratos</h3>
                    <p>Se hace administración únicamente de contratos. Se puede agregar, editar, eliminar y examinar los
                        contratos que se realizan en la jornada diaria.</p>
                    <p> <a href="{{route('Contract.index')}}" class="btn boton">Administrar</a></p>
                </div>
                <div class="col-lg-4">
                    <h3>Convenios</h3>
                    <p>Se hace administración únicamente de Convenios. Se puede agregar, editar, eliminar y examninar
                        los convenios que se realizan en la jornada diaria.</p>
                    <p><a href="{{route('Agreement.index')}}" class="btn boton">Administrar</a></p>
                </div>
                <div class="col-lg-4">
                    <h3>Asignación</h3>
                    <p>Se muestran los contratos y convenios asignados al usuario. ¡No se verán contratos y convenios no
                        asignados! </p>
                    <p> @if(count (Auth::user()->getContracts)||count (Auth::user()->getAgreements))
                        <a href="{{route('Revision')}}" class="btn boton">Asignados</a>
                        @endif</p>
                </div>
            </div>
            <h2>Altas en el sistema</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Institución</h3>
                    <p>Se hace la administración únicamente de instituciones. Se puede agregar, editar, eliminar y
                        examinar las instituciones que suscriben.</p>
                    <p><a href="{{route('Institute.index')}}" class="btn boton">Administrar</a></p>
                </div>
                <div class="col-lg-4">
                    <h3>Dependencia</h3>
                    <p>Se hace la administración únicamente de dependencia. Se puede agregar, editar, eliminar y
                        examinar las dependencias que suscriben.</p>
                    <p><a href="{{route('Dependence.index')}}" class="btn boton">Administrar</a></p>
                </div>
                <div class="col-lg-4">
                    <h3>Persona</h3>
                    <p>Se hace la administración únicamente de personas. Se puede agregar, editar, eliminar y examinar
                        las personas que suscriben.</p>
                    <p><a href="{{route('Person.index')}}" class="btn boton">Administrar</a></p>
                </div>
            </div>
            <h2>Administración de usuarios</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Registro usuario</h3>
                    <p>Se hace el registro de usuarios. ¡El usuario registrado tendrá acceso como administrador!</p>
                    <p><a href="{{route('admin.index')}}" class="btn boton">Registrar</a></p>
                </div>
                <div class="col-lg-4">
                <h3>Consultar usuario</h3>
                <p>Se consulta todos los usuarios registrados en el sistema, tanto usuarios normales como administradores.</p>
                <p><a href="{{route('users.index')}}" class="btn boton">Consultar</a></p>
                </div>
                <div class="col-lg-4">
                <h3>Correo</h3>
                <p>El sistema cuenta un apartado de correo donde se podrá mandar correo a la persona deseada.</p>
                <p><a href="{{route('mail.index')}}" class="btn boton">Enviar Correo</a></p>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header text-muted text-center">
                <h4>Convenio - Contrato</h4>
            </div>
            <div class="card-body">
                <p class="text">Se administra <strong>Convenios</strong> y <strong>Contratos</strong>.En este aparatado
                    se puede agregar, editar y eliminar, además de poder consultar los asignados a cada responsable del
                    departamento.
                </p>
                <a href="{{route('Contract.index')}}" class="btn boton">Contratos</a>
                <a href="{{route('Agreement.index')}}" class="btn boton">Convenios</a>
                @if(count (Auth::user()->getContracts)||count (Auth::user()->getAgreements))
                <a href="{{route('Revision')}}" class="btn boton">Asignados</a>
                @endif
                <a href="{{route('PrePDF')}}" class="btn boton">Reporte</a>
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

        <div class="card">
            <div class="card-header text-muted  text-center ">
                <h4>Vistas públicas</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Se despliega todos los convenios que se tiene firmado entre la UADY y otra
                    dependencia.</p>
                <a href="{{route('public.index')}}" class="btn boton">Consultar</a>
            </div>
        </div>
        <br>
        @if(count (Auth::user()->getContracts)||count (Auth::user()->getAgreements))
        <div class="card">
            <div class="card-header text-muted text-center">
                <h4>Convenio-Contrato asignado</h4>
            </div>
            <div class="card-body">
                <p class="text">Se realiza una administración de contratos y convenios.
                    En este apartado podrás dar revisión de los contratos y
                    convenios que se agreguen al sistema.
                </p>
                <a href="{{route('UserRevision')}}" class="btn boton">Asignados</a>
            </div>
        </div>
        @endif
    </div>

    @endif

</body>

</html>
@endsection