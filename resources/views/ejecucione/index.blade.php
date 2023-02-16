@extends('adminlte::page')

@section('template_title')
    Ejecucione
@endsection

@section('content')
<!-- Cajas estadisticas de la ejecucion presupuestaria -->
<!-- Total Presupuestario -->
<br>
<div class="container-fluid">
        <div class="row">
        <div class="col-sm-4">
<div class="info-box">
  <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Inicial</span>
    <span class="info-box-number">{{ $datos['total_presupuestario'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: 100%"></div>
    </div>
    <span class="progress-description">
    </span>
  </div>
  </div>
  </div>

  <div class="col-sm-4">
<div class="info-box">
  <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Modificado</span>
    <span class="info-box-number">{{ $datos['total_modificacion'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: 100%"></div>
    </div>
    <span class="progress-description">
    </span>
  </div>
  </div>
  </div>

  <div class="col-sm-4">
<div class="info-box">
  <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Ajustado</span>
    <span class="info-box-number">{{ $datos['total_ajustado'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: 100%"></div>
    </div>
    <span class="progress-description">
    </span>
  </div>
  </div>
  </div>


</div>
</div>

<div class="row">
            <div class="col-sm-4">
            <div class="info-box bg-success">
  <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Comprometido</span>
    <span class="info-box-number">{{ $datos['total_comprometido'] }}</span>
    <div class="progress">
      <div class="progress-bar" style="width: {{$datos['tpcomprometido']}}%"></div>
    </div>
    <span class="progress-description">
    Representa el {{ $datos['porc_comprometido'] }}% Comprometido
    </span>
  </div>
</div>
            </div>  

            <div class="col-sm-4">
            <div class="info-box bg-gradient-warning">
  <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Causado</span>
    <span class="info-box-number">{{ $datos['total_causado'] }}</span>
    <div class="progress">
      <div class="progress-bar" style="width: {{$datos['tpcausado']}}%"></div>
    </div>
    <span class="progress-description">
    Representa el {{ $datos['porc_causado'] }}% Causado
    </span>
  </div>
</div>
            </div>  

            <div class="col-sm-4">
            <div class="info-box bg-gradient-info">
  <span class="info-box-icon"><i class="far fa-caret-square-right"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Pagado</span>
    <span class="info-box-number">{{ $datos['total_pagado'] }}</span>
    <div class="progress">
      <div class="progress-bar" style="width: {{$datos['tppagado']}}%"></div>
    </div>
    <span class="progress-description">
    Representa el {{ $datos['porc_pagado'] }}% Pagado
    </span>
  </div>
</div>
            </div>  
</div>

<br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ejecución') }}
                            </span>

                             <div class="float-right">
                                 @can('admin.crear')
                                 <a href="{{ route('ejecuciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                @endcan

                                {{--    <a href="{{ route('ejecuciones.pdf') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-hover table-bordered table-striped">
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
                                            <a class="btn btn-sm btn-primary " href="{{ route('ejecuciones.show',$ejecucione->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                              
                                            @can('admin.crear')
                                            <a class="btn btn-sm btn-success" href="{{ route('ejecuciones.edit',$ejecucione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
