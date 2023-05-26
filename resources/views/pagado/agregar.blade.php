@extends('adminlte::page')


@section('title', 'Pagado')

@section('content_header')
    <h1>Pagado</h1>
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
                                {{ __('') }}
                            </span>

                             <div class="float-right">
                              
                             <a href="{{ route('pagados.agregar') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Pagado') }}
                                </a>

                                <a href="{{ route('pagados.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En proceso') }}
                                </a>

                                <a href="{{ route('pagados.procesados') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>

                                <a href="{{ route('pagados.anulados') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Anulados') }}
                                </a>

                                <a href="{{ route('pagados.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                    {{ __('Aprobados') }}
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
                   
                    <form method="GET">
                    <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
                    </div>
                    </form>
                    
                        <div class="table-responsive">
                            <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        
                                        
										<th style="text-align: left"> # Orden pago</th>
                                        <th style="text-align: left"> # Compromiso</th>
										<th style="text-align: left">Beneficiario</th>
										<th style="text-align: left">Monto Base</th>
										<th style="text-align: left">Monto Retencion</th>
										<th style="text-align: left">Monto Neto</th>
										<th style="text-align: left">IVA</th>
										<th style="text-align: left">Exento</th>
										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenpagos as $ordenpago)
                                        <tr>
                                            
                                            
											<td style="text-align: left">{{ $ordenpago->nordenpago }}</td>
                                            <td style="text-align: left">{{ $ordenpago->compromiso->ncompromiso }}</td>

											<td style="text-align: left">{{ $ordenpago->beneficiario->nombre }}</td>
											<td style="text-align: left">{{ number_format($ordenpago->montobase, 2,',','.') }}</td>
											<td style="text-align: left">{{ number_format($ordenpago->montoretencion, 2,',','.') }}</td>
											<td style="text-align: left">{{ number_format($ordenpago->montoneto, 2,',','.') }}</td>
											
											<td style="text-align: left">{{ number_format($ordenpago->montoiva, 2,',','.') }}</td>
											<td style="text-align: left">{{ number_format($ordenpago->montoexento, 2,',','.') }}</td>

                                            <td>
                                           
                                            <a class="btn btn-sm btn-block btn btn-outline-success btn-blockbtn-block " href="{{ route('pagados.agregarorden',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Orden de pago"><i class="fas fa-check"></i></i> Seleccionar</a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ordenpagos->links() !!}
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

