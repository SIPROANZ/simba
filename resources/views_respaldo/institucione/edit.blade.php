@extends('layouts.app')

@section('template_title')
    Editar Institución
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Institución</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('instituciones.update', $institucione->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('institucione.form',["task" =>"edit"])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
