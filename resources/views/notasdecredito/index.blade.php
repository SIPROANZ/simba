@extends('adminlte::page')

@section('title', 'Notas de Credito')

@section('content_header')
    <h1>Notas de Credito</h1>
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
                                {{ __('Notas de credito') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notasdecreditos.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Nota de Credito') }}
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
                                        
										<th>Ejercicio</th>
										<th>Institucion</th>
										<th>Beneficiario</th>
										<th>Banco</th>
										<th>Cuenta bancaria</th>
										<th>Fecha</th>
										<th>Referencia</th>
										<th>Descripcion</th>
										<th>Monto</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notasdecreditos as $notasdecredito)
                                        <tr>
                                            <td>{{ $notasdecredito->id }}</td>
                                            
											<td>{{ $notasdecredito->ejercicio->ejercicioejecucion }}</td>
											<td>{{ $notasdecredito->institucione->institucion }}</td>
											<td>{{ $notasdecredito->beneficiario->nombre }}</td>
											<td>{{ $notasdecredito->banco->denominacion }}</td>
											<td>{{ $notasdecredito->cuentasbancaria->cuenta }}</td>
											<td>{{ $notasdecredito->fecha }}</td>
											<td>{{ $notasdecredito->referencia }}</td>
											<td>{!! $notasdecredito->descripcion !!}</td>
											<td>{{ number_format($notasdecredito->monto, 2 ,',','.') }}</td>

                                            <td>{{ $notasdecredito->usuario->name }}</td>
                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('notasdecreditos.pdf',$notasdecredito->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Nota de Credito" target="_black"><i class="fas fa-print"></i> Imprimir</a>
       
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('notasdecreditos.show',$notasdecredito->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('notasdecreditos.edit',$notasdecredito->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                @can('admin.reversar')
                                                <form action="{{ route('notasdecreditos.destroy',$notasdecredito->id) }}" method="POST" class="submit-prevent-form">
                                                @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $notasdecreditos->links() !!}
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
