@extends('adminlte::page')

@section('title', 'Instituciones y Entes')

@section('content_header')
    <h1>Instituciones y Entes</h1>
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
                             <a href="{{ route('instituciones.reportes') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Reportes') }}
                                </a>
                                <a href="{{ route('instituciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                  <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Logo</th>
										<th>Rif</th>
										<th>Institución</th>
                                        <th>Razon Social</th>
										<th>Municipio</th>
										<th>Dirección</th>
										<th>Teléfono</th>
										<th>Email</th>
										<th>Pagina Web</th>
										<th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instituciones as $institucione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $institucione->logoinstitucion }}</td>
											<td>{{ $institucione->rif }}</td>

											<td>{{ $institucione->institucion }}</td>
                                            <td>{{ $institucione->razonsocial }}</td>
											<td>{{ $institucione->municipio->nombre }}</td>
											<td>{!! $institucione->direccion !!}</td>
											<td>{!!$institucione->telefono !!}</td>
											<td>{{ $institucione->email }}</td>
											<td>{{ $institucione->web }}</td>
                                            <td>
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
                                                <form action="{{ route('instituciones.destroy',$institucione->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('instituciones.show',$institucione->id) }}"><i class="fas fa-print"></i> Ver</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('instituciones.edit',$institucione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
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
                {!! $instituciones->links() !!}
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
