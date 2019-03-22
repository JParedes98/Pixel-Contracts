@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div>
                @if(count($contract)>=1)
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="far fa-calendar-alt ctm-ico"></i></th>
                            <th><i class="fas fa-users ctm-ico"></i> REPRESENTANTE</th>
                            <th><i class="far fa-share-square ctm-ico"></i> CONTACTO</th>
                            <th><i class="far fa-building"></i> COMERCIO</th>
                            <th><i class="fas fa-file-contract ctm-ico"></i> ESTADO</th>
                            <th><i class="fas fa-sliders-h ctm-ico"></i> OPCIONES</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contract as $item)
                        <tr>
                            <td class="date">
                                @if (!$item->contract_date == NULL)
                                    <small class="text-muted">{{ $item->contract_date->format('M') }}</small>
                                    <p>{{ $item->contract_date->format('d') }}</p>
                                    <small class="text-muted">{{ $item->contract_date->format('Y') }}</small>
                                @else
                                    <small class="text-muted">Mes</small>
                                    <p>Día</p>
                                    <small class="text-muted">Año</small>
                                @endif
                            </td>
                            <td scope="row">
                                {{ $item->legal_representative_name }}
                                <br>
                                <small class="text-muted">{{ $item->legal_representative_id_number }}</small>
                            </td>
                            <td data-toogle="tooltip" title="{{ $item->company_adress }}">{{ $item->company_email }}
                                <br>
                                <small class="text-muted">{{$item->company_tel }}</small>
                            </td>
                            <td>
                                {{$item->company_social_reason}}
                                <br>
                                <small class="text-muted">
                                    {{$item->legal_representative_rtn}}
                                </small>
                            </td>
                            <td>
                                @if ($item->contract_status)
                                <div class="label ctm-label-comp">Afiliado</div>
                                @else
                                <div class="label ctm-label-pend">Pendiente</div>
                                @endif
                            </td>
                            
                            <td width="140">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones <i class="fas fa-angle-down" style="font-size:15px;"></i>
                                    </button>                       
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @if ($item->contract_status)         
                                        <a class="dropdown-item" href="{{ route('contrato.pdf',['rtn'=> $item->legal_representative_rtn]) }}">Contrato
                                            PDF</a>
                                        @if ($item->status==0)
                                        <a class="dropdown-item" href="{{ route('contrato.preview',['rtn'=> $item->legal_representative_rtn]) }}">Url
                                            de Contrato</a>
                                        @endif
                                    @endif
                                        <a class="dropdown-item" href="{{ route('editContract',['rtn'=> $item->id]) }}">Editar
                                            Contrato
                                        </a>
                                    </div>
                                </div>
                            </td>                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="container text-center">
                    <h2>Contratos PixelPay</h2>
                    <h5>Lo sentimos, Actualmente no existe ningun contrato.</h5>
                    <br>
                    <a class="btn btn-primary btn-lg" href="{{ route ('new-customer') }}" role="button">Generar
                        Contrato</a>
                </div>
                <br>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
