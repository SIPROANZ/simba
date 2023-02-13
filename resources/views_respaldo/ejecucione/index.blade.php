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
<div class="info-box">
  <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Presupuestario</span>
    <span class="info-box-number">{{ $datos['total_presupuestario'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: {{$datos['tpdisponible']}}%"></div>
    </div>
    <span class="progress-description">
    Total disponible {{$datos['total_disponible']}} que representa el {{$datos['porc_disponible']}}% 
    </span>
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
                                <a href="{{ route('ejecuciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>

                                <a href="{{ route('ejecuciones.pdf') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Exportar') }}
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
                            <table class="table table-hover table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Nro</th>
										<th class="text-center">Ejercicio Id</th>
										<th class="text-center">Unidadadministrativa</th>
										<th class="text-center">Meta</th>
										<th class="text-center">Clasificador presupuestario</th>

                                        <th class="text-center">Mostrar</th>

										<th class="text-center">Financiamiento</th>
										<th class="text-center">MontoInicial</th>
										<th class="text-center">MontoAumento</th>
										<th class="text-center">MontoDisminuye</th>
										<th class="text-center">MontoActualizado</th>
										<th class="text-center">MontoPrecomprometido</th>
										<th class="text-center">MontoComprometido</th>
										<th class="text-center">MontoCausado</th>
										<th class="text-center">MontoPagado</th>
										<th class="text-center">MontoPorComprometer</th>
										<th class="text-center">MontoPorCausar</th>
										<th class="text-center">MontoPorPagar</th>
										<th class="text-center">Poa</th>
                    <th class="text-center">Opcion</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ejecuciones as $ejecucione)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $ejecucione->ejercicio->nombreejercicio }}</td>
											<td class="text-center">{{ $ejecucione->unidadadministrativa->sector .'.'. $ejecucione->unidadadministrativa->programa .'.'. $ejecucione->unidadadministrativa->actividad .' '. $ejecucione->unidadadministrativa->unidadejecutora }}</td>
											<td class="text-center">{{ $ejecucione->meta->meta }}</td>
											<td class="text-center">{{ $ejecucione->clasificadorpresupuestario }}</td>

                                            <td class="text-center">
                                            <a class="btn btn-sm btn-primary " href="{{ route('ejecuciones.show',$ejecucione->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    
                                            </td>

											<td class="text-center">{{ $ejecucione->financiamiento->nombre }}</td>
											<td class="text-center">{{ $ejecucione->monto_inicial }}</td>
											<td class="text-center">{{ $ejecucione->monto_aumento }}</td>
											<td class="text-center">{{ $ejecucione->monto_disminuye }}</td>
											<td class="text-center">{{ $ejecucione->monto_actualizado }}</td>
											<td class="text-center">{{ $ejecucione->monto_precomprometido }}</td>
											<td class="text-center">{{ $ejecucione->monto_comprometido }}</td>
											<td class="text-center">{{ $ejecucione->monto_causado }}</td>
											<td class="text-center">{{ $ejecucione->monto_pagado }}</td>
											<td class="text-center">{{ $ejecucione->monto_por_comprometer }}</td>
											<td class="text-center">{{ $ejecucione->monto_por_causar }}</td>
											<td class="text-center">{{ $ejecucione->monto_por_pagar }}</td>
											<td class="text-center">{{ $ejecucione->poa->proyecto}}</td>

                      <!-- Para editar una ejecucion -->
                      <td class="text-center">
                      
                    
                      <form action="{{ route('ejecuciones.destroy',$ejecucione->id) }}" method="POST">
                      <a class="btn btn-sm btn-success" href="{{ route('ejecuciones.edit',$ejecucione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>

                                                     @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                      </td>

                                            
                                            
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
