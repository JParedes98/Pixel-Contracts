@extends('layouts.app')

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
                                <small class="text-muted">{{ $item->date->format('M') }}</small>
                                <p>{{ $item->date->format('d') }}</p>
                                <small class="text-muted">{{ $item->date->format('Y') }}</small>
                            </td>
                            <td scope="row">
                                {{ $item->name_rep }}
                                <br>
                                <small class="text-muted">{{ $item->n_identidad }}</small>
                            </td>
                            <td data-toogle="tooltip" title="{{ $item->adress }}">{{ $item->email }}
                                <br>
                                <small class="text-muted">{{$item->tel }}</small>
                            </td>
                            <td>
                                {{$item->social_reason}}
                                <br>
                                <small class="text-muted">
                                    {{$item->rtn}}
                                </small>
                            </td>
                            <td>
                                @if ($item->status)
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
                                        <a class="dropdown-item" href="{{ route('contrato.pdf',['rtn'=> $item->rtn]) }}">Contrato
                                            PDF</a>
                                        @if ($item->status==0)
                                        <a class="dropdown-item" href="{{ route('contrato.preview',['rtn'=> $item->rtn]) }}">Url
                                            de Contrato</a>
                                        @endif
                                        <a class="dropdown-item" href="{ route('contrato.editar',['rtn'=> $item->id]) }}">Editar
                                            Contrato</a>
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
                    <a class="btn btn-primary btn-lg" href="{{ route ('nuevo.cliente') }}" role="button">Generar
                        Contrato</a>
                </div>
                <br>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
