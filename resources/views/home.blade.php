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
                <h1>Sistema de Convenios y Contratos</h1>
                <p class="lead">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
                <p>Nota: El sistema se está dividiendo en dos partes. La primera es de trabajo diario, tomando en cuenta
                    desde la sección "Administración de documentos" hasta "Administración de usuarios".
                    La sección "Finalización" será utilizada cuando todos los documentos estén en orden y firmados. </p>
            </div>
            <h2>Administración de documentos</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">

                <div class="col-lg-6">
                    <h3>Documentos</h3>
                    <p>Se hace administración de Documentos. Se puede agregar, editar, eliminar y examninar
                        los documentos que se realizan en la jornada diaria.</p>
                    <p><a href="{{route('Agreement.index')}}" class="btn boton">Administrar</a></p>
                </div>
                <div class="col-lg-6">
                    <h3>Asignación</h3>
                    <p>Se muestran los contratos y convenios asignados al usuario. ¡No se verán contratos y convenios no
                        asignados! </p>
                    @if(count (Auth::user()->getAgreements))
                    <p><a href="{{route('Revision')}}" class="btn boton">Asignados</a></p>

                    @endif
                </div>
            </div>
            <h2>Altas en el sistema</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Suscritos</h3>
                    <p>Se hace la administración de instituciones, dependencias y personas. Se puede agregar, editar,
                        eliminar y examinar
                        los que suscriben.</p>
                    <p><a href="{{route('Person.index')}}" class="btn boton">Administrar</a></p>
                </div>
                <div class="col-lg-6">
                    <h3>Instrumentos jurídicos</h3>
                    <p>Instrumentos jurídicos... [Descripción pendiente]</p>

                    <p><a href="{{route('LegalInstrument.index')}}" class="btn boton">Administrar</a></p>
                </div>
            </div>
            <h2>Administración de usuarios</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Registro usuario</h3>
                    <p>Se hace el registro de usuarios. ¡El usuario registrado tendrá acceso como revisor!</p>
                    <p><a href="{{route('admin.index')}}" class="btn boton">Registrar</a></p>
                </div>
                <div class="col-lg-6">
                    <h3>Consultar usuario</h3>
                    <p>Se consulta todos los usuarios registrados en el sistema, tanto usuarios normales como
                        administradores.</p>
                    <p><a href="{{route('users.index')}}" class="btn boton">Consultar</a></p>
                </div>
            </div>
            <h2>Finalización</h2>
            <hr style="border:1px solid #0F3558;">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Reporte</h3>
                    <p>El sistema arrojará los reportes correspondientes según la fecha especificada.</p>
                    <p><a href="{{route('PrePDF')}}" class="btn boton">Reporte</a></p>
                </div>
                <div class="col-lg-6">
                    <h3>Registro</h3>
                    <p>Se realiza el registro final que contará con todo lo solicitado para almacenar en el sistema.
                    </p>
                    <p><a href="{{route('Register',1)}}" class="btn boton">Registro</a></p>
                </div>
            </div>
            <!-- Fin ADMINS-->
            @elseif(Auth::user()->hasRole('revisor'))
            <div class="container">
                <div class="jumbotron">
                    <h1>Sistema de Convenios y Contratos</h1>
                    <p class="lead">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
                    <p>Nota: El sistema se está dividiendo en dos partes. La primera es de trabajo diario, tomando en
                        cuenta
                        desde la sección "Administración de documentos" hasta "Administración de usuarios".
                        La sección "Finalización" será utilizada cuando todos los documentos estén en orden y firmados.
                    </p>
                </div>
                <h2>Administración de documentos</h2>
                <hr style="border:1px solid #0F3558;">
                <div class="row">
                    <div class="col-lg-4">
                        <h3>Documentos</h3>
                        <p>Se hace administración de Documentos. Se puede agregar, editar, eliminar y examninar
                            los documentos que se realizan en la jornada diaria.</p>
                        <p><a href="{{route('Agreement.index')}}" class="btn boton">Administrar</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h3>Asignación</h3>
                        <p>Se muestran los contratos y convenios asignados al usuario. ¡No se verán contratos y
                            convenios no
                            asignados! </p>
                        <p> @if(count (Auth::user()->getAgreements))
                            <a href="{{route('Revision')}}" class="btn boton">Asignados</a>
                            @endif</p>
                    </div>
                </div>
                <h2>Finalización</h2>
                <hr style="border:1px solid #0F3558;">
                <div class="row">
                    <div class="col-lg-4">
                        <h3>Reporte</h3>
                        <p>El sistema arrojará los reportes correspondientes según la fecha especificada.</p>
                        <p><a href="{{route('PrePDF')}}" class="btn boton">Reporte</a></p>
                    </div>
                </div>
                <!------------------------------------ USUARIO EMPIEZA AQUÍ------------------------------------------------------------------------->
                @elseif(Auth::user()->hasRole('user'))
                <!--{{(Auth::user()->name)}}-->
                <div class="container">
                    <div class="jumbotron">
                        <h1>Sistema de Convenio y Contrato</h1>
                        <p class="lead">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
                        <p>Bienvenido al sistema. Aquí podrás encontrar el documento asignado para revisión.</p>
                    </div>
                    <h2>Vistas Públicas</h2>
                    <hr style="border:1px solid #0F3558;">
                    <div class="row">
                        <div class="col">
                            <p class="card-text">Se despliega todos los convenios que se tiene firmado entre la UADY y
                                otra
                                dependencia.</p>
                            <p>
                                <a href="{{route('public.index')}}" class="btn boton">Consultar</a>
                            </p>

                        </div>
                    </div>
                    @if(count (Auth::user()->getAgreements))
                    <h2>Asignados</h2>
                    <hr style="border:1px solid #0F3558;">
                    <div class="row">
                        <div class="col">
                            <p class="text">Se realiza una administración de contratos y convenios.
                                En este apartado podrás dar revisión de los contratos y
                                convenios que se agreguen al sistema.
                            </p>
                            <p><a href="{{route('UserRevision')}}" class="btn boton">Asignados</a></p>

                        </div>
                    </div>
                    @endif
                </div>
                @endif
</body>

</html>
@endsection