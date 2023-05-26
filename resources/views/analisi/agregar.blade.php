@extends('adminlte::page')


@section('title', 'Analisis de Cotizacion')

@section('content_header')
    <h1>Analisis de Cotizacion EN EDICION</h1>
@stop

@section('content')

<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Analisis</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('analisis.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $analisi->unidadadministrativa->unidadejecutora }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Requisicion:</strong>
                            {{ $analisi->requisicione->correlativo }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Criterio:</strong>
                            {{ $analisi->criterio->nombre }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>No. Cotizacion:</strong>
                            {{ $analisi->numeracion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $analisi->observacion }}
                        </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Detalles de la requisicion -->
<!-- Agregamos la tabla detalles de la requisicion es decir las compras -->
<div class="container-fluid">
    <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Incluir precio unitario a los productos') }}
                            </span>

                             
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
<div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-hover  small table-bordered table-striped small">
                                <form method="POST" action="{{ route('detallesanalisis.storetres') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                                    
                             

                                <thead class="thead">

                                       <!-- Obtener el id del proveedor -->
<tr>
    <td colspan="4">
        <div class="col-md-12">
           <div class="form-group">
                {{ Form::label('proveedor') }}
                {{ Form::select('proveedor_id', $proveedores, null, ['class' => 'form-control' . ($errors->has('proveedor_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Proveedor']) }}
                {!! $errors->first('proveedor_id', '<div class="invalid-feedback">:message</div>') !!}
          
            </div>
            </div>
    </td>
</tr>

<!-- Fin Id del Proveedor -->



                                    <tr>
                                        <th style="text-align: center">ID</th>
                                        
										<th style="text-align: center">Descripcion del Producto BOS</th>
										<th style="text-align: center">Cantidad</th>

                                        <th style="text-align: center">Precio Unitario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      


                                    @foreach ($detallesrequisiciones as $detallesrequisicione)
                                        <tr>
                                            <td>{{ $detallesrequisicione->id }}
                                                {{ Form::hidden('precio[]', $detallesrequisicione->id, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                                            </td>
                                            
											<td>{{ $detallesrequisicione->bo->descripcion }}</td>
											<td>{{ $detallesrequisicione->cantidad }}</td>

                                            <td style="text-align: right">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        
                                                        {{ Form::text('precio[]', $GET['precio'] ?? NULL, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                                                        {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                                                    </div>
                                                    </div>

                                                  {{--  <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesanalisis.createwithbos', $detallesrequisicione->id) }}"><i class="fa fa-fw fa-edit"></i> Agregar</a>
                                                   --}}    @csrf
                                                
                                            </td>
                                        </tr>
                                    @endforeach

                                    

                                    <tr>
                                       
                                        <td style="text-align: right" colspan="4">
                                            <div class="box-footer mt20">
                                                <button type="submit" class="btn btn-primary submit-prevent-button">Crear En Sistema </button>
                                            </div>
                                            
                                        </td>
                                    </tr>

                                
                                </tbody>
                            </form>
                            </table>
                        </div>
                    </div>
                    </div>
                {!! $detallesrequisiciones->links() !!}
            </div>
        </div>
    </div>


<!-- Detalles Analisis -->
<div class="container-fluid">
<br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles analisis') }}
                            </span>

                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-hover  small table-bordered table-striped small">
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
                                            
											<td>{{ $detallesanalisi->beneficiario->nombre }}</td>
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
                                                    
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesanalisis.edit',$detallesanalisi->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Analisis"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button" data-toggle="tooltip" data-placement="top" title="Eliminar Analisis"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
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
