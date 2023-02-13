@extends('adminlte::page')

@section('template_title')
    Update Detallesajuste
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Procesar Ajuste</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detallesajustes.update', $detallesajuste->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detallesajuste.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
