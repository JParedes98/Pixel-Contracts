@extends('layouts.app')
@section('content')

<div class="vertical-center text-center">
    <form class="form-horizontal" action="{{route('store-contract')}}" method="POST">
        {{ csrf_field() }}
        <input value="{{$contract->id}}" name="id" type="hidden">

        <h2>Información Legal del Contrato</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <h5>Error, hay un campo incorrecto.</h5>
        </div>
        @endif

        <div class="form-group form-group-sm">
            <!-- left column -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h5>Representante Legal</h5>
                </div>
                <div class="form-group">
                    <input type="text" name="legal_representative_name" id="legal_representative_name"
                        class="form-control" value="{{old('legal_representative_name')}}" placeholder="Nombre Completo" max="60" autofocus>
                    @if ($errors->has('legal_representative_name'))
                    <p class="text-danger">{{ $errors->first('legal_representative_name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="company_social_reason" id="company_social_reason" class="form-control"
                        value="{{old('company_social_reason')}}" placeholder="Razon Social" max="60">
                    @if ($errors->has('company_social_reason'))
                    <p class="text-danger">{{ $errors->first('company_social_reason') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="legal_representative_id_number" id="legal_representative_id_number"
                        class="form-control" value="{{old('legal_representative_id_number')}}"
                        placeholder="Número de Identidad" max="24">
                    @if ($errors->has('legal_representative_id_number'))
                    <p class="text-danger">{{ $errors->first('legal_representative_id_number') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="legal_representative_home" id="legal_representative_home"
                        class="form-control" value="{{old('legal_representative_home')}}"
                        placeholder="Ej. Ciudad, Depto." max="30">
                    @if ($errors->has('legal_representative_home'))
                    <p class="text-danger">{{ $errors->first('legal_representative_home') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <select name="legal_representative_marital_status" id="legal_representative_marital_status"
                        class="form-control" max="24">
                        <option {{old('legal_representative_marital_status') == 'Soltero' ? 'selected' : '' }}>Soltero
                        </option>
                        <option {{old('legal_representative_marital_status') == 'Casado' ? 'selected' : '' }}>Casado
                        </option>
                    </select>
                </div>
            </div>
            <!-- right column -->
            <div class="col-sm-6">
                <div class="form-group">
                    <h5>Contacto</h5>
                </div>
                <!-- Begin contact information -->
                <div id="tabs">
                    <div class="form-group">
                        <input type="text" name="contact_name" id="contact_name" class="form-control"
                            value="{{old('contact_name')}}" placeholder="Nombre del Contacto" max="30">
                        @if ($errors->has('contact_name'))
                        <p class="text-danger">{{ $errors->first('contact_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_adress" id="company_adress" class="form-control"
                            value="{{old('company_adress')}}" placeholder="Dirección del Comercio" max="80">
                        @if ($errors->has('company_adress'))
                        <p class="text-danger">{{ $errors->first('company_adress') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="legal_representative_rtn" id="legal_representative_rtn"
                            class="form-control" value="{{old('legal_representative_rtn')}}"
                            placeholder="Número de RTN" max="24">
                        @if ($errors->has('legal_representative_rtn'))
                        <p class="text-danger">{{ $errors->first('legal_representative_rtn') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="tel" name="company_tel" id="company_tel" class="form-control"
                            value="{{old('company_tel')}}" placeholder="Teléfono del Comercio" max="20">
                        @if ($errors->has('company_tel'))
                        <p class="text-danger">{{ $errors->first('company_tel') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="company_email" id="company_email" class="form-control"
                            placeholder="Correo Electrónico" value="{{old('company_email')}}" max="40">
                        @if($errors->has('company_email'))
                        <p class="text-danger">{{ $errors->first('company_email') }}</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!-- Submit data -->
        <div class="form-group form-group-sm">
            <div class="col-sm-6 col-sm-offset-3">
                <i class="fas fa-exclamation-circle"></i>
                <label class="text-muted">Favor Rellenar Todos los Campos</label>
                <button type="submit" class="btn btn-pixel btn-block">
                    VER CONTRATO
                </button>
            </div>
        </div>
    </form>
</div>
</div> <!-- End container div -->
@endsection