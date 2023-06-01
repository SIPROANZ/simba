@extends('adminlte::page')


@section('title', 'Tipo de Retenciones')

@section('content_header')
    <h1>Tipo de Retenciones</h1>
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
                                {{ __('Tipos de Retenciones') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tiporetenciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Tipo') }}
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

										<th>Tipo De Retenciones </th>

                                        <th> Opciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiporetenciones as $tiporetencione)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $tiporetencione->tipo }}</td>

                                            <td>
                                                             <!-- =====Menu Desplegable====================================================== -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ver  </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                                <form action="{{ route('tiporetenciones.destroy',$tiporetencione->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('tiporetenciones.show',$tiporetencione->id) }}"><i class="fas fa-print"></i> Ver</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('tiporetenciones.edit',$tiporetencione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-block btn btn-outline-danger btn-block submit-prevent-button show-alert-delete-box"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                                                                                                                                  <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tiporetenciones->links() !!}
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
