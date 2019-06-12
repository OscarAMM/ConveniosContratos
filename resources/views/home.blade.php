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
            <div class="jumbotron" style="background-color:#0F3558;">
                <h1 style="color:#BF942D">Sistema de Convenios y Contratos</h1>
                <hr style="border:2px solid #BF942D">
                <p class="lead" style="color:white;">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
                <p style="color:white">Nota: El sistema se está dividiendo en dos partes. La primera es de trabajo
                    diario, tomando en cuenta
                    desde la sección "Administración de documentos" hasta "Administración de usuarios".
                    La sección "Finalización" será utilizada cuando todos los documentos estén en orden y firmados. </p>
            </div>
            <h1>Administración de documentos</h1>
            <hr style="border:2px solid #BF942D;">
            <div class="row">

                <div class="col-md-6">
                    <h4>Documentos</h4>
                    <p>Se hace administración de Documentos. Se puede agregar, editar, eliminar y examninar
                        los documentos que se realizan en la jornada diaria.</p>
                    <p><a href="{{route('Agreement.index')}}" class="btn btn-primary">Administrar</a></p>
                </div>
                <div class="col-md-6">
                    <h4>Asignación</h4>
                    <p>Se muestran los contratos y convenios asignados al usuario. ¡No se verán contratos y convenios no
                        asignados! </p>
                    @if(count (Auth::user()->getAgreements))
                    <p><a href="{{route('Revision')}}" class="btn btn-primary">Asignados</a></p>

                    @endif
                </div>
            </div>
            <h1>Administración del sistema</h1>
            <hr style="border:2px solid #BF942D;">
            <div class="row">
                <div class="col-md-6">
                    <h4>Partes</h4>
                    <p>Se realiza la administración de las partes que estarán suscribiendo en a los documentos. Se puede
                        agregar, ver, editar y eliminar las partes según sea el caso.</p>
                    <p><a href="{{route('Person.index')}}" class="btn btn-primary">Administrar</a></p>
                </div>
                <div class="col-md-6">
                    <h4>Instrumentos jurídicos</h4>
                    <p>Se administra los instrumentos jurídicos que serán utilizados. Se puede agregar, ver, editar y
                        eliminar los instrumentos jurídicos. </p>
                    <p><i>Nota: Una vez agregados no se podrá agregar otro con el mismo nombre.</i></p>

                    <p><a href="{{route('LegalInstrument.index')}}" class="btn btn-primary">Administrar</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Registro usuario</h4>
                    <p>Se hace el registro de usuarios. ¡El usuario registrado tendrá acceso como revisor!</p>
                    <p><a href="{{route('admin.index')}}" class="btn btn-primary">Registrar</a></p>
                </div>
                <div class="col-md-6">
                    <h4>Consultar usuario</h4>
                    <p>Se consulta todos los usuarios registrados en el sistema, tanto usuarios revisores como
                        administradores.Se podrá agregar, editar, ver y eliminar los usuarios.</p>
                    <p><i>Nota:Los usuarios registrados serán los que tengan acceso al sistema. Existe solo un
                            admin.</i></p>
                    <p><a href="{{route('users.index')}}" class="btn btn-primary">Consultar</a></p>
                </div>
            </div>
            <h1>Finalización</h1>
            <hr style="border:2px solid #BF942D;">
            <div class="row">
                <div class="col-md-6">
                    <h4>Reporte</h4>
                    <p>El sistema recupera los documentos almacenados y se podrá realizar los reportes correspondientes
                        según la fecha especificada.</p>
                    <p><a href="{{route('Index')}}" class="btn btn-primary">Reporte</a></p>
                </div>
                <div class="col-md-6">
                    <h4>Registro</h4>
                    <p>Se podrá administrar los documentos que podrán ser o no vistos para el público en general o en
                        caso de solicitudes.
                        Se podrá agregar, editar, ver y eliminar los documentos.
                    </p>
                    <p><i>Nota: estos documentos finales son aquellos que son autorizados y firmados por todas las
                            partes. </i></p>
                    <p><a href="{{route('FinalRegister.index')}}" class="btn btn-primary">Registro</a></p>
                </div>
            </div>
            <!-- Fin ADMINS-->
            @elseif(Auth::user()->hasRole('revisor'))
            <div class="jumbotron" style="background-color:#0F3558;">
                <h1 style="color:#BF942D">Sistema de Convenios y Contratos</h1>
                <hr style="border:2px solid #BF942D">
                <p class="lead" style="color:white;">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
                <p style="color:white">Nota: El sistema se está dividiendo en dos partes. La primera es de trabajo
                    diario, tomando en cuenta
                    desde la sección "Administración de documentos" hasta "Administración de usuarios".
                    La sección "Finalización" será utilizada cuando todos los documentos estén en orden y firmados. </p>
            </div>
            <h1>Administración de documentos</h1>
            <hr style="border:2px solid #BF942D;">
            <div class="row">
                <div class="col-md-6">
                    <h4>Documentos</h4>
                    <p>Se hace administración de Documentos. Se puede agregar, editar, eliminar y examninar
                        los documentos que se realizan en la jornada diaria.</p>
                    <p><a href="{{route('Agreement.index')}}" class="btn btn-primary">Administrar</a></p>
                </div>
                <div class="col-md-6">
                    <h4>Mis Documentos</h4>
                    <p>Se hace administración de Documentos. Se puede agregar, editar, eliminar y examninar
                        los documentos que se realizan en la jornada diaria.</p>
                    <p><a href="{{route('Agreement.index2')}}" class="btn btn-primary">Administrar</a></p>
                </div>
                <div class="col-md-6">
                    <h4>Asignación</h4>
                    <p>Se muestran los contratos y convenios asignados al usuario. ¡No se verán contratos y convenios no
                        asignados! </p>
                    @if(count (Auth::user()->getAgreements))
                    <p><a href="{{route('Revision')}}" class="btn btn-primary">Asignados</a></p>

                    @endif
                </div>
            </div>
            <h1>Finalización</h1>
            <hr style="border:2px solid #BF942D;">
            <div class="row">
                <div class="col-md-6">
                    <h4>Registro</h4>
                    <p>Se realiza el registro final que contará con todo lo solicitado para almacenar en el sistema.
                    </p>
                    <p><a href="{{route('FinalRegister.index')}}" class="btn btn-primary">Registro</a></p>
                </div>
            </div>
            <!------------------------------------ USUARIO EMPIEZA AQUÍ------------------------------------------------------------------------->
            @elseif(Auth::user()->hasRole('user'))
            <!--{{(Auth::user()->name)}}-->
            <div class="container">
                <div class="jumbotron" style="background-color:#0F3558;">
                    <h1 style="color:#BF942D">Sistema de Convenios y Contratos</h1>
                    <hr style="border:2px solid #BF942D">
                    <p class="lead" style="color:white;">¡Bienvenido a SICC {{Auth::user()->name}}!</p>
                    <p style="color:white">En SICC podrás hacer la consulta de los documentos asignados y los
                        publicados. </p>
                </div>
                <h1>Vistas Públicas</h1>
                <hr style="border:2px solid #BF942D;">
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
                <h4>Asignados</h4>
                <hr style="border:2px solid #BF942D;">
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