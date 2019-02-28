@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Representante</th>
                        <th scope="col">Razon Social</th>
                        <th scope="col">N Identidad</th>
                        <th scope="col">RTN</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Tel</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($contract as $item)
                      <tr>
                        <th scope="row">{{ $item->name_rep }}</th>
                          <td>{{ $item->social_reason }}</td>
                          <td>{{ $item->n_identidad }}</td>
                          <td>{{ $item->rtn }}</td>
                          <td>{{ $item->contact }}</td>
                          <td>{{ $item->adress }}</td>
                          <td>{{ $item->tel }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->date }}</td>
                          <td class="text-center">{{$item->status}}</td>
                          <td> <a href="{{ route('contrato.pdf',['rtn'=> $item->rtn]) }}" class="btn btn-success" >Pdf</a></td>
                          <td> <a href="{{ route('contrato.preview',['rtn'=> $item->rtn]) }}" class="btn btn-warning" >Url</a></td>
                          <td> <a href="{{ route('contrato.editar',['rtn'=> $item->id]) }}" class="btn btn-primary" >Editar</a> </td>
                          
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
