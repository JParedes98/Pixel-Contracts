@extends('layouts.app')
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
                            <input type="text" name="name_rep" id="name_rep" class="form-control" placeholder="Nombre de Representante"
                                value="{{old('name_rep')}}" style="width:80%; margin:auto;" autofocus>
                            @if ($errors->has('name_rep'))
                            <p class="text-danger">{{ $errors->first('name_rep') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}"
                                placeholder="Correo" style="width:80%; margin:auto;">
                            @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <i class="fas fa-exclamation-circle"></i><label class="text-muted">Favor Rellenar Ambos
                            Campos</label>
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