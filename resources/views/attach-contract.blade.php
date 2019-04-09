@extends('layouts.app')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('content')
<div class="custom-bg">

    <img class="back-deco-us" src="{{asset('/img/login-bg.svg')}}" alt="Background image">

    <div class="container vertical-center">
        <div class="col-md-4 col-md-offset-4 form-ctm">
            <div class="card text-center">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Error, hay un campo incorrecto.</h5>
                </div>
                @endif

                {{-- {{$this->routeName}} --}}

                <form action="{{route('upload-Contract')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body" style="max-width:640px; margin:auto;">
                        <h2>Subir Contrato</h2>
                        <h4>Informacion Legal de Contrato</h4>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5>Error, hay un campo incorrecto.</h5>
                        </div>
                        @endif
                        <div class="row">
                            <div class="column">
                                <div class="form-group">
                                    <h5>Representante Legal</h5>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_name" id="legal_representative_name"
                                        class="form-control" placeholder="Nombre Completo" autofocus>
                                    @if ($errors->has('legal_representative_name'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="company_social_reason" id="company_social_reason"
                                        class="form-control" value="{{old('company_social_reason')}}"
                                        placeholder="Razon Social">
                                    @if ($errors->has('company_social_reason'))
                                    <p class="text-danger">{{ $errors->first('company_social_reason') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_id_number"
                                        id="legal_representative_id_number" class="form-control"
                                        value="{{old('legal_representative_id_number')}}"
                                        placeholder="Número de Identidad">
                                    @if ($errors->has('legal_representative_id_number'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_id_number') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_home" id="legal_representative_home"
                                        class="form-control" value="{{old('legal_representative_home')}}"
                                        placeholder="Ej. Ciudad, Depto.">
                                    @if ($errors->has('legal_representative_home'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_home') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <select name="legal_representative_marital_status"
                                        id="legal_representative_marital_status" class="form-control">
                                        <option
                                            {{old('legal_representative_marital_status') == 'Vacio' ? 'selected' : '' }}>
                                            Estado Marital</option>
                                        <option
                                            {{old('legal_representative_marital_status') == 'Soltero' ? 'selected' : '' }}>
                                            Soltero</option>
                                        <option
                                            {{old('legal_representative_marital_status') == 'Casado' ? 'selected' : '' }}>
                                            Casado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="column">
                                <div class="form-group">
                                    <h5>Contacto</h5>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="contact_name" id="contact_name" class="form-control"
                                        value="{{old('contact_name')}}" placeholder="Nombre del Contacto">
                                    @if ($errors->has('contact_name'))
                                    <p class="text-danger">{{ $errors->first('contact_name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="company_adress" id="company_adress" class="form-control"
                                        value="{{old('company_adress')}}" placeholder="Dirección del Comercio">
                                    @if ($errors->has('company_adress'))
                                    <p class="text-danger">{{ $errors->first('company_adress') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" name="legal_representative_rtn" id="legal_representative_rtn"
                                        class="form-control" value="{{old('legal_representative_rtn')}}"
                                        placeholder="Número de RTN">
                                    @if ($errors->has('legal_representative_rtn'))
                                    <p class="text-danger">{{ $errors->first('legal_representative_rtn') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="company_tel" id="company_tel" class="form-control"
                                        value="{{old('company_tel')}}" placeholder="Teléfono del Comercio">
                                    @if ($errors->has('company_tel'))
                                    <p class="text-danger">{{ $errors->first('company_tel') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" name="company_email" id="company_email" class="form-control"
                                        placeholder="Correo Electrónico">
                                    @if($errors->has('company_email'))
                                    <p class="text-danger">{{ $errors->first('company_email') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <input type="file" name="file" id="file" class="file">
                        @if ($errors->has('file'))
                        <p class="text-danger">{{ $errors->first('file') }}</p>
                        @endif

                        <br>

                        <button type="submit" class="btn btn-pixel btn-block" style="width:91%; margin:auto;">
                            SUBIR CONTRATO
                        </button>
                        <hr>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection