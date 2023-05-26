@extends('adminlte::page')


@section('title', 'Detalles Analisis')

@section('content_header')
    <h1>Detalles Analisis</h1>
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
                                {{ __('Detalles analisis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesanalisis.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Detalle Analisis') }}
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
                                        
										<th>Proveedor</th>
										<th>Analisis</th>
										<th>Bos</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Subtotal</th>
										<th>Iva</th>
										<th>Total</th>
                                        <th>Aprobado</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesanalisis as $detallesanalisi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesanalisi->proveedore->nombre }}</td>
											<td>{{ $detallesanalisi->analisi->numeracion }}</td>
											<td>{{ $detallesanalisi->bo->descripcion }}</td>
											<td>{{ $detallesanalisi->cantidad }}</td>
											<td>{{ $detallesanalisi->precio }}</td>
											<td>{{ $detallesanalisi->subtotal }}</td>
											<td>{{ $detallesanalisi->iva }}</td>
											<td>{{ $detallesanalisi->total }}</td>
                                            <td>{{ $detallesanalisi->aprobado }}</td>

                                            <td>
                                                <form action="{{ route('detallesanalisis.destroy',$detallesanalisi->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesanalisis.show',$detallesanalisi->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesanalisis.edit',$detallesanalisi->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesanalisis->links() !!}
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
