@extends('layouts.app')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('content')
<div class="container" style="margin-top:50px;">
    <div>
        @if(count($contract)>=1)
        <table class="table">
            <thead>
                <tr>
                    <th><i class="far fa-calendar-alt ctm-ico"></i></th>
                    <th>REPRESENTANTE</th>
                    <th>CONTACTO</th>
                    <th>COMERCIO</th>
                    <th>ESTADO</th>
                    <th class="text-center">OPCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contract as $item)
                <tr>
                    <td class="date" style="vertical-align:middle;">
                        @if (!$item->contract_date == NULL)
                        <small class="text-muted">{{ $item->contract_date->format('M') }}</small>
                        <p>{{ $item->contract_date->format('d') }}</p>
                        <small class="text-muted">{{ $item->contract_date->format('Y') }}</small>
                        @else
                        <span>- -</span>
                        @endif
                    </td>
                    <td scope="row" style="vertical-align:middle;">
                        @if ($item->legal_representative_name)
                            {{ $item->legal_representative_name }}
                        @else
                            <span>PENDIENTE</span>
                        @endif
                        <br>
                        <small class="text-muted">{{ $item->legal_representative_id_number }}</small>
                    </td>
                    <td style="vertical-align:middle;" data-toogle="tooltip" title="{{ $item->company_adress }}">
                        @if ($item->company_email == NULL && $item->company_tel == NULL)
                            <span>PENDIENTE</span>                    
                        @else
                            {{ $item->company_email }}
                            <br>
                            <small class="text-muted">{{$item->company_tel }}</small>
                        @endif
                    </td>
                    <td style="vertical-align:middle;">
                        @if ($item->company_social_reason!=NULL)
                        {{$item->company_social_reason}}
                        <br>
                        <small class="text-muted">
                            {{$item->legal_representative_rtn}}
                        </small>
                        @else
                        <span class="center">- -</span>
                        @endif

                    </td>
                    <td style="vertical-align:middle;">
                        <div>
                            @if ($item->contract_status==0)
                            <div class="label ctm-label-pend">PENDIENTE</div>
                            @endif

                            @if ($item->contract_status==1)
                            <div class="label ctm-label-comp">AFILIADO</div>
                            @endif

                            @if ($item->contract_status==2)
                            <div class="label ctm-label-vacio">VACIO</div>
                            @endif

                            @if ($item->contract_status==3)
                            <div class="label ctm-label-vacio">EDITADO</div>
                            @endif

                            @if ($item->contract_status==4)
                            <div class="label ctm-label-vacio">ADJUNTO</div>
                            @endif
                        </div>
                    </td>

                    <td width="100" style="vertical-align:middle;">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="margin-top:6px;">
                                Acciones <i class="fas fa-angle-down" style="font-size:15px;"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @if ($item->contract_status == 1 || $item->contract_status == 4)
                                    {{-- <a class="dropdown-item"
                                    href="{{ route('contrato.pdf',['legal_representative_rtn'=> $item->legal_representative_rtn]) }}">Ver Contrato
                                    PDF</a> --}}
                                    <a class="dropdown-item" href="{{url($item->contract_file_pdf)}}">
                                        Ver Contrato PDF
                                    </a>
                                @endif

                                <a class="dropdown-item" href="">
                                    Editar Contrato
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
@endsection
