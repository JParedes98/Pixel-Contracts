@extends('layouts.app');

@section('content')
    <div class="container vertical-center">
        <div class="alert alert-warning text-center" role="alert">
            <h4 class="alert-heading h2">Contrato Completado!</h4>
            <br>
            <p class="h4">El contrato se completo de forma exitosa, Favor revice su correo para conservar una copia de su contrato con PixelPay.</p>
            <br>
            <p class="mb-0 h5">Crece Exponencialmente y utiliza PixelPay como tu herramienta de Cobros</p>
            <br>
            <a class="btn btn-warning btn-lg btn-custom" href="{{ route ('contrato.nuevo') }}" role="button">Regresar</a>
            <hr class="my-4">
            <img src="{{ asset('./img/comodo_secure_seal_113x59_transp.png') }}" alt="PixelPay" class="logo" style="display:inline-block; margin:auto;">
            <img src="{{ asset('./img/logo.png') }}" alt="PixelPay" class="logo" style="display:inline-block; margin:auto;">
            <img src="{{ asset('./img/3d_secure_badge.png') }}" alt="PixelPay" class="logo" style="display:inline-block; margin:auto;">
            <br>
            <a target="_blank" href="https://www.facebook.com/pixelpay"><i class="fab fa-facebook-f social"></i></a>
            <a target="_blank" href="https://twitter.com/pixelpayhn"><i class="fab fa-twitter social"></i></a>
            <a target="_blank" href="https://pixelpay.tumblr.com"><i class="fab fa-tumblr social"></i></i></a>
        </div>
    </div>
@endsection