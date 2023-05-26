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
                            <span class="card-title">Ver Orden de pago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ordenpagos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                    <div class="row">
        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>N° Orden de Pago:</strong>
                            {{ $ordenpago->nordenpago }}
                        </div>
                        </div>

                        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>N° Compromiso:</strong>
                            {{ $ordenpago->compromiso->ncompromiso }}
                        </div>
                        </div>

                        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ordenpago->beneficiario->nombre }}
                        </div>
                        </div>

                        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>Monto base:</strong>
                            {{ number_format($ordenpago->montobase,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>Monto retencion:</strong>
                            {{ number_format($ordenpago->montoretencion,2,',','.') }}
                        </div>
                        </div>

                       
                        {{-- <div class="form-group">
                            <strong>Fecha anulacion:</strong>
                            {{ $ordenpago->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $ordenpago->status }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo orden:</strong>
                            {{ $ordenpago->tipoorden }}
                        </div> --}}

                        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>Monto IVA:</strong>
                            {{ number_format($ordenpago->montoiva,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3"> 
                        <div class="form-group">
                            <strong>Monto exento:</strong>
                            {{ number_format($ordenpago->montoexento,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3"> 
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

                        <span id="card_title"> <strong>
                            {{ __('Detalle Retenciones Aplicadas') }}</strong>
                        </span>

{{--                          <div class="float-right">
                            <a href="{{ route('detalleretenciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                              {{ __('Agregar Retención') }}
                            </a>
                          </div> --}}
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
                                    <th>No</th>

                                    <th>Retención</th>
                                    <th>Monto Retenido</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleretenciones as $detalleretencione)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $detalleretencione->retencione->descripcion }}</td>
                                        <td>{{ number_format($detalleretencione->montoneto, 2,',','.') }}</td>

                                        <td>
{{--                                             <form action="{{ route('detalleretenciones.destroy',$detalleretencione->id) }}" method="POST" class="submit-prevent-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $detalleretenciones->links() !!}
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
