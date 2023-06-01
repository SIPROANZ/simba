@extends('adminlte::page')


@section('title', 'POA')

@section('content_header')
    <h1>POA</h1>
@stop

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Plan operativo anual') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('poas.reportes') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Reporte') }}
                                </a>

                                <a href="{{ route('poas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Plan operativo anual') }}
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
                                         
										<th style="text-align: left">No</th>
                                        
										
										<th style="text-align: left">Ejercicio</th>
										<th style="text-align: left">Institucion</th>										 
										<th style="text-align: left">Historico</th>										 
										<th style="text-align: left">Nacional</th>										 
										<th style="text-align: left">Estrategico</th>										 
										<th style="text-align: left">General</th>										 
										<th style="text-align: left">Municipal</th>										 
										<th style="text-align: left">Pei</th>										 
										<th style="text-align: left">Unidad administrativa</th>										 
										<th style="text-align: left">Proyecto</th>										 
										<th style="text-align: left">Objetivo proyecto</th>										 
										<th style="text-align: left">Monto proyecto</th>									 
										<th style="text-align: left">Responsable</th>										 
										<th style="text-align: left">Tipo</th>										 
										<th style="text-align: left">SNCF estrategico</th>										 
										<th style="text-align: left">SNCF especifico</th>										 
										<th style="text-align: left">P. social</th>									 
										<th style="text-align: left">Codigo</th>										 
										<th style="text-align: left">Tipo proyecto</th>										 
										<th style="text-align: left">Central</th>										 
										<th style="text-align: left">Descripcion</th>
                                        <th style="text-align: left">Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($poas as $poa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td style="text-align: left">{!!$poa->ejercicio->ejercicioejecucion !!}</td>
                                            <td style="text-align: left">{!! $poa->institucione->institucion !!}</td>
                                            <td style="text-align: left">{!!$poa->objetivoshistorico->objetivo !!}</td>
                                            <td style="text-align: left">{!!$poa->objetivonacionale->objetivo !!}</td>
                                            <td style="text-align: left">{!!$poa->objetivosestrategico->objetivo !!}</td>
                                            <td style="text-align: left">{!! $poa->objetivogenerale->objetivo !!}</td>
                                            <td style="text-align: left">{!! $poa->objetivomunicipale->objetivo !!}</td>
                                            <td style="text-align: left">{!! $poa->objetivopei->objetivo !!}</td>
											<td style="text-align: left">{!! $poa->unidadadministrativa->unidadejecutora !!}</td>
                                            <td style="text-align: left">{!! $poa->proyecto !!}</td>
                                            <td style="text-align: left">{!! $poa->objetivoproyecto !!}</td>
                                            <td style="text-align: left">{!! $poa->montoproyecto !!}</td>
											<td style="text-align: left">{!! $poa->responsable !!}</td>
                                            <td style="text-align: left">{!! $poa->tipo !!}</td>
                                            <td style="text-align: left">{!! $poa->sncfestrategico !!}</td>
                                            <td style="text-align: left">{!! $poa->sncfespecifico !!}</td>
                                            <td style="text-align: left">{!! $poa->psocial!!}</td>
                                            <td style="text-align: left">{!! $poa->codigo !!}</td>
                                            <td style="text-align: left">{!! $poa->tipoproyecto !!}</td>
                                            <td style="text-align: left">{!! $poa->central !!}</td>
                                            <td style="text-align: left">{!!$poa->descripcion !!}</td>
                                            <td style="text-align: left">{!! $poa->usuario->name!!}</td>

                                            <td style="text-align: left">
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
                                                <form action="{{ route('poas.destroy',$poa->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('poas.show',$poa->id) }}"><i class="fas fa-print"></i> Ver</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('poas.edit',$poa->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-delete-box"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
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
                {!! $poas->links() !!}
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
    <script src="{{ asset('js/alerta_eliminar.js') }}"></script>
    
    
    @stop
