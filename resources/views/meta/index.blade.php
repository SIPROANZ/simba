@extends('adminlte::page')

@section('title', 'Metas')

@section('content_header')
    <h1>Metas</h1>
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
                                {{ __('Meta') }}
                            </span>

                             <div class="float-right">

                                <a href="{{ route('metas.reportes') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                    {{ __('Reporte') }}
                                  </a>

                                <a href="{{ route('metas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Meta') }}
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
                                        <th>No</th>
                                        
										<th style="text-align: left">Plan operativo anual</th>
										<th style="text-align: left">Cant.1</th>
										<th style="text-align: left">Cant.2</th>
										<th style="text-align: left">Cant.3</th>
										<th style="text-align: left">Cant.4</th>
										<th style="text-align: left">Meta</th>
										<th style="text-align: left">Monto</th>
										<th style="text-align: left">Ejercicio</th>
										<th style="text-align: left">Institucion</th>
										<th style="text-align: left">Unidad administrativa</th>
										<th style="text-align: left">Tipo</th>
										<th style="text-align: left">Enero</th>
										<th style="text-align: left">Febrero</th>
										<th style="text-align: left">Marzo</th>
										<th style="text-align: left">Abril</th>
										<th style="text-align: left">Mayo</th>
										<th style="text-align: left">Junio</th>
										<th style="text-align: left">Julio</th>
										<th style="text-align: left">Agosto</th>
										<th style="text-align: left">Septiembre</th>
										<th style="text-align: left">Octubre</th>
										<th style="text-align: left">Noviembre</th>
										<th style="text-align: left">Diciembre</th>
										<th style="text-align: left">Unidad medida</th>
										<th style="text-align: left">Unidad administrativa solicitante</th>
										<th style="text-align: left">Impacto</th>
                                        <th style="text-align: left">Usuario</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($metas as $meta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td style="text-align: left">{{ $meta->poa->proyecto }}</td>
											<td style="text-align: left">{{ $meta->cantidad1 }}</td>
											<td style="text-align: left">{{ $meta->cantidad2 }}</td>
											<td style="text-align: left">{{ $meta->cantidad3 }}</td>
											<td style="text-align: left">{{ $meta->cantidad4 }}</td>
											<td style="text-align: left">{{ $meta->meta }}</td>
											<td style="text-align: left">{{ number_format($meta->monto, 2 ,',','.') }}</td>
											<td style="text-align: left">{{ $meta->ejercicio->nombreejercicio }}</td>
											<td style="text-align: left">{{ $meta->institucione->institucion }}</td>
											<td style="text-align: left">{{ $meta->unidadadministrativa->unidadejecutora }}</td>
											<td style="text-align: left">{{ $meta->tipo }}</td>
											<td style="text-align: left">{{ $meta->enero }}</td>
											<td style="text-align: left">{{ $meta->febrero }}</td>
											<td style="text-align: left">{{ $meta->marzo }}</td>
											<td style="text-align: left">{{ $meta->abril }}</td>
											<td style="text-align: left">{{ $meta->mayo }}</td>
											<td style="text-align: left">{{ $meta->junio }}</td>
											<td style="text-align: left">{{ $meta->julio }}</td>
											<td style="text-align: left">{{ $meta->agosto }}</td>
											<td style="text-align: left">{{ $meta->septiembre }}</td>
											<td style="text-align: left">{{ $meta->octubre }}</td>
											<td style="text-align: left">{{ $meta->noviembre }}</td>
											<td style="text-align: left">{{ $meta->diciembre }}</td>
											<td style="text-align: left">{{ $meta->unidadmedidas->nombre }}</td>
											<td style="text-align: left">{{ $meta->solicitantes->unidadejecutora }}</td>
											<td style="text-align: left">{{ $meta->impacto }}</td>
                                            <td style="text-align: left">{{ $meta->usuario->name }}</td>

                                            <td style="text-align: left">
                                                <form action="{{ route('metas.destroy',$meta->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('metas.show',$meta->id) }}"><i class="fas fa-print"></i> Ver</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('metas.edit',$meta->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-delete-box"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $metas->links() !!}
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
