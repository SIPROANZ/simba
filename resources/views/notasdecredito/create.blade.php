@extends('adminlte::page')

@section('title', 'Notas de Credito')

@section('content_header')
    <h1>Notas de Credito</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Notas de credito</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notasdecreditos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('notasdecredito.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('_bancos').addEventListener('change',(e)=>{
        fetch('cuentas',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].cuenta+'</option>';
            }
            document.getElementById("_cuentas").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

</script>
@stop
