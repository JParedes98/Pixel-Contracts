@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="card mt-4 text-center">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Error, hay un campo incorrecto.</h5>
                </div>
            @endif

            <form action="/contratos" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <h3>
                            Crear CONTRATO
                        </h3>
                </div>
                <div class="form-group">
                    <h5>Informacion General</h5>
                </div>
                <div class="form-group">
                <input type="text" name="name_rep" id="name_rep" class="form-control" placeholder="Nombre de Representante" value="{{old('name_rep')}}" autofocus>
                    @if ($errors->has('name_rep'))
                        <p class="text-danger">{{ $errors->first('name_rep') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="tetxt" name="social_reason" id="social_reason" class="form-control" value="{{old('social_reason')}}" placeholder="Razon Social">
                    @if ($errors->has('social_reason'))
                        <p class="text-danger">{{ $errors->first('social_reason') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="rtn" id="rtn" class="form-control" value="{{old('rtn')}}" placeholder="Numero RTN">
                    @if ($errors->has('rtn'))
                        <p class="text-danger">{{ $errors->first('rtn') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="n_identidad" id="n_identidad" class="form-control" value="{{old('n_identidad')}}" placeholder="Numero Identidad">
                    @if ($errors->has('n_identidad'))
                        <p class="text-danger">{{ $errors->first('n_identidad') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <h5>Informacion de Comercio Afiliado</h5>
                </div>
                <div class="form-group">
                    <input type="text" name="contact" id="contact" class="form-control" value="{{old('contact')}}" placeholder="Contacto">
                    @if ($errors->has('contact'))
                        <p class="text-danger">{{ $errors->first('contact') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="adress" id="adress" class="form-control" value="{{old('adress')}}" placeholder="Direccion">
                    @if ($errors->has('adress'))
                        <p class="text-danger">{{ $errors->first('adress') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="tel" name="tel" id="tel" class="form-control" value="{{old('tel')}}" placeholder="Telefono">
                    @if ($errors->has('tel'))
                        <p class="text-danger">{{ $errors->first('tel') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Correo">
                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label >Fecha de Consolidacion</label>
                    <input type="date" name="date" id="date" max="3000-12-31" min="1000-01-01" value="{{old('date')}}" class="form-control">

                    @if ($errors->has('date'))
                        <p class="text-danger">{{ $errors->first('date') }}</p>
                    @endif
                </div>
                    <button type="submit" class="btn btn-success btn-block">
                        GENERAR CONTRATO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection