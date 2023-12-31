@extends('adminlte::page')

@section('title', 'Detalles de Ejecucion')

@section('content_header')
    <h1>Detalles de Ejecucion</h1>
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
                                {{ __('Detalles de la Ejecucion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ejecuciondetalles.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Detalle Ejecucion') }}
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

										<th>Ejecucion</th>
										<th>Periodo</th>
										<th>Institucion</th>
										<th>Sector</th>
										<th>Programa</th>
										<th>Subprograma</th>
										<th>Proyecto</th>
										<th>Actividad</th>
										<th>Cuenta</th>
										<th>Financiamiento</th>
										<th>Inicial</th>
										<th>Aumento</th>
										<th>Disminucion</th>
										<th>Compromisos</th>
										<th>Causados</th>
										<th>Pagados</th>
										<th>Usuario</th>
										<th>Unidad Ejecutora</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ejecuciondetalles as $ejecuciondetalle)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $ejecuciondetalle->ejecucion_id }}</td>
											<td>{{ $ejecuciondetalle->periodofiscal }}</td>
											<td>{{ $ejecuciondetalle->institucion_id }}</td>
											<td>{{ $ejecuciondetalle->sector }}</td>
											<td>{{ $ejecuciondetalle->programa }}</td>
											<td>{{ $ejecuciondetalle->subprograma }}</td>
											<td>{{ $ejecuciondetalle->proyecto }}</td>
											<td>{{ $ejecuciondetalle->actividad }}</td>
											<td>{{ $ejecuciondetalle->cuenta }}</td>
											<td>{{ $ejecuciondetalle->financiamiento->nombre }}</td>
											<td>{{ $ejecuciondetalle->monto_inicial }}</td>
											<td>{{ $ejecuciondetalle->monto_aumento }}</td>
											<td>{{ $ejecuciondetalle->monto_disminucion }}</td>
											<td>{{ $ejecuciondetalle->monto_compromisos }}</td>
											<td>{{ $ejecuciondetalle->monto_causados }}</td>
											<td>{{ $ejecuciondetalle->monto_pagados }}</td>
											<td>{{ $ejecuciondetalle->logins }}</td>
											<td>{{ $ejecuciondetalle->unidadejecutora }}</td>

                                            <td>
                                                <form action="{{ route('ejecuciondetalles.destroy',$ejecuciondetalle->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ejecuciondetalles.show',$ejecuciondetalle->id) }}"><i class="fas fa-print"></i> Ver</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('ejecuciondetalles.edit',$ejecuciondetalle->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ejecuciondetalles->links() !!}
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
