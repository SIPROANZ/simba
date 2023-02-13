@extends('adminlte::page')

@section('title', 'Agregar Precompromisos Procesados')

@section('content_header')
    <h1>Precompromisos</h1>
@stop


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Precompromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precompromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $precompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Montototal:</strong>
                            {{ number_format($precompromiso->montototal,2,',','.') }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $precompromiso->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $precompromiso->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa:</strong>
                            {{ $precompromiso->unidadadministrativa->unidadejecutora }}
                        </div>
                        <div class="form-group">
                            <strong>Tipocompromiso:</strong>
                            {{ $precompromiso->tipodecompromiso->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $precompromiso->beneficiario->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles precompromiso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesprecompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar Imputacion') }}
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
                                        
										<th>Monto compromiso</th>
										<th>Precompromiso</th>
										<th>Unidadadministrativa</th>
										<th>Clasificador Presupuestario</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesprecompromisos as $detallesprecompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>
                                            {{ number_format($detallesprecompromiso->montocompromiso,2,',','.') }}
                                            </td>
											<td>{{ $detallesprecompromiso->precompromiso->concepto }}</td>
											<td>{{ $detallesprecompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallesprecompromiso->ejecucione->clasificadorpresupuestario }}</td>

                                            <td>
                                                <form action="{{ route('detallesprecompromisos.destroy',$detallesprecompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesprecompromisos.edit',$detallesprecompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $detallesprecompromisos->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop