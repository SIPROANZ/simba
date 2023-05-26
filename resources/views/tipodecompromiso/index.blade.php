@extends('adminlte::page')


@section('title', 'Orden de Pago')

@section('content_header')
    <h1>Orden de Pago</h1>
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
                                {{ __('Tipos de compromisos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipodecompromisos.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Tipo de Compromiso') }}
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
                                        
										<th>Nombre del compromiso</th>

                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipodecompromisos as $tipodecompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tipodecompromiso->nombre }}</td>

                                            <td>{{ $tipodecompromiso->usuario->name }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('tipodecompromisos.show',$tipodecompromiso->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('tipodecompromisos.edit',$tipodecompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                  {{--                                                <form action="{{ route('tipodecompromisos.destroy',$tipodecompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                                --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tipodecompromisos->links() !!}
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
