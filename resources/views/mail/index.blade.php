@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('SendMail.index') }}">
    @csrf

    @if(Session::has("success"))
    <div class="alert alert-success">¡Tu mensaje ha sido enviado!</div>
    @endif
    <div class="form-group row">
        <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

        <div class="col-md-6">
            <input id="subject" type="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                name="subject" value="{{ old('subject') }}" required autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" value="{{ old('email') }}" required autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

        <div class="col-md-6">
            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="submit" value="Send Email" class="btn btn-success">
    </div>
    
</form>
@endsection