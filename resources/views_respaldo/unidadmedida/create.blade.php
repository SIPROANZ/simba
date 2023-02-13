@extends('layouts.app')

@section('template_title')
    Crear Unidad de Medida
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-6">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Unidad de Medida</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('unidadmedidas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('unidadmedida.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
