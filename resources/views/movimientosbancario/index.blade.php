@extends('adminlte::page')


@section('title', 'Movimientos Bancarios')

@section('content_header')
    <h1>Movimientos Bancarios</h1>
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
                                {{ __('Movimientos bancario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('movimientosbancarios.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo') }}
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
										<th>Cuentas bancaria</th>
										<th>Beneficiario</th>
										<th>Tipo movimiento</th>
										<th>Referencia</th>
										<th>Descripcion</th>
										<th>Fecha</th>
										<th>Monto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientosbancarios as $movimientosbancario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $movimientosbancario->ejercicio->nombreejercicio }}</td>
											<td>{{ $movimientosbancario->institucione->institucion }}</td>
											<td>{{ $movimientosbancario->cuentasbancaria->cuenta }}</td>
											<td>{{ $movimientosbancario->beneficiario->nombre }}</td>
											<td>{{ $movimientosbancario->tipomovimiento->descripcion }}</td>
											<td>{{ $movimientosbancario->referencia }}</td>
											<td>{{ $movimientosbancario->descripcion }}</td>
											<td>{{ $movimientosbancario->fecha }}</td>
											<td>{{ $movimientosbancario->monto }}</td>

                                            <td>
                                                <form action="{{ route('movimientosbancarios.destroy',$movimientosbancario->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('movimientosbancarios.show',$movimientosbancario->id) }}"><i class="fas fa-print"></i> </a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('movimientosbancarios.edit',$movimientosbancario->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $movimientosbancarios->links() !!}
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
