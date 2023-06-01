<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de ruta</title>

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    html, body {
    width: 95%;
    height: 100%;
    margin-top: 15px; 
    }
    img
    {
    width: 150px;
    height: 60px;
    }
    .titulo{
    font-size: 9px;
    margin-left: 15px; 
    font-family: Arial, sans-serif;
    
    }
   .titulo2{
    font-size: 13px;
    margin-left: 15px; 
    font-family: Arial, sans-serif;
    margin-top: 20px; 
    /*background-color:#0380FF;*/ 

    }
    .subtitulo{
    font-size: 19px; 
    margin:19px;
    }
    hr {
    height: 20px;
    width: 100%;
    /*background-color:#0380FF;*/
    background-color: #000000;
    }
    td{
    padding-left:15px;
    }
    .resumen1{
    margin-left:10px;
    }
    .resumen1 th{
    font-size: 11px;
    }
    .resumen1 td{
    font-size: 11px;
    }
    .resumen{
    margin-left:10px; 
    }
    .resumen th{
    font-size: 10px;
    }
    .resumen td{
    font-size: 10px;
    }
    P{
    font-size: 15px;  
    margin-left: 10px; 
    }
    .footer {
    text-align: center;
    justify-content: center;
    margin:auto;
    /*background-color: #F1C40F;*/
    position: fixed;
    width: 95%;
    height: 100px;
    bottom:0;
    margin-bottom:50px;
    margin-left:10px;
    }
    .lateral{
    height: 50px; 
    /*background-color: blue; */
    }

   .firma{
    font-size: 10px;
  }
  .pie{
    font-size: 8px;
    margin-left: 5px;  
    
  }
  .contenido{
    text-align: center;
    justify-content: center;
    
    margin-left:20px; 
  }

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
       <header>
            <section class="content container-fluid">
                <div class="row text-center justify-content">
                    <div class="col-md-12">  
                            <div class="float-left">
                                <img src="{{ asset('images/logo.png') }}"> 
                            </div> 
                    </div>
                    <div class="col-md-12">  
                            <div class="text-center justify-content">
                                    <h2 class="titulo2 "  >REPÚBLICA BOLIVARIANA DE VENEZUELA
                                    PROANZOÁTEGUI </h2>
                                    <h2 class="titulo2  " >RUTA DE PROCEDIMIENTO ADMINISTRATIVO</h2>
                            
                            </div> 
                    </div>
                </div>
            </section>   
        </header>
        <main>
            <br><br><br>

            <table class="table table-hover small table-bordered table-striped resumen1">
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
         
        </main>	
       
        <footer class="footer">
        
        </footer>	                                 
  </body>
</html>
