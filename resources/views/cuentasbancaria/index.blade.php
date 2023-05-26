@extends('adminlte::page')

@section('title', 'Cuentas Bancarias')

@section('content_header')
    <h1>Cuentas Bancarias</h1>
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
                                {{ __('Cuentas bancarias') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cuentasbancarias.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo cuenta') }}
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
                                        <th style="text-align: left">No</th>

										<th style="text-align: left">Banco</th>
										<th style="text-align: left">Institucion</th>
										<th style="text-align: left">Fecha apertura</th>
										<th style="text-align: left">Monto apertura</th>
										<th style="text-align: left">Monto saldo</th>
										<th style="text-align: left">Cuenta</th>
										<th style="text-align: left">Descripcion</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuentasbancarias as $cuentasbancaria)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td style="text-align: left">{{ $cuentasbancaria->banco->denominacion }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->institucione->institucion}}</td>
											<td style="text-align: left">{{ $cuentasbancaria->fechaapertura }}</td>
											<td style="text-align: left">{{ number_format($cuentasbancaria->montoapertura,2,',','.') }}</td>
											<td style="text-align: left">{{ number_format($cuentasbancaria->montosaldo,2,',','.') }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->cuenta }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->descripcion }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('cuentasbancarias.show',$cuentasbancaria->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                             <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('cuentasbancarias.edit',$cuentasbancaria->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                  @can('admin.reversar')  
                                                <form action="{{ route('cuentasbancarias.destroy',$cuentasbancaria->id) }}" method="POST" class="submit-prevent-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Borrar</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $cuentasbancarias->links() !!}
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
