@extends('adminlte::page')

@section('title', 'Ayudas en proceso')

@section('content_header')
    <h1>Ayudas Sociales en Proceso</h1>
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
                                <a href="{{ route('ayudassociales.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Ayuda Social') }}
                                </a>
                                <a href="{{ route('ayudassociales.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>
                                <a href="{{ route('ayudassociales.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('ayudassociales.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('ayudassociales.anuladas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
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
                            <table class="table table-hover  small table-bordered table-striped small">
                                <thead class="thead">
                                    <tr>
                                        <th>No. Ayuda</th>
                                        
										<th>Documento</th>
										<th>Monto total</th>
										<th>Concepto</th>
										<th>Unidad administrativa</th>
										<th>Tipo de compromiso</th>
										<th>Beneficiario</th>
                                        <th>Estado</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ayudassociales as $ayudassociale)
                                    @if ($ayudassociale->status == 'EP')
                                        <tr>
                                            <td>{{ $ayudassociale->id }}</td>
                                            
											<td>{{ $ayudassociale->documento }}</td>
											<td style="text-align: right">{{ number_format($ayudassociale->montototal,2,',','.') }}</td>
											<td>{!! $ayudassociale->concepto !!}</td>
											<td>{{ $ayudassociale->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $ayudassociale->tipodecompromiso->nombre }}</td>
											<td>{{ $ayudassociale->beneficiario->nombre }}</td>
                                            <td>@if ($ayudassociale->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($ayudassociale->status == 'PR')
                                                    PROCESADA
                                                @elseif ($ayudassociale->status == 'AP')
                                                    APROBADA
                                                @elseif ($ayudassociale->status == 'AN')
                                                    ANULADA
                                                @endif</td>

                                                <td>{{ $ayudassociale->usuario->name }}</td>

                                            <td>
                                                
 <!-- =====Menu Desplegable====================================================== -->

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
                                                <form action="{{ route('ayudassociales.aprobar',$ayudassociale->id) }}" method="POST" class="submit-prevent-form">
                                                <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('ayudassociales.agregar',$ayudassociale->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Detalles"><i class="fas fa-download"></i></i> Agregar</a>
                                                     
                                                     <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('ayudassociales.edit',$ayudassociale->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Ayuda Social"><i class="fa fa-fw fa-edit"></i> Editar!</a>
                                                     
                                                     <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('ayudassociales.pdf',$ayudassociale->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Ayuda Social" target="_black"><i class="fas fa-print"></i> Imprimir</a>
                                                     
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-success btn-blockbtn-block submit-prevent-button" data-toggle="tooltip" data-placement="top" title="Aprobar Compromiso"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form> 

                                                @can('admin.reversar')
                                                <form action="{{ route('ayudassociales.anular',$ayudassociale->id) }}" method="POST" class="submit-prevent-form">
                                                    
                                                   @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-anular-box" data-toggle="tooltip" data-placement="top" title="Anular Ayuda Social"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>
                                                              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
                                                @endcan
                                               
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ayudassociales->links() !!}
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
