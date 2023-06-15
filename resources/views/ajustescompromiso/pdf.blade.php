<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Ajuste de Compromisos</title>

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css"> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>

* {
    margin: 0;
    padding:0;
  }
  html, body {
  width:100%;
  height: 100%;
  
  margin-top: 60px; 
  margin-bottom: 60px; 
  }
  
  img
  {
   width: 140px;
   height: 55px;
  }

  .titulo{
    font-size: 13px;
    margin-left: 5px; 
    font-family: Arial, sans-serif;

  }

  .subtitulo{
    font-size: 19px; 
    margin:19px;
  }
  hr {
  height: 15px;
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
    font-size: 13px;
  }
  .resumen td{
    font-size: 9px;
  }

  .encabezado{
    font-size: 5px; 
  }

  .footer {
   text-align: center;
   justify-content: center;
   margin:auto;
   /*background-color: #F1C40F;*/
   position: fixed;
   width: 90%;
   height: 100px;
   bottom:0;
   margin-bottom:40px;
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
    font-size: 11px;
    margin-left: 5px;  
  }
  
</style>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
     <header>
                <table>
                        <tr>
                        <th class="text-center justify-content" scope="col">   
                           
                           <img src="{{ asset('images/logo.png') }}"> 
 
                             </th>  
                        <th class="text-center ">
                             <h2 class="titulo" >REPÚBLICA BOLIVARIANA DE VENEZUELA GOBERNACIÓN DEL ESTADO ANZOATEGUI <h2>
                             <h3 class="subtitulo">AJUSTE DE COMPROMISO</h3> 
                             <hr>
                          </th>
                        </tr>
                </table>
        </header>
 
       
        <main>
             <table class="resumen1">
                   <tr>
                      <th scope="row">Nro. Compromiso:</th>
                      <td>  



                                    @if($ajustescompromiso->compromiso->ncompromiso<10)
                                    {{ '0000'. $ajustescompromiso->compromiso->ncompromiso }}
                                    @endif

                                    @if($ajustescompromiso->compromiso->ncompromiso>=10 && $ajustescompromiso->compromiso->ncompromiso<100)
                                    {{ '000'. $ajustescompromiso->compromiso->ncompromiso }}
                                    @endif

                                    @if($ajustescompromiso->compromiso->ncompromiso>=100 && $ajustescompromiso->compromiso->ncompromiso<1000)
                                    {{ '00'. $ajustescompromiso->compromiso->ncompromiso }}
                                    @endif

                                    @if($ajustescompromiso->compromiso->ncompromiso>=1000 && $ajustescompromiso->compromiso->ncompromiso<10000)
                                    {{ '0'. $ajustescompromiso->compromiso->ncompromiso }}
                                    @endif

                                    @if($ajustescompromiso->compromiso->ncompromiso>=10000)
                                    {{ $ajustescompromiso->compromiso->ncompromiso }}
                                    @endif
                      </td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>Tipo:</strong></th>
                      <td> {{ $ajustescompromiso->compromiso->tipodecompromiso->nombre}}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Nro. Documento Ajuste:</strong></th>
                      <td> {{ $ajustescompromiso->documento }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Fecha:</strong></th>
                      <td> {{ $ajustescompromiso->created_at->toDateString() }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Concepto: </strong></th>
                      <td> {!! $ajustescompromiso->concepto !!}</td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>Beneficiario:</strong></th>
                      <td>  {{ $ajustescompromiso->compromiso->beneficiario->nombre }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Tipo de Ajuste:</strong></th>
                      @if($ajustescompromiso->tipo == 1)
                      <td>{{ 'Aumento' }}</td>
                      @else
                      <td>{{ 'Disminuye' }}</td>
                      @endif

                   </tr>
  
               </table>

                <!-- DETALLES DE LOS COMPROMISO, IMPUTACIONES PRESUPUESTARIAS -->
               <br>
                        <table class="table table-bordered table-sm  resumen">
                                <thead class="table-secondary">
                                    <tr>
                                    
                                    <th class="encabezado text-center justify-content">Monto de Ajuste</th>
                                    <th class="encabezado text-center justify-content ">Clasificador</th>
                                    <th class="encabezado text-center justify-content">Unidad Administrativa</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($detallesajustes as $rows)
                                        <tr>
                                            
                                       
					
                                        <td class="text-center justify-content">{{ number_format($rows->montoajuste,2,',','.') }}</td>
                                          <td class="text-center justify-content">{{ $rows->ejecucione->clasificadorpresupuestario }}</td>

                                          <td class="text-right justify-content">{{ $rows->unidadadministrativa->unidadejecutora }}</td>

                                          
                                        </tr>
                                    @endforeach
                                  
                                    <tr>
                                    <th colspan="2" class="text-right justify-content  ">TOTAL AJUSTE</th>
                                    <th class="text-right justify-content"> {{  number_format($total,2,',','.') }}</th>

                                   
                                </tr>

                                </tbody>
                          
                            </table>
       </main>

       
       
       <footer class="footer">
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th  class="firma"  >GERENTE(A) DE PRESUPUESTO</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                  </tr>
                </tbody>
              </table>
              <div class="pie text-left justify-left">Elaborado por: {{ $ajustescompromiso->usuario->name }}</div>
        </footer>

        </div> 
      
                                                                
</body>
</html>