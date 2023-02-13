@extends('adminlte::page')

@section('template_title')
    {{ $ajustescompromiso->name ?? 'Show Ajustescompromiso' }}
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ajustes de compromisos</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ajustescompromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $ajustescompromiso->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Compromiso Numero:</strong>
                            {{ $ajustescompromiso->compromiso->ncompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ajustescompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ajustescompromiso->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Monto ajuste:</strong>
                            {{ $ajustescompromiso->montoajuste }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ajustes Compromisos') }}
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
                                        
										<th>Monto Ajuste</th>
										<th># Ajuste</th>
										<th>Unidad Administrativa</th>
										<th>Cuenta</th>

                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesajustes as $detallesajuste)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesajuste->montoajuste }}</td>
											<td>{{ $detallesajuste->ajustes_id }}</td>
											<td>{{ $detallesajuste->unidadadministrativa->denominacion }}</td>
											<td>{{ $detallesajuste->ejecucione->clasificadorpresupuestario }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-success" href="{{ route('detallesajustes.edit',$detallesajuste->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                   
                                              
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesajustes->links() !!}
            </div>
        </div>
    </div>
@endsection
