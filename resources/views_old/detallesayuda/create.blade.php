@extends('adminlte::page')

@section('title', 'Agregar Ayuda Social')

@section('content_header')
    <h1>Agregar Ayuda Social</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Detalles Ayuda</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detallesayudas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('detallesayuda.form')

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
    document.getElementById('_unidadadministrativa').addEventListener('change',(e)=>{
        fetch('ejecucion',{
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
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].clasificadorpresupuestario+' '+data.lista[i].denominacion+'</option>';
            }
            document.getElementById("_ejecucion").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

</script>
@stop
