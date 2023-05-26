@extends('adminlte::page')

@section('title', 'Modificaciones')

@section('content_header')
    <h1>Modificaciones</h1>
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
                                {{ __('Detalles modificacione') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesmodificaciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                                        
										<th>Modificacion Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Montoacredita</th>
										<th>Montodebita</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesmodificacione->modificacion_id }}</td>
											<td>{{ $detallesmodificacione->unidadadministrativa_id }}</td>
											<td>{{ $detallesmodificacione->ejecucion_id }}</td>
											<td>{{ $detallesmodificacione->montoacredita }}</td>
											<td>{{ $detallesmodificacione->montodebita }}</td>

                                            <td>
                                                <form action="{{ route('detallesmodificaciones.destroy',$detallesmodificacione->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block " href="{{ route('detallesmodificaciones.show',$detallesmodificacione->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('detallesmodificaciones.edit',$detallesmodificacione->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
