<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayudas Sociales</title>

    <!-- CSS only 
     <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css"> 

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  -->

  <style>
  * {
    margin: 0;
    padding:0;
  }
  html, body {
  width:100%;
  height: 100%;
  margin-top: 15px; 
  }
  
  img
  {
    width: 140px;
   height: 55px;
  }

  .titulo{
    font-size: 13px;
    /*margin-left: 1px; */
    font-family: Arial, sans-serif;

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
    font-size: 10px;
    text-align: justify;
    
  }
  .encabezado{
    font-size: 5px; 
  }
  .margen td{
    padding-left:70px;
  }
  .margen1 td{
    padding-left:35px;
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
   margin-bottom:70px;
   margin-left:10px;
  
   }
  .lateral{
  height: 50px; 
  /*background-color: blue; */
  }
  .espacio{
    padding-left:60px;
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
                          <th class="text-center justify-content " scope="col">  
                          <img src="{{ asset('images/logo.png') }}"> 
                        </th>
						              <th class="text-center">
                             <h2 class="titulo" >REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI <h2>
                                   <h2 class="titulo" > G-20016716-5 <h2>
                             <h3 class="subtitulo">AYUDA SOCIAL</h3> 
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
                                  $ruta ='http://siproapp.ideasrenovacion.com/rutas/AYU-' . $ayudassociale->id;

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

                <table class=" resumen1 margen1 ">
                                
                                <tr>
                                  <th scope="row" class="text-left justify-left"><strong>Nro. Ayuda social:</strong></th>
                                  <td class="titulo">
                                    @if($ayudassociale->id<10)
                                    {{ '0000'.$ayudassociale->id }}
                                    @endif

                                    @if($ayudassociale->id>=10 && $ayudassociale->id<100)
                                    {{ '000'.$ayudassociale->id }}
                                    @endif

                                    @if($ayudassociale->id>=100 && $ayudassociale->id<1000)
                                    {{ '00'.$ayudassociale->id }}
                                    @endif

                                    @if($ayudassociale->id>=1000 && $ayudassociale->id<10000)
                                    {{ '0'.$ayudassociale->id }}
                                    @endif

                                    @if($ayudassociale->id>=10000)
                                    {{ $ayudassociale->id }}
                                    @endif
                                  
                                  
                                  
                                 </td>
                                  <th scope="row"class="espacio"><strong>Tipo:</strong></th>
                                  <td class="titulo">{{ $ayudassociale->tipodecompromiso->nombre}}</td>
                                  
                                </tr>
                                <tr >
                                  <th scope="row"><strong>Nro. Documento:</strong></th>
                                  <td class="titulo">{{ $ayudassociale->documento }}</td>
                                  <th scope="row" class="espacio"><strong>Fecha:</strong></th>
                                  <td class="titulo">{{ $ayudassociale->created_at }}</td>
                                                              
                                </tr>
                                  <br>

                </table>

                <table class="resumen1 margen table-sm ">
                      <tr>
                        <th scope="row"><strong>Asunto:</strong></th>
                          <td >Por medio de la presente, estamos remitiendo a ud(s).La relacion de los siguientes
                            requerimientos. Sin más a que hacer referencia, quedamos de ud(s).
                          </td>
                      </tr>
                      <br>
                      <tr>
                          <th scope="row"><strong>Concepto:</strong></th>
                          <td >{{ $ayudassociale->concepto}}</td>
                      </tr>
                      <br>
                      <tr>
                          <th scope="row"><strong>Beneficiario:</strong></th>
                          <td > {{ $ayudassociale->beneficiario->nombre }}</td>
                      </tr>
                      <tr>
                          <th scope="row"><strong>Status:</strong></th>
                          <td >{{ $status }}</td>

                          
                      </tr> 
                </table>
                      <!-- DETALLES DE LAS AYUDASOCIAL-->
                      <br>
                            <table class="table table-bordered table-sm resumen">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Beneficiario</th>
                                            <th>Banco</th>
                                            <th>Cuenta</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detallesayudas as $detallesayuda)
                                            <tr>
                                                <td>{{ $ayudassociale->beneficiario->documento}}
                                                <td>{{ $ayudassociale->beneficiario->nombre }}</td>
                                                <td>{{ $ayudassociale->beneficiario->banco}}</td>
                                                <td>{{ $ayudassociale->beneficiario->numerocuenta }}</td>
                                                <td>{{  number_format($ayudassociale->montototal,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <th colspan="4" class="text-right justify-content  ">TOTAL AYUDA</th>
                                                   
                                                  <th class="encabezado">{{  number_format($totalcompromiso,2,',','.') }}</th>
                                                 
                                                  
                                            </tr>
                                    </tbody>
                            </table>
                            <br>
                            <table class="table table-bordered  table-sm resumen">
                                    <thead class="table-secondary">
                                        <tr>
                                          <th>Sector</th>
                                          <th>Programa</th>
                                          <th>Subprog</th>
                                          <th>Proyecto</th>
                                          <th>Actividad</th>
                                          <th >Unidad Ejecutora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detallesayudas as $detallesayuda)
                                            <tr>
                                                  <td>{{ $detallesayuda->unidadadministrativa->sector }}</td>
                                                  <td>{{ $detallesayuda->unidadadministrativa->programa }}</td>
                                                  <td>{{ $detallesayuda->unidadadministrativa->subprograma }}</td>
                                                  <td>{{ $detallesayuda->unidadadministrativa->proyecto }}</td>
                                                  <td>{{ $detallesayuda->unidadadministrativa->actividad }}</td>
                                                  <td>{{ $detallesayuda->unidadadministrativa->unidadejecutora }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
            </main> 
            <footer class="footer">
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th class="firma">PRESIDENTE(A)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                  </tr>
                </tbody>
               
              </table>
              <div class="pie text-left justify-left">ELABORADO POR EL USUARIO :  {{ $ayudassociale->usuario->name }}</div>
            </footer>
        <div><!-- fin del div container -->                                
   </body>
</html>