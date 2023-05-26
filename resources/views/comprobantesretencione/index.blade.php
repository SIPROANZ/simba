@extends('adminlte::page')

@section('title', 'Comprobantes de Retenciones')

@section('content_header')
    <h1>Comprobantes de Retenciones e Impuestos</h1>
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
                                {{ __(' ') }}
                            </span>

                             <div class="float-right">
                                {{--<a href="{{ route('comprobantesretenciones.create') }}" class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block"  data-placement="left">
                                  {{ __('Create New') }}
                                </a> --}}
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
                                        
										<th>Tipo retencion</th>
                                        <th>Beneficiario</th>
										<th>Orden pago</th>
									    <th>Monto retencion</th>
										<th>Status</th>
                                        <th>Opciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprobantesretenciones as $comprobantesretencione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $comprobantesretencione->detretencione->retencione->descripcion . ' ('.number_format($comprobantesretencione->detretencione->retencione->porcentaje, 2,',','.').'%) '.' - ' .$comprobantesretencione->tiporetencione->tipo }}</td>
											<td>{{ $comprobantesretencione->ordenpago->beneficiario->nombre }}</td>
                                            <td>{{ $comprobantesretencione->ordenpago->nordenpago }}</td>
											<td>{{ number_format($comprobantesretencione->montoretencion,2,',','.')}}</td>
											<td> 
                                                @if ($comprobantesretencione->status == 'EP')
                                                EN PROCESO
                                            @elseif ($comprobantesretencione->status == 'PR')
                                                PROCESADA
                                            @elseif ($comprobantesretencione->status == 'AP')
                                                ENTREGADO
                                            @elseif ($comprobantesretencione->status == 'AN')
                                                ANULADA
                                            @endif
                                            </td>

                                            <td>
                                               <!-- =====Menu Desplegable====================================================== -->

        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Ver  </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block " href="{{ route('comprobantesretenciones.show',$comprobantesretencione->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block " href="{{ route('comprobantesretenciones.islrpdf',$comprobantesretencione->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Comprobante de Retencion" target="_black"><i class="fa fa-fw fa-print"></i> Imprimir</a>
                                            <a class="btn btn-sm btn-block btn btn-outline-success  btn-blockbtn-block" href="{{ route('comprobantesretenciones.edit',$comprobantesretencione->id) }}"><i class="fa fa-fw fa-edit"></i> Procesar</a> 
                                                    {{--
                                                <form action="{{ route('comprobantesretenciones.destroy',$comprobantesretencione->id) }}" method="POST" class="submit-prevent-form">
                                                   <a class="btn btn-sm btn-block btn btn-outline-dark btn-blockbtn-block" href="{{ route('comprobantesretenciones.edit',$comprobantesretencione->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form> --}}
                                            </td>
                                                          <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
                                  
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $comprobantesretenciones->links() !!}
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
