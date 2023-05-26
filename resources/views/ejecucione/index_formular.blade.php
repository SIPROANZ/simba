@extends('adminlte::page')

@section('template_title')
    Ejecuciones
@endsection

@section('content')
<!-- Cajas estadisticas de la ejecucion presupuestaria -->
<!-- Total Presupuestario -->


<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ejecución - Formulacion') }}
                            </span>

                             <div class="float-right">
                                 @can('admin.crear')
                                 <a href="{{ route('ejecuciones.reportes') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                    {{ __('Reporte') }}
                                  </a>

                                 <a href="{{ route('ejecuciones.create_formular') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                @endcan

                                {{--    <a href="{{ route('ejecuciones.pdf') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Exportar') }}
                                </a>
                               --}}
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
                            <table class="table table-hover table-bordered table-striped small">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Nro</th>
										
										<th class="text-center">Unidad administrativa</th>
									
										<th class="text-center">Clasificador</th>
                    <th class="text-center">Inicial</th>
                    <th class="text-center">Modificaciones</th>
                    <th class="text-center">Ajustado</th>

										<th class="text-center">Compromiso</th>
										<th class="text-center">Causado</th>
										<th class="text-center">Pagado</th>
										<th class="text-center">Disponibilidad</th>
                    <th class="text-center">Mostrar</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ejecuciones as $ejecucione)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											
											<td class="text-center">{{ $ejecucione->unidadadministrativa->sector .'.'. $ejecucione->unidadadministrativa->programa .'.'. $ejecucione->unidadadministrativa->actividad .' '. $ejecucione->unidadadministrativa->unidadejecutora }}</td>
											
											<td class="text-center">{{ $ejecucione->clasificadorpresupuestario }}</td>

                                           

                      <td class="text-center">{{ number_format($ejecucione->monto_inicial, 2, ',','.') }}</td>

											
											<td class="text-center">{{ number_format(($ejecucione->monto_actualizado - $ejecucione->monto_inicial), 2, ',','.') }}</td>
                      <td class="text-center">{{ number_format($ejecucione->monto_actualizado, 2, ',','.') }}</td>
											<td class="text-center">{{ number_format($ejecucione->monto_comprometido, 2, ',','.') }}</td>
											<td class="text-center">{{ number_format($ejecucione->monto_causado, 2, ',','.') }}</td>
											<td class="text-center">{{ number_format($ejecucione->monto_pagado, 2, ',','.') }}</td>
											<td class="text-center">{{ number_format($ejecucione->monto_por_comprometer, 2, ',','.') }}</td>
										
                     

                                            <td class="text-center">
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ejecuciones.show',$ejecucione->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                              
                                            @can('admin.crear')
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ejecuciones.edit',$ejecucione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                             @endcan       
                                            </td>

                      <!-- Para editar una ejecucion -->
                    

                                            
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ejecuciones->links() !!}
            </div>
        </div>
    </div>
@endsection
