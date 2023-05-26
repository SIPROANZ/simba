@extends('adminlte::page')


@section('title', 'Ordenes de Compras')

@section('content_header')
    <h1>Ordenes de Compras En Proceso</h1>
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

                                <a href="{{ route('compras.aprobadas')  }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Aprobadas') }}
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
                                    <th>Numero Compra</th>
                                        
										<th>Numero Analisis</th>
                                        <th>Observacion</th>
										
										<th>Estado</th>
										<th>Monto Base</th>
										<th>Monto IVA</th>
										<th>Monto Total</th>

                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td>{{ $compra->numordencompra }}</td>
                                            
											<td>{{ $compra->analisis_id }}</td>
                                            <td>{{ $compra->analisi->observacion }}</td>
											
											<td>
                                                

                                            @if ($compra->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compra->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compra->status == 'AP')
                                                    APROBADA
                                                @elseif ($compra->status == 'AN')
                                                    ANULADA
                                                @endif


                                            </td>
											<td>{{ number_format($compra->montobase, 2, ',', '.') }}</td>
											<td>{{ number_format($compra->montoiva, 2, ',', '.') }}</td>
											<td>{{ number_format($compra->montototal, 2, ',', '.') }}</td>

                                            <td>{{ $compra->usuario->name }}</td>
                                            <td>

       <!-- =========================================================== -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ver</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">


                                                <form action="{{ route('compras.actualizar',$compra->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block " href="{{ route('compras.show',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Compra"><i class="fas fa-print"></i> Mostrar</a>
                                                    
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('compras.pdf',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compra" target="_black"><i class="fa fa-fw fa-print"></i> Imprimir</a>
                                                   
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('compras.edit',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Compra"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                     
                                                    <a class="btn btn-sm btn-block btn btn-outline-danger btn-block" href="{{ route('compras.reversar',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Reversar Analisis"><i class="fa fa-fw fa-edit"></i>1- Reversar Analisis</a>
                                                   
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-success btn-block submit-prevent-button" data-toggle="tooltip" data-placement="top" title="Actualizar Compra"><i class="fas fa-history"></i>2- Actualizar</button>
                                                </form>

                                                <form action="{{ route('compras.aprobar',$compra->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                  
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-success btn-blockbtn-block submit-prevent-button" data-toggle="tooltip" data-placement="top" title="Aprobar Compra"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form>

                                                <form action="{{ route('compras.anular',$compra->id) }}" method="POST" class="submit-prevent-form">
                                                  
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-anular-box" data-toggle="tooltip" data-placement="top" title="Anular Compra"><i class="fa fa-fw fa-trash"></i> Anular</button>
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
                {!! $compras->links() !!}
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
