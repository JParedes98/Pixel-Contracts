@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="custom-bg">

    <img class="back-deco-us" src="{{asset('/img/login-bg.svg')}}" alt="Background image">
    <img class="logo-deco" src="{{asset('/img/powered-by-white.svg')}}" alt="Background image">

    <div class="container vertical-center">
        <div class="col-md-8 col-md-offset-2 form-ctm">
            <div class="card mt-4 text-center">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Error, hay un campo incorrecto.</h5>
                </div>
                @endif

                {{-- {{$this->routeName}} --}}
                
                <form action="{{route('guardar.cliente')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h2>Enviar Generador</h2>
                        <img src="{{ asset('./img/logo.png') }}" alt="PixelPay" class="logo">
                        <div class="form-group">
                            <h5>Información de Cliente</h5>
                        </div>
                        <div class="form-group">
                            <input type="text" name="legal_representative_name" id="legal_representative_name" class="form-control" placeholder="Nombre de Representante"
                                value="{{old('legal_representative_name')}}" style="width:80%; margin:auto;" autofocus>
                            @if ($errors->has('legal_representative_name'))
                            <p class="text-danger">{{ $errors->first('legal_representative_name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" name="company_email" id="company_email" class="form-control" value="{{old('company_email')}}"
                                placeholder="Correo" style="width:80%; margin:auto;">
                            @if ($errors->has('company_email'))
                                <p class="text-danger">{{ $errors->first('company_email') }}</p>
                            @endif
                        </div>
                        <i class="fas fa-exclamation-circle"></i><label class="text-muted">Favor Rellenar Ambos Campos</label>
                        <hr>
                        <button type="submit" class="btn btn-pixel btn-block" style="width:80%; margin:auto; margin-bottom:50px;">
                            ENVIAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection