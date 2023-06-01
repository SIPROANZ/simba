@extends('adminlte::page')


@section('title', 'Unidad Administrativa')

@section('content_header')
    <h1>Unidad Administrativa</h1>
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
                                <a href="{{ route('unidadadministrativas.reportes') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                    {{ __('Reportes') }}
                                  </a>
                                <a href="{{ route('unidadadministrativas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
                            <table class="table table-hover small table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                        <th class="text-center">Ejercicio</th>
										<th class="text-center">Sect-Prog-Subprog-Proy-Act</th>
										<th class="text-center">Denominación</th>
										<th class="text-center">Institucion</th>

                                        <th class="text-center">Descripción</th>


                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unidadadministrativas as $unidadadministrativa)
                                        <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $unidadadministrativa->ejercicio->ejercicioejecucion }}</td>
											<td class="text-center">{{ $unidadadministrativa->sector }}-{{ $unidadadministrativa->programa }}-{{ $unidadadministrativa->subprograma }}-{{ $unidadadministrativa->proyecto }}-{{ $unidadadministrativa->actividad }}
                                            </td>
											
                                            
											<td class="text-left"><b>Denominacion: </b>{{ $unidadadministrativa->denominacion }}<br>
                                            <b>Unidad Ejecutora: </b> {{ $unidadadministrativa->unidadejecutora }}
                                            </td>
                                            
											<td class="text-left">{{ $unidadadministrativa->institucione->institucion }}</td>
											
                                            <td class="text-left"><b>Descripcion: </b>{{ $unidadadministrativa->descripcion }}<br>
                                                <b>Nivel: </b>{{ $unidadadministrativa->nivel }}, 
                                                <b>Correo: </b>{{ $unidadadministrativa->email }}, 
                                                <b>Telefono: </b>{{ $unidadadministrativa->telefono }}, 
                                                <b>Inversion: </b>{{ $unidadadministrativa->inversion }}, 
                                                <b>Nivel Ejecutor: </b>{{ $unidadadministrativa->nivelejecutor }}
                                            
                                            </td>
                                       
                                            
                                            
                                            <td class="text-center">{{ $unidadadministrativa->usuario->name }}</td>

                                            <td class="text-center">
                                                                                                                                 <!-- =========================================================== -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ver </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                                <form action="{{ route('unidadadministrativas.destroy',$unidadadministrativa->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('unidadadministrativas.show',$unidadadministrativa->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('unidadadministrativas.edit',$unidadadministrativa->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button show-alert-delete-box"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                                                                                              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $unidadadministrativas->links() !!}
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
    <script src="{{ asset('js/alerta_eliminar.js') }}"></script>
    
    
    @stop
