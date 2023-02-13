@extends('adminlte::page')

@section('title', 'Productos Clasificador presupuestario')

@section('content_header')
    <h1>Productos Clasificador presupuestario</h1>
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
                                {{ __('Producto Clasificador presupuestario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productoscps.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Producto Clasificador presupuestario') }}
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th style="text-align: center">No</th>

										<th style="text-align: center">Producto</th>
										<th style="text-align: center">Clasificador presupuestario</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productoscps as $productoscp)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td style="text-align: center">{{ $productoscp->producto->nombre }}</td>
											<td style="text-align: center">{{ $productoscp->clasificadorpresupuestario->denominacion}}</td>

                                            <td>
                                                <form action="{{ route('productoscps.destroy',$productoscp->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('productoscps.show',$productoscp->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('productoscps.edit',$productoscp->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $productoscps->links() !!}
            </div>
        </div>
    </div>

    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop