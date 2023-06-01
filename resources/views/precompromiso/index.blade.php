@extends('adminlte::page')

@section('title', 'Precompromisos En Proceso')

@section('content_header')
    <h1>Precompromisos En Proceso</h1>
@stop

@section('content')
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
                             <a href="{{ route('precompromisos.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Precompromiso') }}
                                </a>
                                <a href="{{ route('precompromisos.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobados') }}
                                </a>
                                <a href="{{ route('precompromisos.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('precompromisos.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesados') }}
                                </a>
                                <a href="{{ route('precompromisos.anuladas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                        
                                        <th>No. Precompromiso</th>
										<th>Documento</th>
										<th>Monto total</th>
										<th>Concepto</th>
										<th>Unidad administrativa</th>
										<th>Tipo compromiso</th>
										<th>Beneficiario</th>
                                        <th>Estado</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($precompromisos as $precompromiso)

                                        <tr>

                                            <td>{{ $precompromiso->id }}</td>
                                            
											<td>{{ $precompromiso->documento }}</td>
											<td>{{ number_format($precompromiso->montototal,2,',','.') }}</td>
											<td>{!! substr($precompromiso->concepto,0,120) !!}</td>
											<td>{{ $precompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $precompromiso->tipodecompromiso->nombre}}</td>
											<td>{{ $precompromiso->beneficiario->nombre }}</td>
                                            <td>@if ($precompromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($precompromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($precompromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($precompromiso->status == 'AN')
                                                    ANULADA
                                                @endif</td>
                                                <td>{{ $precompromiso->usuario->name }}</td>

                                            <td>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                      <div class="card card-secondary collapsed-card">
                                                        <div class="card-header">
                                                          <h3 class="card-title">Ver  </h3>
                                          
                                                          <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                            </button>
                                                          </div>
                                                          <!-- /.card-tools -->
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">

                                                <form action="{{ route('precompromisos.aprobar',$precompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('precompromisos.agregar',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Detalles"><i class="fas fa-download"></i></i> Agregar</a>
                                                      
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('precompromisos.edit',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Precompromiso"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                   
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('precompromisos.pdf', $precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Precompromiso" target="_black"><i class="fas fa-print"></i>Imprimir</a>
                                           
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-success btn-block" data-name="{{ $precompromiso->documento }}" data-toggle="tooltip" data-placement="top" title="Aprobar Precompromiso"><i class="fas fa-check-double"></i>Aprobar</button>
                                                </form> 

                                                <form action="{{ route('precompromisos.anular',$precompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    
                                                     <!-- =========================================================== -->

                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-anular-box" data-toggle="tooltip" data-placement="top" title="Anular Precompromiso"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>
                                                

                                                
                                                             </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->



                                            </td>
                                        </tr>
                                       
                                        
                                    @endforeach
                                </tbody>
                            </table>

                            

                        </div>
                    </div>
                </div>
                {!! $precompromisos->links() !!}
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


