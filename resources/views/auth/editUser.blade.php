@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5 class="text-muted">{{ __('Editar') }}</h5></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.edited',$user->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus value="{{$user->name}}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            

                            <div class="col-md-10 text-center">     
                            <label for="rol" class="col-md-4 col-form-label text-md-right  font-weight-bold">{{ __('Roles') }}</label>
                            Administrador  <input type="checkbox" {{ $user->hasRole('admin') ? 'checked' : '' }} name="role_user">
                            Usuario <input type="checkbox" {{ $user->hasRole('user') ? 'checked' : '' }} name="role_user">
                            </div>
                        </div>-->

                        <div class="form-group row">
                        <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                            <div class="col-md-6">
                            <select name="rol" id="rol" class="form-control"  required="required">
                                @if($user->hasRole('user'))
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                @else
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                @endif   
                            </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                           

                                <a href="{{route('users.index')}}" class="btn btn-secondary">Regresar</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
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
