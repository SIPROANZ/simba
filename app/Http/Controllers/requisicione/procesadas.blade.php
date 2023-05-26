@extends('adminlte::page')


@section('title', 'Requisiciones Procesadas')

@section('content_header')
    <h1>Requisiciones Procesadas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Requisiciones Procesadas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('requisiciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Requisicion') }}
                                </a>

                                <a href="{{ route('requisiciones.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>

                                <a href="{{ route('requisiciones.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('requisiciones.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>

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
                                        <th style="text-align: center">No</th>
                                        
										
										<th style="text-align: center">Ejercicio</th>
										<th style="text-align: center">Unidad administrativa</th>
										<th style="text-align: center">Correlativo</th>
                                        <th style="text-align: center">Concepto</th>
										<th style="text-align: center">Uso</th>
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
                                            <td style="text-align: center">{{ $requisicione->concepto }}</td>
											<td style="text-align: center">{{ $requisicione->uso }}</td>
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
                                              
                                             <!-- =========================================================== -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ver Opciones </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                                                    @can('admin.reversar')
                                                    <form action="{{ route('requisiciones.reversar',$requisicione->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    @csrf
                                                    @method('PATCH')
                                                          <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requisiciones.pdf',$requisicione->id) }}" target="_black"><i class="fas fa-print"></i> Imprimir</a>
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-dark btn-block" data-toggle="tooltip" data-placement="top" title="Reversar Requisicion"><i class="fa fa-fw fa-check"></i> Reversar</button>
                                                    </form>
                                                    @endcan
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
    
    
    @stop