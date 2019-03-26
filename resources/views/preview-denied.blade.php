@extends('layouts.app');
@section('content')
<div class="fullwidth middle" id="content">
    <div class="middle-wrap">
        <div class="card text-center">
            <img src="{{asset('/img/paid_success.png')}}" alt="Contract Success">
            <h2 class="block-title">Contrato Completado!</h2>
            <h3 class="block-subtitle">
                <strong>Se ha firmado con exito</strong>
            </h3>
            <p class="h4-al">Favor revise su correo para conservar una copia de su contrato con PixelPay.</p>
        </div>
    </div>
</div>
@endsection