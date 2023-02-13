@extends('adminlte::page')

@section('title', 'Precompromisos En Proceso')

@section('content_header')
    <h1>Precompromisos En Proceso</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Precompromiso') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('precompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Precompromiso') }}
                                </a>
                                <a href="{{ route('precompromisos.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>
                                <a href="{{ route('precompromisos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('precompromisos.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('precompromisos.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>No. Precompromiso</th>
										<th>Documento</th>
										<th>Monto total</th>
										<th>Concepto</th>
										<th>Fecha anulacion</th>
										<th>Unidad administrativa</th>
										<th>Tipo compromiso</th>
										<th>Beneficiario</th>
                                        <th>Estado</th>


                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($precompromisos as $precompromiso)

                                    @if ($precompromiso->status == 'EP')
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $precompromiso->id }}</td>
                                            
											<td>{{ $precompromiso->documento }}</td>
											<td>{{ number_format($precompromiso->montototal,2,',','.') }}</td>
											<td>{{ $precompromiso->concepto }}</td>
											<td>{{ $precompromiso->fechaanulacion }}</td>
											<td>{{ $precompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $precompromiso->tipodecompromiso->nombre}}</td>
											<td>{{ $precompromiso->beneficiario->nombre }}</td>
                                            <td>@if ($precompromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($precompromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($precompromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($precompromiso->status == 'AN')
                                                    ANULADA
                                                @endif</td>

                                            <td>
                                                <form action="{{ route('precompromisos.anular',$precompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('precompromisos.agregar',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Detalles"><i class="fas fa-outdent"></i></i></a>
                                                      
                                                    <a class="btn btn-sm btn-success" href="{{ route('precompromisos.edit',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Precompromiso"><i class="fa fa-fw fa-edit"></i></a>
                                     
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Precompromiso"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                                <form action="{{ route('precompromisos.aprobar',$precompromiso->id) }}" method="POST">
                                                    
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm formulario-aprobar" data-toggle="tooltip" data-placement="top" title="Aprobar Precompromiso"><i class="fas fa-check-double"></i></button>
                                                </form> 

                                                <a class="btn btn-sm btn-primary " href="{{ route('precompromisos.pdf',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Precompromiso"><i class="fas fa-print"></i></a>
                                           
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $precompromisos->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@if(session('aprobar') == 'ok')
<script>
    Swal.fire(
      'Aprobado!',
      'El registro se aprobo satisfactoriamente.',
      'success'
    ) 
    </script>
@endif
  <script>
  
  $('.formulario-aprobar').submit(function(e){
    e.preventDefault();

    Swal.fire({
  title: '¿Desea Aprobar el Precompromiso?',
  text: "Esta accion no se puede revertir una vez que usted haya dado aceptar!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Aceptar!',
  cancelButtonText: 'Cancelar!'
}).then((result) => {
  if (result.isConfirmed) {
  /*  Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    ) */

   // this.submit();
  }
})


  });


  </script>
@stop
