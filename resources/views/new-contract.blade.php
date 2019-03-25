@extends('layouts.app')
@section('content')
<div class="custom-bg">

    <img class="back-deco" src="{{asset('/img/login-bg.svg')}}" alt="Background image">
    {{-- <img class="logo-deco-noti" src="{{asset('/img/powered-by-white.svg')}}" alt="Background image"> --}}

    <div class="container vertical-center">
        <div class="col-md-8 col-md-offset-2 form-ctm">
            <div class="card mt-4 text-center">
            <form action="{{route('store-contract')}}" method="POST">                
                {{ csrf_field() }}
                    <input value="{{$contract->id}}" name="id" type="hidden">

                    <div class="card-body">
                        <h2>Información Legal del Contrato</h2>                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h5>Error, hay un campo incorrecto.</h5>
                            </div>
                        @endif
                        <div class="row">
                            <div class="column">
                                <div class="form-group">
                                    <h5>Información de Representante Legal</h5>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_name" id="legal_representative_name" class="form-control" placeholder="Nombre del Representante Legal"
                                        value="{{old('legal_representative_name', $contract->name_rep)}}" autofocus>
                                    @if ($errors->has('legal_representative_name'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="company_social_reason" id="company_social_reason" class="form-control"
                                        value="{{old('company_social_reason')}}" placeholder="Razon Social">
                                    @if ($errors->has('company_social_reason'))
                                    <p class="text-danger">{{ $errors->first('company_social_reason') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_rtn" id="legal_representative_rtn" class="form-control" value="{{old('legal_representative_rtn')}}"
                                        placeholder="Número de RTN">
                                    @if ($errors->has('legal_representative_rtn'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_rtn') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_id_number" id="legal_representative_id_number" class="form-control" value="{{old('legal_representative_id_number')}}"
                                        placeholder="Número de Identidad">
                                    @if ($errors->has('legal_representative_id_number'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_id_number') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <select name="legal_representative_marital_status" id="legal_representative_marital_status" class="form-control">
                                        <option {{old('legal_representative_marital_status') == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                        <option {{old('legal_representative_marital_status') == 'Casado' ? 'selected' : '' }}>Casado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="column">
                                <div class="form-group">
                                    <h5>Contacto</h5>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{old('contact_name')}}"
                                        placeholder="Nombre del Contacto">
                                    @if ($errors->has('contact_name'))
                                    <p class="text-danger">{{ $errors->first('contact_name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="company_adress" id="company_adress" class="form-control" value="{{old('company_adress')}}"
                                        placeholder="Dirección del Comercio">
                                    @if ($errors->has('company_adress'))
                                    <p class="text-danger">{{ $errors->first('company_adress') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="company_tel" id="company_tel" class="form-control" value="{{old('company_tel')}}"
                                        placeholder="Teléfono del Comercio">
                                    @if ($errors->has('company_tel'))
                                    <p class="text-danger">{{ $errors->first('company_tel') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" name="company_email" id="company_email" class="form-control" value="{{old('company_email', $contract->company_email)}}"
                                        placeholder="Correo Electrónico">
                                    @if($errors->has('company_email'))
                                    <p class="text-danger">{{ $errors->first('company_email') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-exclamation-circle"></i>
                        <label style="margin-left:5px;" class="text-muted">Favor Rellenar Todos los Campos</label>
                        
                        <button type="submit" class="btn btn-pixel btn-block">
                            VER CONTRATO
                        </button>
                        <hr>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection