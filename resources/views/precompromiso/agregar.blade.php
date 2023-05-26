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
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precompromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-12"> 
                            <div class="form-group">
                                <strong>Concepto:</strong>
                                {!! $precompromiso->concepto !!}
                            </div>
                        </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                <strong>Documento:</strong>
                                {{ $precompromiso->documento }}
                            </div>
                        </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                <strong>Monto total:</strong>
                                {{ number_format($precompromiso->montototal,2,',','.') }}
                            </div>
                        </div>
                           
                            <div class="col-md-3">
                            <div class="form-group">
                                <strong>Fecha:</strong>
                                {{ $precompromiso->created_at }}
                            </div>
                        </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                <strong>Unidad administrativa:</strong>
                                {{ $precompromiso->unidadadministrativa->unidadejecutora }}
                            </div>
                        </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                <strong>Tipo compromiso:</strong>
                                {{ $precompromiso->tipodecompromiso->nombre }}
                            </div>
                        </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                <strong>Beneficiario:</strong>
                                {{ $precompromiso->beneficiario->nombre }}
                            </div>
                        </div>

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
                                <a href="{{ route('detallesprecompromisos.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar Imputacion!') }}
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
                                        
										<th>Monto compromiso</th>
										<th>Precompromiso</th>
										<th>Unidadadministrativa</th>
										<th>Clasificador</th>
                                        <th>Financiamiento</th>

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
											<td>{!! $detallesprecompromiso->precompromiso->concepto !!}</td>
											<td>{{ $detallesprecompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallesprecompromiso->ejecucione->clasificadorpresupuestario }}</td>
                                            <td>{{ $detallesprecompromiso->financiamiento }}</td>

                                            <td>
                                                <form action="{{ route('detallesprecompromisos.destroy',$detallesprecompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesprecompromisos.edit',$detallesprecompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $detallesprecompromisos->links() !!}
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