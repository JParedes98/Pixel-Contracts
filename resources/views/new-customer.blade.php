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
                
                <form action="{{route('create-customer')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h2>Enviar Generador</h2>
                        <div class="form-group">
                            <h5>Información de Cliente</h5>
                        </div>
                        <div class="form-group">
                            <input type="text" name="legal_representative_name" id="legal_representative_name" class="form-control" placeholder="Nombre de Representante"
                                value="{{old('legal_representative_name')}}" style="width:80%; margin:auto;" max="60" autofocus>
                            @if ($errors->has('legal_representative_name'))
                            <p class="text-danger">{{ $errors->first('legal_representative_name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" name="company_email" id="company_email" class="form-control" value="{{old('company_email')}}"
                                placeholder="Correo Electronico" style="width:80%; margin:auto;" max="40">
                            @if ($errors->has('company_email'))
                                <p class="text-danger">{{ $errors->first('company_email') }}</p>
                            @endif
                        </div>
            
                        <div class="file_container">
                            <input type="file" name="contract_attachments" id="contract_attachments" class="file" 
                            value="{{old('contract_attachments')}}">
                            <label for="contract_attachments" class="btn-2">Anexos</label>
                            <br>
                            <strong id="file-return"></strong>
                            @if ($errors->has('contract_attachments'))
                                <label class="text-danger">{{ $errors->first('contract_attachments') }}</label>
                            @endif
                        </div>
                        <input type="hidden" name="created_by" id="created_by" value="{{\Auth::user()->id}}">
                        <br>
                        <i class="fas fa-exclamation-circle"></i><label style="margin-left:5px;" class="text-muted">Favor Rellenar Ambos Campos</label>
                        <input type="submit" value="ENVIAR" class="btn btn-pixel btn-block" style="width:80%; margin:auto; margin-bottom:50px; margin-top:30px;">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection