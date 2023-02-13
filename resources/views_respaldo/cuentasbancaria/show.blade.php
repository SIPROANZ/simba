@extends('layouts.app')

@section('template_title')
    {{ $cuentasbancaria->name ?? 'Show Cuentasbancaria' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Cuentas bancaria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuentasbancarias.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Banco:</strong>
                            {{ $cuentasbancaria->banco_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $cuentasbancaria->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha apertura:</strong>
                            {{ $cuentasbancaria->fechaapertura }}
                        </div>
                        <div class="form-group">
                            <strong>Monto apertura:</strong>
                            {{ $cuentasbancaria->montoapertura }}
                        </div>
                        <div class="form-group">
                            <strong>Monto saldo:</strong>
                            {{ $cuentasbancaria->montosaldo }}
                        </div>
                        <div class="form-group">
                            <strong>Cuenta:</strong>
                            {{ $cuentasbancaria->cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $cuentasbancaria->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
