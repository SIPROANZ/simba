@extends('adminlte::page')


@section('title', 'Transferencia entre cuentas')

@section('content_header')
    <h1>Transferencia entre cuentas</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Transferencia entre cuenta</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('transferenciaentrecuentas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('transferenciaentrecuenta.form')

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
    document.getElementById('_bancosorigen').addEventListener('change',(e)=>{
        fetch('cuentasorigen',{
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
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].cuenta + ' SALDO: '+ data.lista[i].montosaldo +'</option>';
            }
            document.getElementById("_cuentasorigen").innerHTML = opciones;
        }).catch(error =>console.error(error));
    });


    //const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('_bancosdestino').addEventListener('change',(e)=>{
        fetch('cuentasdestino',{
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
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].cuenta + ' SALDO: '+ data.lista[i].montosaldo +'</option>';
            }
            document.getElementById("_cuentasdestino").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

</script>
@stop
