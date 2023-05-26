@extends('adminlte::page')


@section('title', 'Pagado')

@section('content_header')
    <h1>Pagado Aprobados</h1>
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
                                    {{ __('Procesados') }}
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
                                        <th>No. Pagado</th>
                                        
										<th>No. Orden de pago</th>
                                        <th class="col-md-1" style="text-align: left">Fecha </th>
										<th>Beneficiario</th> 
                                        <th>Monto Orden Pago</th>                                    
										<th>Monto Pagado</th>
                                      
                                        {{--   <th>Monto Por Pagar</th> 
                                        <th>Correlativo</th>
										<th>Fechaanulacion</th> 									
										<th>Tipo de orden</th>  
                                        <th>Tipo de Pago</th>                                      
                                        <th>Estado</th> --}}

                                        <th>Usuario</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagados as $pagado)
                                        <tr>
                                            <td>{{ $pagado->correlativo }}</td>
                                            
											<td>{{ $pagado->ordenpago->nordenpago }}</td>
                                            <td style="text-align: left">{{ $pagado->created_at->toDateString()  }}</td>
											<td>{{ $pagado->beneficiario->nombre }}</td>   
                                            <td>{{ number_format($pagado->montoordenpago, 2,',','.') }}</td>                                       
											<td>{{ number_format($pagado->montopagado, 2,',','.') }}</td>
                                            {{-- <td>{{ number_format(($pagado->montoordenpago - $pagado->montopagado), 2,',','.') }}</td>  
                                            
											<td>{{ $pagado->fechaanulacion }}</td>											
											<td>{{ $pagado->tipoordenpago }}</td>  
                                            <td>{{ $pagado->tipomovimiento->descripcion }}</td>                                         
                                            <td>
                                                @if ($pagado->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($pagado->status == 'PR')
                                                    PROCESADA
                                                @elseif ($pagado->status == 'AP')
                                                    APROBADA
                                                @elseif ($pagado->status == 'AN')
                                                    ANULADA
                                                @endif
                                            </td>  --}}

                                            <td>{{ $pagado->usuario->name }}</td>
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



                                               <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block " href="{{ route('pagados.pdf',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Pagado" target="_black"><i class="fas fa-print"></i> Imprimir!</a>  
                                               @can('admin.editar')

                                               <a class="btn btn-sm btn-block btn btn-outline-danger btn-block " href="{{ route('pagados.reversar',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Reversar Orden de Pago"><i class="fas fa-angle-double-left"></i> Reversar </a>
                                                
                                               <a class="btn btn-sm btn-block btn btn-outline-success btn-block " href="{{ route('pagados.actualizar',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Actualizar Pagado, solo si lo ha reversado previamente"><i class="fas fas fa-history"></i> Actualizar</a>
   
                                               <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('pagados.edit',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Editar pagado"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $pagados->links() !!}
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