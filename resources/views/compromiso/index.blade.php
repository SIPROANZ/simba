@extends('adminlte::page')

@section('title', 'Compromisos')

@section('content_header')
    <h1>Compromisos</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compromisos') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('compromisos.compras') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Compromiso') }}
                                </a>
                                
                                <a href="{{ route('compromisos.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('compromisos.procesados') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesados') }}
                                </a>
                                <a href="{{ route('compromisos.anulados') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Anulados') }}
                                </a>

                                <a href="{{ route('compromisos.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
   <table class="table table-hover small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>Numero compromiso</th>
										<th>Unidad Administrativa</th>
										<th>Tipo compromiso</th>
										
										<th>Beneficiario</th>
										<th>Monto compromiso</th>
										<th>Estado</th>
										<th>Documento</th>
										<th>Control</th>

                                        <th>Usuario</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            
                                            <td>{{ $compromiso->ncompromiso }}</td>
                                            
											<td>{{ $compromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $compromiso->tipodecompromiso->nombre }}</td>
											
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
                                                @if($compromiso->precompromiso_id != NULL)
                                                {{ 'PRE-' . $compromiso->precompromiso_id }}
                                                @endif
                                                @if($compromiso->compra_id != NULL)
                                                {{ 'BOS-' . $compromiso->compra_id }}
                                                @endif
                                                @if($compromiso->ayuda_id != NULL)
                                                {{ 'AYD-' .$compromiso->ayuda_id }}
                                                @endif
                                                
                                            </td>
											<td>{{ $compromiso->usuario->name }}</td>

                                            <td>

                                                <form action="{{ route('compromisos.actualizar',$compromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('compromisos.show',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Compromiso"><i class="fas fa-glasses"></i> Analizar</a>
                                                   
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('compromisos.edit',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Compromiso"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block " href="{{ route('compromisos.pdf',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compromiso" target="_black"><i class="fas fa-print"></i> Imprimir</a>
   
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block " href="{{ route('compromisos.reversar',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Reversar"><i class="fas fa-angle-double-left"></i> Reversar</a>
   
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-dark submit-prevent-button btn-block" data-toggle="tooltip" data-placement="top" title="Actualizar Compromiso, solo si lo ha reversado previamente"><i class="fas fa-history"></i> Actualizar</button>
                                                </form>


                                            <form action="{{ route('compromisos.aprobar',$compromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                  
                                                    
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-success submit-prevent-button btn-blockbtn-block" data-toggle="tooltip" data-placement="top" title="Aprobar Compromiso"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form>

                                                 <form action="{{ route('compromisos.anular',$compromiso->id) }}" method="POST" class="submit-prevent-form">
                                                  
                                                  @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-anular-box" data-toggle="tooltip" data-placement="top" title="Anular Compromiso"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>

                                                

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
    <script src="{{ asset('js/alerta_anular.js') }}"></script>
    
    
    @stop

