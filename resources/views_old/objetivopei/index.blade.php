@extends('adminlte::page')

@section('title', 'Objetivo PEI')

@section('content_header')
    <h1>Objetivo PEI</h1>
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
                                {{ __('Objetivos Plan Estratégico Institucional') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('objetivopeis.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Objetivo PEI') }}
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
                                        <th>No</th>

										<th>Numeral</th>
										<th>Objetivo PEI</th>
										<th>Objetivo Municipal</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objetivopeis as $objetivopei)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $objetivopei->objetivopei }}</td>
											<td>{{ $objetivopei->objetivo }}</td>
											<td>{{ $objetivopei->objetivomunicipale->objetivo }}</td>

                                            <td>
                                                <form action="{{ route('objetivopeis.destroy',$objetivopei->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('objetivopeis.show',$objetivopei->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('objetivopeis.edit',$objetivopei->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $objetivopeis->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
