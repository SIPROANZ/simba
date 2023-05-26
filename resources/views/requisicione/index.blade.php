@extends('adminlte::page')


@section('title', 'Requisiciones en proceso')

@section('content_header')
    <h1>Requisiciones En Proceso</h1>
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
                                <a href="{{ route('requisiciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Requisicion') }}
                                </a>

                                <a href="{{ route('requisiciones.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>

                                &nbsp;&nbsp;

                                <a href="{{ route('requisiciones.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                &nbsp;&nbsp;
                                <a href="{{ route('requisiciones.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                &nbsp;&nbsp;
                                <a href="{{ route('requisiciones.anuladas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
      <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th style="text-align: center">N.Requisicion</th>


										<th style="text-align: center">Ejercicio</th>
										<th style="text-align: center">Unidad administrativa</th>
										<th style="text-align: center">Correlativo</th>
                                        <th>Concepto</th>
										<th>Uso</th>
										<th style="text-align: center">Tipo requisicion</th>
										<th style="text-align: center">Estatus</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisiciones as $requisicione)
                                        <tr>
                                            <td>{{ $requisicione->id }}</td>

										    <td style="text-align: center">{{ $requisicione->ejercicio->nombreejercicio}}</td>
											<td style="text-align: center">{{ $requisicione->unidadadministrativa->unidadejecutora }}</td>
											<td style="text-align: center">{{ $requisicione->correlativo }}</td>
                                            <td>{!! $requisicione->concepto !!}</td>
											<td>{!! $requisicione->uso !!}</td>
											<td style="text-align: center">{{ $requisicione->tipossgp->denominacion }}</td>
											<td style="text-align: center">
                                            @if ($requisicione->estatus == 'EP')
                                                    EN PROCESO
                                                @elseif ($requisicione->estatus == 'PR')
                                                    PROCESADA
                                                @elseif ($requisicione->estatus == 'AP')
                                                    APROBADA
                                                @elseif ($requisicione->estatus == 'AN')
                                                    ANULADA
                                                @endif
                                        </td>
                                        <td style="text-align: center">{{ $requisicione->usuario->name }}</td>
                                            <td>
                                                <div class="row">
 <!-- =========================================================== -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ver </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <form action="{{ route('requisiciones.aprobar',$requisicione->id) }}" method="POST" class="submit-prevent-form">
                    <!-- Agregar detalles BOS a la requisicion -->
                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requisiciones.agregar',$requisicione->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Producto BOS"><i class="fas fa-download"></i></i> Agregar</a>
                                                 
                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requisiciones.edit',$requisicione->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Requisicion"><i class="fa fa-fw fa-edit"></i> Editar</a>
                   
                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requisiciones.pdf',$requisicione->id) }}" target="_black"><i class="fas fa-print"></i> Imprimir</a>
                    
                    @can('admin.administrador')

                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requisiciones.pdfdepurar',$requisicione->id) }}" target="_black"><i class="fas fa-print"></i> Imprimir Depurar</a>
                    
                    @endcan
                   @csrf
                    @method('PATCH')
                <button type="submit" class="btn btn-sm btn-block btn btn-outline-success btn-block submit-prevent-button" data-toggle="tooltip" data-placement="top" title="Aprobar Requisicion"><i class="fas fa-check-double"></i> Aprobar</button>
                </form>
                                                <form action="{{ route('requisiciones.anular',$requisicione->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    
                                                  

                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-anular-box" data-toggle="tooltip" data-placement="top" title="Anular Requisicion"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>

                                                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->


                                                </div>





                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $requisiciones->links() !!}
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