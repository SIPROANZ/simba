@extends('adminlte::page')

@section('title', 'Clasificador Presupuestario de la Compra')

@section('content_header')
    <h1>Clasificador Presupuestario de la Compra</h1>
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
                                {{ __('Modificar Clasificador Presupuestario de la Compra') }}
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
                            <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Compra Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Monto</th>
										<th>Disponible</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprascps as $comprascp)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $comprascp->compra_id }}</td>
											<td>{{ $comprascp->unidadadministrativa_id }}</td>
											<td>{{ $comprascp->ejecucion_id }}</td>
											<td>{{ $comprascp->monto }}</td>
											<td>{{ $comprascp->disponible }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('comprascps.edit',$comprascp->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>


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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
