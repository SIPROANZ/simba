@extends('adminlte::page')


@section('title', 'Empleados')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Empleado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('empleados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
                                        <th>Perfil</th>
										<th>Nombre</th>
										<th>Cedula</th>
                                        <th>Fecha Nac.</th>
                                        <th>Edad</th>
										<th>Genero</th>
										<th>Telefono</th>
										<th>Tipo</th>
										<th>Unidad</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleados as $empleado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td></td>
											<td>{{ $empleado->nombre }}</td>
											<td>{{ $empleado->cedula }}</td>
                                            <td><td>{{ $empleado->created_at->toDateString() }}</td></td>
                                            <td></td>
											<td>{{ $empleado->genero }}</td>
											<td>{{ $empleado->telefono }}</td>
											<td>{{ $empleado->tipo }}</td>
											<td>{{ $empleado->unidade->nombre }}</td>
                                            <td>{{ $empleado->usuario->name }}</td>

                                            <td>
                                                <form action="{{ route('empleados.destroy',$empleado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('empleados.show',$empleado->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('empleados.edit',$empleado->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $empleados->links() !!}
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
