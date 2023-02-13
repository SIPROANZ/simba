@extends('adminlte::page')


@section('title', 'Ordenes de Compras')

@section('content_header')
    <h1>Ordenes de Compras</h1>
@stop
@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Orden de Compra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compras.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="form-group">
                            <strong>NUMERO ORDEN DE COMPRA:</strong>
                            {{ $compra->numordencompra }}
                        </div>
                      

                        <div class="form-group">
                            <strong>NUMERO DE REQUISICION:</strong>
                            {{ $correlativo }}
                        </div>

                        <div class="form-group">
                            <strong>RAZON SOCIAL:</strong>
                            {{ $razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>RIF:</strong>
                            {{ $rif }}
                        </div>

                        <div class="form-group">
                            <strong>SECTOR:</strong>
                            {{ $sector }}
                        </div>

                        <div class="form-group">
                            <strong>SUB-SECTOR:</strong>
                            {{ $sub_sector }}
                        </div>

                        <div class="form-group">
                            <strong>DEPARTAMENTO:</strong>
                            {{ $departamento }}
                        </div>

                        <div class="form-group">
                            <strong>USO DEL BIEN:</strong>
                            {{ $uso }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mostrar Analisis de la Orden de Compra -->
    <!-- Detalles Analisis -->
<div class="container-fluid">
<br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles de la compra') }}
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <?php $subtotal=0; $iva=0; $total=0; ?>
                                    <tr>
                                        <th>No</th>
                                        
										
                                        
										<th>DESCRIPCION</th>
                                        <th>CANTIDAD</th>
										<th>PRECIO UNITARIO</th>
										<th>PRECIO TOTAL</th>
										
                                        

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesanalisis as $detallesanalisi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											
                                           
											<td>{{ $detallesanalisi->bo->descripcion }}</td>
                                            <td>{{ $detallesanalisi->cantidad }}</td>
											
											<td>{{ $detallesanalisi->precio }}</td>
											<td>{{ $detallesanalisi->subtotal }}
                                            <?php 
                                                $subtotal+=$detallesanalisi->subtotal;
                                                $iva+=$detallesanalisi->iva;
                                                $total+=$detallesanalisi->total;
                                            ?>
                                            </td>
											
                                            
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th></th>
                                        
										
										<th></th>
										<th></th>
										<th>SUB TOTAL</th>
										<th>{{ $subtotal }}</th>
										
                                        
                                    </tr>
                                    <tr>
                                        <th></th>
                                        
										
										<th></th>
										<th></th>
										<th>I.V.A.</th>
										<th>{{ $iva }}</th>
										
                                        
                                    </tr>
                                    <tr>
                                        <th></th>
                                        
										
										<th></th>
										<th></th>
										<th>TOTAL</th>
										<th>{{ $total }}</th>
										
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesanalisis->links() !!}
            </div>
        </div>
    </div>
    <!-- Fin Analisis -->

    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clasificador Presupuestario') }}
                            </span>

                             <div class="float-right">
                               
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
                                        
										
										<th>SECTOR-SUBSECT-SUBPROG-PROY-ACT</th>
										<th>PART-GEN-ESP-SUBESP</th>
										<th>ASIGN. BS</th>
										<th>DISPONIBLE</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprascps as $comprascp)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $comprascp->unidadadministrativa->sector .'-'. $comprascp->unidadadministrativa->programa .'-' .$comprascp->unidadadministrativa->subprograma .'-' . $comprascp->unidadadministrativa->proyecto .'-' . $comprascp->unidadadministrativa->actividad .'-' . $comprascp->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $comprascp->ejecucione->clasificadorpresupuestario }}</td>
											<td>{{ $comprascp->monto }}</td>
											<td>{{ $comprascp->disponible }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-success" href="{{ route('comprascps.edit',$comprascp->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                   
                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $comprascps->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
