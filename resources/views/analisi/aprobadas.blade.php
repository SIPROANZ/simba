@extends('adminlte::page')


@section('title', 'Analisis de Cotizacion')

@section('content_header')
    <h1>Analisis de Cotizaciones Aprobadas</h1>
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
                                <a href="{{ route('analisis.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Analisis de Cotizacion') }}
                                </a>

                                <a href="{{ route('analisis.aprobadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>

                                <a href="{{ route('analisis.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('analisis.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>

                                <a href="{{ route('analisis.anuladas')  }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                        <th>No. Analisis</th>
                                        
										<th>Unidad administrativa</th>
										<th>Numero Requisicion</th>
										<th>Criterio</th>
										<th>Numero Cotizacion</th>
										<th>Observacion</th>
                                        <th>Estatus</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analisis as $analisi)
                                        <tr>
                                            <td>{{ $analisi->id }}</td>
                                            
											<td>{{ $analisi->unidadadministrativa->denominacion }}</td>
											<td>{{ $analisi->requisicione->correlativo }}</td>
											<td>{{ $analisi->criterio->nombre }}</td>
											<td>{{ $analisi->numeracion }}</td>
											<td>{!! $analisi->observacion !!}</td>
                                            <td>

                                            @if ($analisi->estatus == 'EP')
                                                    EN PROCESO
                                                @elseif ($analisi->estatus == 'PR')
                                                    PROCESADA
                                                @elseif ($analisi->estatus == 'AP')
                                                    APROBADA
                                                @elseif ($analisi->estatus == 'AN')
                                                    ANULADA
                                                @endif

                                            </td>

                                            <td>{{ $analisi->usuario->name }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('analisis.pdf',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Analisis" target="_black"><i class="fas fa-print"></i> Imprimir</a>
                                                 
                                           {{--  <form action="{{ route('analisis.modificar',$analisi->id) }}" method="POST" class="submit-prevent-form">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                   @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-dark btn-block" data-toggle="tooltip" data-placement="top" title="Modificar Analisis"><i class="fa fa-fw fa-check"></i> Modificar</button>
                                            </form>
                                            --}}

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $analisis->links() !!}
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