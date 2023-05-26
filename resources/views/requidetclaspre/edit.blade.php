@extends('layouts.app')

@section('template_title')
    Update Requidetclaspre
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Requidetclaspre</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('requidetclaspres.update', $requidetclaspre->id) }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('requidetclaspre.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
