<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Precompromisos</title>

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
  margin-top: 50px; 
  margin-bottom: 70px; 
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

  .header {
                 position: fixed;
                  top: 50px;
                left: 10px;
                right: 80px;
                line-height: 30px;
                text-align: right;
            
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
   margin-bottom:20px;
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
                             <h2 class="titulo" >REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI
 <h2>
                             <h3 class="subtitulo">SOLICITUD DE ORDEN DE PRE-COMPROMISO</h3> 
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
                                  $ruta ='http://localhost/siproespati/public/rutas/PCOMPROM-' . $precompromiso->id;

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
        
             <table class="resumen1">
                   <tr>
                      <th scope="row"> <strong>Nro. Pre-compromiso:</strong></th>
                      <td> 

                                   @if($precompromiso->id<10)
                                    {{ '0000'.$precompromiso->id }}
                                    @endif

                                    @if($precompromiso->id>=10 && $precompromiso->id<100)
                                    {{ '000'.$precompromiso->id }}
                                    @endif

                                    @if($precompromiso->id>=100 && $precompromiso->id<1000)
                                    {{ '00'.$precompromiso->id }}
                                    @endif

                                    @if($precompromiso->id>=1000 && $precompromiso->id<10000)
                                    {{ '0'.$precompromiso->id }}
                                    @endif

                                    @if($precompromiso->id>=10000)
                                    {{ $precompromiso->id }}
                                    @endif
                      </td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>Tipo:</strong></th>
                      <td>{{ $precompromiso->tipodecompromiso->nombre }}</td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>Nro. de Documento:</strong></th>
                      <td>{{ $precompromiso->documento }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Fecha:</strong></th>
                      <td>{{ $precompromiso->created_at }}</td>
                   </tr>
                   <BR>
                   <tr>
                      <th scope="row"><strong>Asunto:</strong></th>
                      <td>Por medio de la presente, estamos remitiendo a ud(s). La relación 
                          de los siguientes requerimientos.    Sin más a que hacer referencia, quedamos de ud(s).</td>
                   </tr>
                    <Br>
                   <tr>
                      <th scope="row"><strong>Concepto:</strong></th>
                      <td>{!! $precompromiso->concepto !!}</td>
                   </tr>
                      <Br>

                   <tr>
                      <th scope="row"><strong>Beneficiario:</strong></th>
                      <td> {{ $precompromiso->beneficiario->nombre }}</td>
                   </tr>
                   <tr>
                      <th scope="row"><strong>Status:</strong></th>
                      <td> {{$status}}</td>
                   </tr>
  
               </table>

               <main>
                <!-- DETALLES DE LOS PRE-COMPROMISO -->
               <br>
                        <table class="table table-bordered table-sm resumen">
                                <thead class="table-secondary">
                                    <tr>
                                    <th colspan="2" class="encabezado text-center justify-content ">Clasificación Programatica</th>
                                    <th class="encabezado text-center justify-content">Financiamiento</th>
                                    <th class="encabezado text-center justify-content">Monto compromiso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $i=0; ?>
                                @foreach ($detallesprecompromisos as $detallesprecompromiso)
                               
                                        <tr>
                                  
                                          <td colspan="2">{{ $detallesprecompromiso->unidadadministrativa->sector . " " . $detallesprecompromiso->unidadadministrativa->programa . " " . $detallesprecompromiso->unidadadministrativa->subprograma . " " . $detallesprecompromiso->unidadadministrativa->proyecto . " " . $detallesprecompromiso->unidadadministrativa->actividad  . " " .$detallesprecompromiso->ejecucione->clasificadorpresupuestario  }} &nbsp;
										                       {{ $datos[$detallesprecompromiso->ejecucion_id] }}</td>
                                           <td class="text-center justify-content">{{  $detallesprecompromiso->financiamiento }}</td>
                                          <td class="text-right justify-content">{{  number_format($detallesprecompromiso->montocompromiso,2,',','.') }}</td>

                                          
					
                                        </tr>
                                           

                                    @endforeach

                                    <tr>
                                    <th colspan="3" class="text-right justify-content">TOTAL PRE-COMPROMISO</th>
                                    <th class="encabezado text-right justify-conten"> {{  number_format($totalcompromiso,2,',','.') }}</th>

                                   
                                </tr>
                                  
                                </tbody>
                          
                            </table>
       </main>

       <footer class="footer">
       <table class="table table-bordered">
                <thead >
               
                  <tr>
                    <th class="firma" style="width: 50%">GERENTE(A) DE LA UNIDAD</th>
                    <th  class="firma"  style="width: 50%">GERENTE(A) DE ADMINISTRACION</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                    <td></td>
                    
                  </tr>
                </tbody>
               
              </table>
              <div class="pie text-left justify-left">ELABORADO POR EL USUARIO :  {{ $precompromiso->usuario->name }}</div>
        </footer>
      </div> 
                                                                
</body>
</html>