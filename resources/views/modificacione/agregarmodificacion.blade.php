@extends('adminlte::page')

@section('title', 'Modificaciones')

@section('content_header')
    <h1>Modificaciones</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Modificacion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('modificaciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Numero:</strong>
                            {{ $modificacione->numero }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Tipo modificacion:</strong>
                            {{ $modificacione->tipomodificacione->nombre }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $modificacione->descripcion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $modificacione->status }}
                        </div>
                        </div>

                       

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto acredita:</strong>
                            {{ number_format($modificacione->montocredita,2,',' ,'.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto debita:</strong>
                            {{ number_format($modificacione->montodebita,2,',' ,'.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Numero de credito:</strong>
                            {{ $modificacione->ncredito }}
                        </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles modificacion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesmodificaciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar detalle') }}
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
                                        <th>No</th>
                                        
										<th>Modificacion</th>
										<th>Unidad administrativa</th>
                                        <th>financiamiento</th>
										<th>Cuenta</th>
										<th>Monto acredita</th>
										<th>Monto debita</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesmodificacione->modificacione->numero }}</td>
											<td>{{ $detallesmodificacione->unidadadministrativa->unidadejecutora }}</td>
                                            <td>{{ $detallesmodificacione->financiamiento }}</td>
											<td>{{ $detallesmodificacione->ejecucione->clasificadorpresupuestario }}</td>
											<td>{{ number_format($detallesmodificacione->montoacredita,2,',' ,'.') }}</td>
											<td>{{ number_format($detallesmodificacione->montodebita,2,',' ,'.') }}</td>

                                            <td>
                                                <form action="{{ route('detallesmodificaciones.destroy',$detallesmodificacione->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('detallesmodificaciones.edit',$detallesmodificacione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesmodificaciones->links() !!}
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
