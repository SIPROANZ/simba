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
                            {{ $ordenpago->compromiso->ncompromiso }}
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
                            {{ number_format($ordenpago->montobase,2,',','.') }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto retencion:</strong>
                            {{ number_format($ordenpago->montoretencion,2,',','.') }}
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
                            {{ number_format($ordenpago->montoiva,2,',','.') }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto exento:</strong>
                            {{ number_format($ordenpago->montoexento,2,',','.') }}
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto neto:</strong>
                            {{ number_format($ordenpago->montoneto,2,',','.') }}
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
                                <a href="{{ route('facturas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                  <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        
                                        
										<th>Orden pago</th>
										<th>Numero Factura</th>
										<th>Numero Control</th>
										<th>Fecha</th>
										<th>Monto base</th>
										<th>Monto iva</th>
										<th>Monto total</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
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
                                            <td>{{ $factura->usuario->name }}</td>

                                            <td>
                                                <form action="{{ route('facturas.destroy',$factura->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('facturas.show',$factura->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('facturas.edit',$factura->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $facturas->links() !!}
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
