@extends('layouts.app')

@section('template_title')
    Update Segmento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Segmento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('segmentos.update', $segmento->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('segmento.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
