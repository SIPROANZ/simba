@extends('adminlte::page')


@section('title', 'Hijos')

@section('content_header')
    <h1>Hijos</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Hijo') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('hijos.reportes') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Reporte') }}
                                </a>
                                <a href="{{ route('hijos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        <th>ID</th>
                                        <th>Perfil</th>
										<th>Nombre</th>
                                        <th>Genero</th>
                                        <th>Fecha Nac.</th>
                                        <th>Edad</th>
										<th>Cedula</th>
										
										<th>Imagen Cedula</th>
										<th>Imagen Partida</th>
										<th>Representante</th>
                                        <th>Perfil Representante</th>
										<th>Observacion</th>
                                        <th>Usuario</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hijos as $hijo)
                                        <tr>
                                            <td>{{ $hijo->id }}</td>
                                            <td><img src="{{ asset ($hijo->imagen) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="Imagen de perfil del hijo del empleado"></td>
											
											<td>{{ $hijo->nombre }}</td>
                                            <td>{{ $hijo->genero }}</td>
                                            <td>{{ $hijo->created_at->toDateString() }}</td>
                                            <td>
                                            {{ $obj_carbon->createFromDate($obj_carbon->parse($hijo->created_at))->age }}
                                            </td>
											<td>{{ $hijo->cedula }}</td>
											
											<td>
                                            <img src="{{ asset ($hijo->anexocedula) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="Imagen de la cédula del hijo">    
                                            </td>
											<td><img src="{{ asset ($hijo->anexopartida) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="Imagen de la partida de nacimiento">    
                                            </td>
											<td>{{ $hijo->representante->nombre }}<br>
                                                {{ $hijo->cedularepresentante }}
                                                {{ $hijo->representante->unidade->nombre }} <br>
                                                {{ $hijo->representante->unidade->gabinete->nombre }} <br>
                                            </td>


                                                <td>
                                                <img src="{{ asset ($hijo->representante->imagen) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt="Imagen de perfil del representante">
                                                </td>



											<td>{{ $hijo->observacion }}</td>
                                            <td>{{ $hijo->usuario->name }}</td>

                                            <td>
                                                <form action="{{ route('hijos.destroy',$hijo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block " href="{{ route('hijos.carnet',$hijo->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Carnet" target="_black"><i class="fas fa-print"></i> Carnet</a>
   
                                                    <a class="btn btn-sm btn-primary " href="{{ route('hijos.show',$hijo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('hijos.edit',$hijo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $hijos->links() !!}
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
