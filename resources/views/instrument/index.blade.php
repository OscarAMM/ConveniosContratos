@extends('layouts.app')
@section('content')
<script src="{{asset('js/popup.js')}}"></script>
<div class="container">
    <div class="jumbotron" style="background-color:#0F3558;">
        <h1 class="text-muted">Instrumento jurtídico</h1>
        <hr style="border:2px solid #BF942D">
        <p class="text-muted">Se desplegará una lista con todas los instrumentos jurídicos registrados hasta el momento
            en el
            sistema.
        </p>
        <p><a href="{{route('LegalInstrument.create')}}" class="btn boton">Nuevo</a></p>
    </div>


    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <table class="table  table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th colspan="3">&nbsp;</th>
                    </tr>
                <tbody>
                    @foreach($instruments as $instrument)
                    <tr>
                        <td>{{$instrument->id}}</td>
                        <td>{{$instrument->name}}</td>

                        <td> <a href="{{route('LegalInstrument.edit', $instrument->id)}}"
                                class="btn botonAmarillo">Editar</a></td>
                        <td>
                            <form action="{{route('LegalInstrument.destroy', $instrument->id)}}" method="POST">
                                
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" onClick="return confirm('¿Seguro que quiere eliminar este instrumento?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
            {!!$instruments->render()!!}

        </div>
    </div>
</div>

@endsection