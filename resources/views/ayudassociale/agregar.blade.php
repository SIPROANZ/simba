@extends('adminlte::page')

@section('title', 'Agregar Ayuda Social')

@section('content_header')
    <h1>Agregar Ayuda Social</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ayudassociales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                    <div class="row">
    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ayudassociale->beneficiario->nombre }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ayudassociale->documento }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto total de la ayuda:</strong>
                            {{ number_format($ayudassociale->montototal,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ayudassociale->concepto }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $ayudassociale->unidadadministrativa->unidadejecutora }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $ayudassociale->tipodecompromiso->nombre }}
                        </div>
                        </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles ayuda, imputacion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesayudas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo registro') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">

            
                        <div class="table-responsive">
                                  <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Monto Compromiso</th>
										<th>No. Ayuda</th>
										<th>Unidad Administrativa</th>
										<th>Clasificador</th>
                                        <th>Financiamiento</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesayudas as $detallesayuda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td style="text-align: right">{{ number_format($detallesayuda->montocompromiso,2,',','.') }}</td>
											<td>{{ $detallesayuda->ayuda_id }}</td>
											<td>{{ $detallesayuda->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallesayuda->ejecucione->clasificadorpresupuestario }}</td>
                                            <td>{{ $detallesayuda->financiamiento }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesayudas.edit',$detallesayuda->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                 @can('admin.reversar')
                                                <form action="{{ route('detallesayudas.destroy',$detallesayuda->id) }}" method="POST" class="submit-prevent-form">
                                                     @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesayudas->links() !!}
            </div>
        </div>
    </div>
@stop 

@section('css')
    
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{ asset('css/submit.css') }}">
    
@stop

@section('js')
<script src="{{ asset('js/submit.js') }}"></script>


@stop
