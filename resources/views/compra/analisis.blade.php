@extends('adminlte::page')


@section('title', 'Ordenes de Compras')

@section('content_header')
    <h1>Ordenes de Compras</h1>
@stop
@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Analisis de Cotizaciones.') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('compras.analisis') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Orden de Compra y Servicios') }}
                                </a>

                                <a href="{{ route('compras.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Compras en Proceso') }}
                                </a>

                                <a href="{{ route('compras.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Procesadas') }}
                                </a>

                                <a href="{{ route('compras.anuladas')  }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Anuladas') }}
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
                                        <th>No. Analisis</th>
                                        
										<th>Unidad administrativa</th>
										<th>Numero Requisicion</th>
										<th>Criterio</th>
										<th>Numero Cotizacion</th>
										<th>Observacion</th>
                                        <th>Estatus</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analisis as $analisi)
                                        <tr>
                                            <td>{{ $analisi->id }}</td>
                                            
											<td>{{ $analisi->unidadadministrativa->denominacion }}</td>
											<td>{{ $analisi->requisicion_id }}</td>
											<td>{{ $analisi->criterio->nombre }}</td>
											<td>{{ $analisi->numeracion }}</td>
											<td>{{ $analisi->observacion }}</td>
                                            <td>{{ $analisi->estatus }}</td>

                                            <td class="float-right">
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('compras.agregarcompra',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Compra"><i class="fas fa-check"></i></i> Seleccionar</a>
                                                
                                                  
                                                
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $analisis->links() !!}
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