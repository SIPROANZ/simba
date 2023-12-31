@extends('adminlte::page')

@section('title', 'Transferencias')

@section('content_header')
    <h1>Transferencias en Proceso</h1>
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

                             <a href="{{ route('transferencias.agregartransferencia') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Transferencia') }}
                                </a>

                                <a href="{{ route('transferencias.agregar') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('transferencias.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Emitidas') }}
                                </a>

                                <a href="{{ route('pagados.anulados') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>

										<th>Orden de pago</th>
										<th>Beneficiario</th>{{--
										<th>Monto pagado</th>
                                        <th>Correlativo</th>
										<th>Fechaanulacion</th> --}}
										<th>Tipo de orden</th>
                                        <th>Tipo de Pago</th>
                                        <th>Estado</th>


                                        <th></th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagados as $pagado)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $pagado->ordenpago_id }}</td>
											<td>{{ $pagado->beneficiario->nombre }}</td>{{--
											<td>{{ $pagado->montopagado }}</td>
                                            <td>{{ $pagado->correlativo }}</td>
											<td>{{ $pagado->fechaanulacion }}</td> --}}
											<td>{{ $pagado->tipoordenpago }}</td>
                                            <td>{{ $pagado->tipomovimiento->descripcion }}</td>
                                            <td>{{ $pagado->status }}</td>

                                            <td>
                                                <div class="row">

                                                <td>
                                                <form action="{{ route('transferencias.aprobar',$transferencia->id) }}" method="POST" class="submit-prevent-form">

                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('transferencias.show',$transferencia->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar transferencias"><i class="fas fa-print"></i></a>

                                                   @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-outline-dark btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Aprobar transferencias"><i class="fas fa-check-double"></i></button>
                                                </form>

                                            </td>


                                               </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pagados->links() !!}
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
