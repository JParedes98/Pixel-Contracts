@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="card mt-4 text-center">

            @if ($errors->any())
                <div class="alert alert-danger mt-1">
                    <h5>Error, hay un campo incorrecto.</h5>
                </div>
            @endif

            <form action="{{route('update-contract', ['id'=>$contrato->id]) }}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <h3>
                            Editar CONTRATO
                        </h3>
                    </div>
                    <div class="form-group">
                        <h5>Informacion General</h5>
                    </div>
                    <div class="form-group">
                        <input type="text" name="legal_representative_name" id="legal_representative_name" class="form-control" 
                        value="{{ old('legal_representative_name', $contrato->legal_representative_name)}}" placeholder="Nombre Completo"
                            autofocus>
                        @if ($errors->has('legal_representative_name'))
                        <p class="text-danger">{{ $errors->first('legal_representative_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="tetxt" name="company_social_reason" id="company_social_reason" class="form-control" 
                        value="{{ $contrato->company_social_reason }}" placeholder="Razon Social">
                        @if ($errors->has('company_social_reason'))
                        <p class="text-danger">{{ $errors->first('company_social_reason') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="legal_representative_rtn" id="legal_representative_rtn" class="form-control" 
                        value="{{ old('legal_representative_rtn', $contrato->legal_representative_rtn) }}" placeholder="RTN">
                        @if ($errors->has('legal_representative_rtn'))
                        <p class="text-danger">{{ $errors->first('legal_representative_rtn') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="legal_representative_id_number" id="legal_representative_id_number" class="form-control" 
                        value="{{ $contrato->legal_representative_id_number }}" placeholder="Numero de Identidad">
                        @if ($errors->has('legal_representative_id_number'))
                        <p class="text-danger">{{ $errors->first('legal_representative_id_number') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="legal_representative_home" id="legal_representative_home" class="form-control" 
                        value="{{ $contrato->legal_representative_id_number }}" placeholder="Domicilio (Ciudad, Depto.)">
                        @if ($errors->has('legal_representative_home'))
                        <p class="text-danger">{{ $errors->first('legal_representative_home') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <h5>Informacion de Comercio Afiliado</h5>
                    </div>
                    <div class="form-group">
                        <input type="text" name="contact_name" id="contact_name" class="form-control" 
                        value="{{ $contrato->contact_name }}" placeholder="Contacto">
                        @if ($errors->has('contact_name'))
                        <p class="text-danger">{{ $errors->first('contact_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_adress" id="company_adress" class="form-control" 
                        value="{{ $contrato->company_adress }}" placeholder="Direccion">
                        @if ($errors->has('company_adress'))
                        <p class="text-danger">{{ $errors->first('company_adress') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="tel" name="company_tel" id="company_tel" class="form-control" 
                        value="{{ $contrato->company_tel }}" placeholder="Teléfono">
                        @if ($errors->has('company_tel'))
                        <p class="text-danger">{{ $errors->first('company_tel') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="company_email" id="company_email" class="form-control" 
                        value="{{old('company_email', $contrato->company_email) }}" placeholder="Correo Electronico">
                        @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="contract_date" id="contract_date" max="3000-12-31" min="1000-01-01" 
                        value="{{ $contrato->contract_date }}" placeholder="Fecha"
                            class="datepicker-here form-control" data-language="es" data-date-format='mm/dd/yyyy'
                            data-multiple-dates-separator=", " data-position='top left'>

                        @if ($errors->has('contract_date'))
                        <p class="text-danger">{{ $errors->first('contract_date') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        EDITAR CONTRATO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection