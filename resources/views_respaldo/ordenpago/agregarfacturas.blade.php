@extends('adminlte::page')


@section('title', 'Orden de Pago')

@section('content_header')
    <h1>Orden de Pago</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalles Orden de pago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ordenpagos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                    <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <strong>N° Orden de Pago:</strong>
                            {{ $ordenpago->nordenpago }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>N° Compromiso:</strong>
                            {{ $ordenpago->compromiso_id }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ordenpago->beneficiario->nombre }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto base:</strong>
                            {{ $ordenpago->montobase }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto retencion:</strong>
                            {{ $ordenpago->montoretencion }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        {{-- <div class="form-group">
                            <strong>Fecha anulacion:</strong>
                            {{ $ordenpago->fechaanulacion }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $ordenpago->status }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Tipo orden:</strong>
                            {{ $ordenpago->tipoorden }}
                        </div> --}}
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto IVA:</strong>
                            {{ $ordenpago->montoiva }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto exento:</strong>
                            {{ $ordenpago->montoexento }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto neto:</strong>
                            {{ $ordenpago->montoneto }}
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Agregamos la tabla detalles de retencion -->
<div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Factura') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('facturas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar factura') }}
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
                                        
                                        
										<th>Orden pago</th>
										<th>Numero Factura</th>
										<th>Numero Control</th>
										<th>Fecha</th>
										<th>Montobase</th>
										<th>Montoiva</th>
										<th>Montototal</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            
                                            
											<td>{{ $factura->ordenpago_id }}</td>
											<td>{{ $factura->numero_factura }}</td>
											<td>{{ $factura->numero_control }}</td>
											<td>{{ $factura->fecha }}</td>
											<td>{{ $factura->montobase }}</td>
											<td>{{ $factura->montoiva }}</td>
											<td>{{ $factura->montototal }}</td>

                                            <td>
                                                <form action="{{ route('facturas.destroy',$factura->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('facturas.show',$factura->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('facturas.edit',$factura->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $facturas->links() !!}
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
