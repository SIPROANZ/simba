@extends('layouts.app')

@section('template_title')
    Update Requidetbo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Requidetbo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('requidetbos.update', $requidetbo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('requidetbo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
