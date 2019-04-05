@extends('layouts.app')
@section('content')
<div class="gradient">
    <img src="{{asset('images\Edificio_Central.jpg')}}" alt="Edificio-Central">
</div>
<div class="row-10 d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header text-center text-muted">
                <h2>Correo</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('SendMail.index') }}" onSubmit="return confirm('¿Seguro que quiere finalizar?');">
                    @csrf
                    @include('mail.fragment.info')
                    <div class="form-group">
                        <label for="subject">{{ __('Subject') }}</label>
                        <input id="subject" type="subject"
                            class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject"
                            value="{{ old('subject') }}" required autofocus placeholder="Asunto">
                    </div>
                    <div class="form-group ">
                        <label for="subject">{{ __('Email') }}</label>
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" required autofocus placeholder="Correo">
                        <small class="form-text">La dirección de correo no será compartido con nadie.</small>
                    </div>
                    <div class="form-group ">
                        <label for="subject">{{ __('Message') }}</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"
                            placeholder="Escribe tu mensaje"></textarea>
                    </div>
                    <a href="" class="btn btn-secondary">Regresear</a>
                    <input type="submit" value="Enviar"   class="btn boton" >
                </form>
            </div>
        </div>
    </div>
</div>

@endsection