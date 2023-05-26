@extends('adminlte::page')


@section('title', 'Modificaciones')

@section('content_header')
    <h1>Modificaciones Presupuestarias Anuladas</h1>
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
                                <a href="{{ route('modificaciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Modificacion') }}
                                </a>
                                <a href="{{ route('modificaciones.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('modificaciones.procesadas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('modificaciones.anuladas') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                        
                                        
										<th>No Modificacion</th>
										<th>Tipo modificacion</th>
										<th>Descripcion</th>
										<th>Status</th>
										<th>Fecha anulacion</th>
										<th>Monto acredita</th>
										<th>Monto debita</th>
										<th>No credito</th>

                                        <th>usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modificaciones as $modificacione)
                                        <tr>
                                            
                                            
											<td>{{ $modificacione->numero }}</td>
											<td>{{ $modificacione->tipomodificacione->nombre }}</td>
											<td>{{ $modificacione->descripcion }}</td>
											<td>@if ($modificacione->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($modificacione->status == 'PR')
                                                    PROCESADA
                                                @elseif ($modificacione->status == 'AP')
                                                    APROBADA
                                                @elseif ($modificacione->status == 'AN')
                                                    ANULADA
                                                @endif</td>
											<td>{{ $modificacione->fechaanulacion }}</td>
											<td>{{ $modificacione->montocredita }}</td>
											<td>{{ $modificacione->montodebita }}</td>
											<td>{{ $modificacione->ncredito }}</td>

                                            <td>{{ $modificacione->usuario->name }}</td>

                                            <td>
                        
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block " href="{{ route('modificaciones.pdf',$modificacione->id) }}" target="_black" data-toggle="tooltip" data-placement="top" title="Imprimir Modificacion"><i class="fa fa-fw fa-print"></i> imprimir</a>
                         
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $modificaciones->links() !!}
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
