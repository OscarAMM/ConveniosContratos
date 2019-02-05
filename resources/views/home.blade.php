@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h3>CATALOGO</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    @if(Auth::user()->hasRole('admin'))
                        <div class = "blockquote">{{(Auth::user()->name)}}
                        <p class= "text-muted">Administrador Maestro</p> </div>
                        <!-- INICIO DE CATALOGOS -->
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">CONVENIO</h5>
                            <p class="card-text">Se administra los Convenios</p>
                            <a href="#" class="btn btn-primary">IR CONVENIO</a>
                         </div>
                         </div>
                         </div>
                         <!--CONTRATO-->
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">CONTRATO</h5>
                            <p class="card-text">Se administra los Contratos</p>
                            <a href="#" class="btn btn-primary">IR CONTRATO</a>
                         </div>
                         </div>
                         </div>
                        </div>
                        <!--INSTITUCION/DEPENDENCIA-->
                        <div class= "row">
                        <div class = "col-sm-6">
                        <div class= "card mb-3">
                        <div class="card-body">
                            <h5 class= "card-title">INSTITUCION/DEPENDENCIA</h5>
                            <p class="card-text">Se administran las Instituciones & Dependencias</p>
                            <a href="{{action('InstituteController@index')}}"class="btn btn-primary">IR A DEPENDENCIAS</a>
                        </div>
                        </div>
                        </div>
                        <!--REGISTRO ADMINISTRADORES-->
                        <div class = "col-sm-6">
                        <div class = "card mb-3">
                        <div class = "card-body">
                            <h5 class = "card-title">REGISTRO DE ADMINISTRADORES</h5>
                            <p class = "card-text">Se registran nuevos usuarios del tipo Administrador</p>
                            <a href="{{action('RegisterAdminController@index')}}"class="btn btn-primary">IR A REGISTRO</a>
                            <a href="{{action('RegisterAdminController@change_roles')}}"class="btn btn-primary">IR A CAMBIO DE ROLES</a>
                        </div>
                        </div>
                        </div>



                    @else
                    <div class = "blockquote">{{(Auth::user()->name)}}
                            <p class= "text-muted">Usuario</p> </div>
                        <div class="card" style="width: 30rem center">
                        <div class="card-body">
                        <h5 class="card-title">Vistas Públicas</h5>
                        <p class="card-text">Se despliega todos los convenios que se tiene firmado entre la UADY y otra dependencia. </p>
                         <a href="#" class="btn btn-primary">Ir a Vista Públicas</a>
                     </div>
                    @endif 
            </div>
        </div>
    </div>
</div>
@endsection
