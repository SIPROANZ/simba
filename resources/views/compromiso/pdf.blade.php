<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Compromisos</title>

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
   width: 140;
   height: 55;
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
    text-align: justify;
  }

  .resumen1 img
  {
   width: 70px;
   height: 70px;
  }


  .resumen{
    margin-left:10px;
  }
  .resumen th{
    font-size: 11px;
  }
  .resumen td{
    font-size: 9px;
    text-align: justify;
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

                            <th class="text-center"> 
                             <h2 class="titulo">REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI <h2>
                             <h3 class="subtitulo">COMPROBANTE DE COMPROMISO</h3> 
                             <hr>
                          </th>

                          {{-- Para colocar el codigo qr --}}
                          <th scope="col">
                            <table class="table-sm resumen1">
                             
                                <tr>

                                  <th> 
                                  <div style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  @php
                                  $ruta ='http://localhost/siproespati/public/rutas/COMPROM-' . $compromiso->id;

                                  @endphp
                                  <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->generate($ruta)) }}">
                                  </div>
                                  </th>
                                </tr>
                             
                              
                              </table>
                          </th>

                        </tr>
                </table>
        </header>
        <main>
             <table class="resumen1">
                   <tr>
                      <th scope="row">Nro. Compromiso:</th>
                      <td>  



                      @if($compromiso->ncompromiso<10)
                                    {{ '0000'.$compromiso->ncompromiso }}
                                    @endif

                                    @if($compromiso->ncompromiso>=10 && $compromiso->ncompromiso<100)
                                    {{ '000'.$compromiso->ncompromiso }}
                                    @endif

                                    @if($compromiso->ncompromiso>=100 && $compromiso->ncompromiso<1000)
                                    {{ '00'.$compromiso->ncompromiso }}
                                    @endif

                                    @if($compromiso->ncompromiso>=1000 && $compromiso->ncompromiso<10000)
                                    {{ '0'.$compromiso->ncompromiso }}
                                    @endif

                                    @if($compromiso->ncompromiso>=10000)
                                    {{ $compromiso->ncompromiso }}
                                    @endif
                      </td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>Tipo:</strong></th>
                      <td> {{ $compromiso->tipodecompromiso->nombre}}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Nro. Documentos:</strong></th>
                      <td> {{ $compromiso->documento }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Fecha:</strong></th>
                      <td> {{ $compromiso->created_at->toDateString() }}</td>
                   </tr>
                   <br>
                   <tr>
                      <th scope="row"><strong>Concepto: </strong></th>
                      <td> {!! $concepto !!}</td>
                   </tr>
                      <br>
                   <tr>
                      <th scope="row"> <strong>Beneficiario:</strong></th>
                      <td>  {{ $compromiso->beneficiario->nombre }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Status:</strong></th>
                      <td>{{$status}}</td>
                   </tr>
  
               </table>

                <!-- DETALLES DE LOS COMPROMISO, IMPUTACIONES PRESUPUESTARIAS -->
               <br>
                        <table class="table table-bordered table-sm  resumen">
                                <thead class="table-secondary">
                                    <tr>
                                    <th colspan="2" class="encabezado text-center justify-content ">Clasificación Programatica</th>
                                    <th class="encabezado text-center justify-content">Financiamiento</th>
                                    <th class="encabezado text-center justify-content">Monto compromiso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            
                                            
					
                                        <td colspan="2">{{ $detallescompromiso->unidadadministrativa->sector . " " . $detallescompromiso->unidadadministrativa->programa . " " . $detallescompromiso->unidadadministrativa->subprograma . " " . $detallescompromiso->unidadadministrativa->proyecto . " " . $detallescompromiso->unidadadministrativa->actividad  . " " .$detallescompromiso->ejecucione->clasificadorpresupuestario  }}
										                    	{{ $datos[$detallescompromiso->ejecucion_id] }}</td>
                                          <td class="text-center justify-content">{{ $detallescompromiso->financiamiento }}</td>

                                          <td class="text-right justify-content">{{ number_format($detallescompromiso->montocompromiso ,2,',','.') }}</td>

                                          
                                        </tr>
                                    @endforeach
                                  
                                    <tr>
                                    <th colspan="3" class="text-right justify-content  ">TOTAL COMPROMISO</th>
                                    <th class="text-right justify-content"> {{  number_format($totalcompromiso ,2,',','.') }}</th>

                                   
                                </tr>

                                </tbody>
                          
                            </table>
       </main>

       <footer class="footer">
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th class="firma" >JEFE(A) DE LA UNIDAD DE CONTROL PRESUPUESTARIO</th>
                    <th  class="firma"  >GERENTE(A) DE PRESUPUESTO 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="pie text-left justify-left">Elaborado por: {{ $compromiso->usuario->name }}</div>
        </footer>
      </div> 
                                                                
</body>
</html>