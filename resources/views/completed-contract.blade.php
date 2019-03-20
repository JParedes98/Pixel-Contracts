@extends('layouts.app');
@section('content')
    <div class="container vertical-center">
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading h2">Felicidades!</h4>
            <br>
            <p class="h4">Bienvenido a la nueva era y enorme red de crecimiento comercial, el contrato se ha firmado y completado de forma exitosa.</p>
            <br>
            <p class="mb-0 h5">Crece Exponencialmente y utiliza PixelPay como tu herramienta de Cobros</p>
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