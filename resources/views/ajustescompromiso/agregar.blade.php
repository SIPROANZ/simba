@extends('adminlte::page')


@section('title', 'AJUSTES COMPROMISOS')

@section('content_header')
    <h1>AJUSTES COMPROMISOS</h1>
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
                                {{ __('Crear Ajuste de Compromiso') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('ajustescompromisos.agregar') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Ajuste') }}
                                </a>

                                <a href="{{ route('ajustescompromisos.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('ajustescompromisos.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesados') }}
                                </a>

                                <a href="{{ route('ajustescompromisos.anuladas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Anulados') }}
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
                                        
                                        
										<th>Unidad Administrativa</th>
										<th>Tipo compromiso</th>
										<th>No. compromiso</th>
										<th>Beneficiario</th>
										<th>Monto compromiso</th>
										<th>Estado</th>
										<th>Documento</th>
										

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            
                                            
											<td>{{ $compromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $compromiso->tipodecompromiso->nombre }}</td>
											<td>{{ $compromiso->ncompromiso }}</td>
											<td>{{ $compromiso->beneficiario->nombre }}</td>
											<td>{{ number_format($compromiso->montocompromiso,2,',','.') }}</td>
											<td>

                                            @if ($compromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($compromiso->status == 'AN')
                                                    ANULADA
                                                @endif

                                            </td>
											<td>{{ $compromiso->documento }}</td>
											

                                            <td>
                                        
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ajustescompromisos.agregarcompromiso',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Ajuste Compromiso"><i class="fas fa-check"></i></i> Seleccionar</a>
                                                
                                    
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compromisos->links() !!}
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