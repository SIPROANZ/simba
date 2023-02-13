@extends('adminlte::page')


@section('title', 'Transferencia entre cuentas')

@section('content_header')
    <h1>Transferencia entre cuentas</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Transferencia entre cuenta</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('transferenciaentrecuentas.update', $transferenciaentrecuenta->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('transferenciaentrecuenta.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
