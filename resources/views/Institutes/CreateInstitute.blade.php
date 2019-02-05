@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><H5 class = "text-muted">{{ __('Registro de Instituciones') }}</H5></div>

                <div class="card-body">
                    <form method="POST" action="{{action('InstituteController@create')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Institucion') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nombre" value="{{ old('name') }}" required autofocus>

                               <!-- @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sigla" class="col-md-4 col-form-label text-md-right">{{ __('Siglas') }}</label>

                            <div class="col-md-6">
                                <input id="sigla" type="text" class="form-control " name="siglas" value="{{ old('siglas') }}" required>

                               <!-- @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Pais') }}</label>

                            <div class="col-md-6">
                                <input id="pais" type="text" class="form-control" name="pais" required>

                               <!-- @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
