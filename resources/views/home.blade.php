@extends('layouts.app')

@section('content')
<div class="container">
    
            <div class="card">
                <div class="card-header"><h4 class= "text-muted">INICIO</h4></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    @if(Auth::user()->hasRole('admin'))
                        <div class = "blockquote">{{(Auth::user()->name)}}
                        <h6>Administrador</h6></div>
                        <!-- INICIO DE CATALOGOS -->
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="card mb-6">
                        <div class= "card-header"> <h5 class="card-title text-muted">CONVENIO</h5></div>
                        <div class="card-body">
                            
                            <p class="card-text">Se administra los Convenios</p>
                            <a href="#" class="btn btn-primary">ADMINISTRAR</a>
                         </div>
                         </div>
                         </div>
                         <!--CONTRATO-->
                        <div class="col-sm-6">
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">CONTRATO</h5>
                            <p class="card-text">Se administra los Contratos</p>
                            <a href="#" class="btn btn-primary">ADMINISTRAR</a>
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
                            <p><a href="{{route('Institute.index')}}" class="btn btn-primary">ADMINISTRAR INSTITUCIONES</a></p>
                            <a href="{{route('Dependence.index')}}" class="btn btn-primary">ADMINISTRAR DEPENDENCIAS</a>
                        </div>
                        </div>
                        </div>
                        <!--REGISTRO ADMINISTRADORES-->
                        <div class = "col-sm-6">
                        <div class = "card mb-3">
                        <div class = "card-body">
                            <h5 class = "card-title">REGISTRO DE ADMINISTRADORES</h5>
                            <p class = "card-text">Se registran nuevos usuarios del tipo Administrador</p>
                            <a href="{{route('admin.index')}}"class="btn btn-primary">REGISTRAR</a>
                            <a href="{{route('users.index')}}"class="btn btn-primary">CONSULTAR</a>
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
@endsection
