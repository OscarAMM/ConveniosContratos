@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    @if(Auth::user()->hasRole('admin'))
    <!-- <div class="blockquote">{{(Auth::user()->name)}}
        <h6>Administrador</h6>
    </div> -->
    
    <!-- INICIO DE CATALOGOS --> 
    <!-- Inicio CONTRATO-->
    <div>
        <div class="card text-center">
            <div class="card-header text-muted">
               <h4>Convenio - Contrato</h4> 
            </div>
            <div class="card-body">
                
                <p class="card-text">Se administran los convenios y contratos permitiendo agregar, editar, observar y eliminar lo
                    registrado.</p>
<<<<<<< HEAD
                <a href="{{route('Contract.index')}}" class="btn btn-primary">CONTRATOS</a>
                <a href="{{route('Agreement.index')}}" class="btn btn-primary">CONVENIOS</a>
                @if(count (Auth::user()->getContracts) || count (Auth::user()->getAgreements))
                <a href="{{route('Revision')}}" class="btn btn-primary">ASIGNADOS</a>
=======
                <a href="{{route('Contract.index')}}" class="btn btn-primary">Contratos</a>
                <a href="{{route('Agreement.index')}}" class="btn btn-primary">Convenios</a>
                @if(count (Auth::user()->getContracts))
                <a href="{{route('Revision')}}" class="btn btn-primary">Asignados</a>
>>>>>>> a171883a5206cb8647a6bb0cf907d81add3386b4
                @endif
            </div>

        </div>
    </div>
    <br>
    <!-- Fin Contrato-->
    <!--INSTITUCION/DEPENDENCIA-->
    <!--Inicio INST/DEP-->
    <div>
        <div class="card text-center ">
            <div class="card-header text-muted">
               <h4>Institución - Dependencia</h4> 
            </div>
            <div class="card-body text-center">
         
                <p class="card-text">Se administran instituciones y dependendencias permitiendo agregar, editar,
                    eliminar y observar lo registrado.</p>
                <a href="{{route('Institute.index')}}" class="btn btn-primary">Instituciones</a>
                <a href="{{route('Dependence.index')}}" class="btn btn-primary">Dependencias</a>
            </div>
        </div>
    </div>
    <br>
    <!--FIN INST/DEP-->
    <!--REGISTRO ADMINISTRADORES-->
    <!--Inicio ADMINS-->
    <div>
        <div class="card text-center ">
            <div class="card-header text-muted">
                <h4>Usuarios</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Se administran usuarios y administradores permitiendo agregar, editar, eliminar y
                    observar lo registrado.</p>
                <a href="{{route('admin.index')}}" class="btn btn-primary">Registrar</a>
                <a href="{{route('users.index')}}" class="btn btn-primary">Consultar</a>
                <a href="{{route('mail.index')}}" class="btn btn-primary">Enviar Correo</a>
            </div>

        </div>
    </div>

    <!-- Fin ADMINS-->
    @else
    <!--{{(Auth::user()->name)}}-->
    <div>
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
    @endsection