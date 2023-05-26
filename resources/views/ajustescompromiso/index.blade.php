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
                                {{ __('Ajustar Compromisos') }}
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
                                       
                                        
										<th>Tipo</th>
										<th>No. Compromiso</th>
										<th>Documento</th>
										<th>Concepto</th>
										<th>Monto ajuste</th>
                                        <th>Estado</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ajustescompromisos as $ajustescompromiso)
                                        <tr>
                                            
                                            
											<td> 
                                            @if ($ajustescompromiso->tipo == 1)
                                                    AUMENTA
                                                @elseif ($ajustescompromiso->tipo == 2)
                                                    DISMINUYE
                                                @endif


                                            </td>
											<td>{{ $ajustescompromiso->compromiso->ncompromiso }}</td>
											<td>{{ $ajustescompromiso->documento }}</td>
											<td>{!! $ajustescompromiso->concepto !!}</td>
											<td>{{ number_format($ajustescompromiso->montoajuste,2,',','.') }}</td>
                                            <td>
                                            @if ($ajustescompromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($ajustescompromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($ajustescompromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($ajustescompromiso->status == 'AN')
                                                    ANULADA
                                                @endif
                                            </td>

                                            <td>{{ $ajustescompromiso->usuario->name }}</td>

                                            <td>
                                                
                                            <form action="{{ route('ajustescompromisos.aprobar',$ajustescompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ajustescompromisos.pdf',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Ajuste Compromiso" target="_block"><i class="fas fa-print"></i> Imprimir</a>

                                                
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ajustescompromisos.show',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Ajuste Compromiso"><i class="fas fa-print"></i> Procesar</a>
                                                   
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" data-toggle="tooltip" data-placement="top" title="Aprobar Ajuste Compromiso"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form>

                                                <form action="{{ route('ajustescompromisos.anular',$ajustescompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                  
                                                <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ajustescompromisos.edit',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Ajuste Compromiso"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button" data-toggle="tooltip" data-placement="top" title="Anular Ajuste Compromiso"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ajustescompromisos->links() !!}
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
