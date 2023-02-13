@extends('layouts.app')

@section('template_title')
    {{ $banco->name ?? 'Show Banco' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Banco</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bancos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Denominacion:</strong>
                            {{ $banco->denominacion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
