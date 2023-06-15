@extends('adminlte::page')

@section('title', 'Rutas')

@section('content_header')
    

    <div class="container-fluid">

    

        <div class="row">



            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('RUTA DEL REGISTRO ADMINISTRATIVO') }}
                            </span>

                             
                        </div>
                    </div>
                   

                    <div class="card-body">

        


                        <div class="table-responsive">
                        <table class="table table-hover small table-bordered table-striped">
        <thead class="thead">
            <tr>
              <th style="width:25%">PRECOMPROMISO</th>
              <th style="width:25%">COMPROMISO</th>                     
              <th style="width:25%">CAUSADO</th>
              <th style="width:25%">PAGADO</th>
            </tr>
        </thead>
        <tbody>
        
        <tr>
       
            <td>
            <strong>ESTADO:</strong> {{ $datos['estado']}} <br>
            <strong>CORRELATIVO:</strong> {{ $datos['correlativo']}} <br>
            <strong>TIPO:</strong> {{ $datos['tipo']}} <br>
            <strong>CREADO:</strong> {{ $datos['creado']}}  <br>
            <strong>MODIFICADO:</strong> {{ $datos['modificado']}}  <br>
            <strong>ELABORADO:</strong> {{ $datos['elaborado']}} <br>
            <strong>ID:</strong> {{ $datos['id']}} <br>
            <strong>CONCEPTO:</strong>  {{ $datos['concepto']}}  <br>
            {!! $datos['beneficiario'] !!} <br>
            {!! $datos['monto_total'] !!} 
      
            </td>

            <td>
            <strong>MONTO:</strong> {{ $datos['monto_compromiso']}} <br>
            <strong>BENEFICIARIO:</strong> {{ $datos['beneficiario_compromiso']}} <br>
            <strong>ESTADO:</strong> {{ $datos['estado_compromiso']}} <br>
            <strong>CORRELATIVO:</strong> {{ $datos['correlativo_compromiso']}} <br>
            <strong>CREADO:</strong> {{ $datos['creado_compromiso']}}  <br>
            <strong>MODIFICADO:</strong> {{ $datos['modificado_compromiso']}}  <br>
            <strong>ELABORADO:</strong> {{ $datos['elaborado_compromiso']}} <br>
            <strong>ID COMPROMISO:</strong> {{ $datos['compromiso']}}  <br>
            
            {!! $datos['analisis'] !!} <br>
            {!! $datos['ordenCompra'] !!} <br>
            {!! $datos['correlativoCompra'] !!} <br>
      
            </td>
            <td>
            <strong>MONTO:</strong> {{ $datos['monto_causado']}} <br>
            <strong>BENEFICIARIO:</strong> {{ $datos['beneficiario_causado']}} <br>
            <strong>ESTADO:</strong> {{ $datos['estado_causado']}} <br>
            <strong>CORRELATIVO:</strong> {{ $datos['correlativo_causado']}} <br>
            <strong>CREADO:</strong> {{ $datos['creado_causado']}}  <br>
            <strong>MODIFICADO:</strong> {{ $datos['modificado_causado']}}  <br>
            <strong>ELABORADO:</strong> {{ $datos['elaborado_causado']}} <br>
            <strong>ID CAUSADO:</strong> {{ $datos['causado']}}  <br>
      
            </td>
            <td>
            <strong>MONTO PAGADO:</strong> {{ $datos['monto_pagado']}} <br>
            <strong>MONTO RESTANTE:</strong> {{ $datos['monto_restante']}} <br>
            <strong>BENEFICIARIO:</strong> {{ $datos['beneficiario_pagado']}} <br>
            <strong>ESTADO:</strong> {{ $datos['estado_pagado']}} <br>
            <strong>CORRELATIVO:</strong> {{ $datos['correlativo_pagado']}} <br>
            <strong>CREADO:</strong> {{ $datos['creado_pagado']}}  <br>
            <strong>MODIFICADO:</strong> {{ $datos['modificado_pagado']}}  <br>
            <strong>ELABORADO:</strong> {{ $datos['elaborado_pagado']}} <br>
            <strong>ID PAGADO:</strong> {{ $datos['pagado']}}  <br>
      
            </td>
				</tr>



         
       
       </tbody>
     </table>
                        
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

@stop





 @section('css')
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
@stop
    
  
