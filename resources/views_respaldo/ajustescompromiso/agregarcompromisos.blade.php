@extends('adminlte::page')

@section('template_title')
    Create Ajustescompromiso
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nuevo Ajustes de Compromiso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ajustescompromisos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('ajustescompromiso.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
