@extends('layouts.app')

@section('template_title')
    Ejecuciondetalle
@endsection

@section('content')
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
                                <a href="{{ route('ejecuciondetalles.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
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
                                                <form action="{{ route('ejecuciondetalles.destroy',$ejecuciondetalle->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ejecuciondetalles.show',$ejecuciondetalle->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ejecuciondetalles.edit',$ejecuciondetalle->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $ejecuciondetalles->links() !!}
            </div>
        </div>
    </div>
@endsection
