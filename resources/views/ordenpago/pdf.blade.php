<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Orden de Pago</title>

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>

@page {
margin: 200px 10px 160px 10px;
}

header {
position: fixed;
top: -200px;

left: 0px;
right: 0px;
height: 50px;

}

footer {
position: fixed;
bottom: -30px;
left: 45px;
right: 30px;
height: 50px;

}

  img
  {
   width: 140;
   height: 55px;
  }

  .titulo{
    font-size: 13px;
    margin-left: 15px; 
    font-family: Arial, sans-serif;
  }

  .subtitulo{
   text-align: center;
   justify-content: center;
    font-size: 19px;
    margin:19px;
  }

  hr {
  height: 9px;
  width: 100%;
  /*background-color:#0380FF;*/
  background-color: #000000;
  }
  td{
    padding-left:10px;
    height: 9px;
  }

  .resumen1{
    margin-left:10px;
  }
  .resumen1 th{
    height: 9px;
    font-size: 12px;
  /*border: 0.5px solid #0a0a0a;*/
  border-collapse: collapse;
   text-align: center;
   justify-content: center;
  /* width: 160px; */
  }
  .resumen1 td{
    height: 9px;
    font-size: 11px;
  /*border: 0.5px solid #0a0a0a;*/
  text-align: justify;
   justify-content: center;
  /* width: 160px; */
   font-weight: normal;
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
    height: 9px;
    font-size: 11px;
   
  }
  .resumen td{
    height: 9px;
    font-size: 10px;
    text-align: justify;
    
  }

  .encabezado{
    font-size: 5px;
  }
/*
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
   /*margin-top:40px;
   /*background-color: #F1C40F;
   position: fixed;
   width: 90%;
   height: 100px;
   bottom:0;
   /*margin-top:25px;
   margin-bottom:20px;
   margin-left:10px;
   } */

  .lateral{
  height: 50px;
  /*background-color: blue; */
  }

  .firma{
    font-size: 10px;
  }
  .pie{
    font-size: 10px;
    margin-left: 5px;  
  }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
        <header>
        <BR>
                 <table>
                  <thead class="thead">
                  <tr>
 <th class="text-center justify-content">
 <img src="{{ asset('images/logo.png') }}"> 
 </th>
          
                   <th class="text-center " WIDTH="20%">
                        <h2 class="titulo">REPÚBLICA BOLIVARIANA DE VENEZUELA <br> PROANZOÁTEGUI
                        <br>ADMINISTRACIÓN<h2>
                          </th>
            <th>
             <table class="table-bordered resumen1">
                <tr>
                   <th scope="row">NRO. ORDEN DE PAGO:</th>
                   <th scope="row">NRO. COMPROMISO:</th>
                </tr>
                   <tr>
                        <td> 

                                  @if($ordenpago->nordenpago<10)
                                    {{ '0000'.$ordenpago->nordenpago }}
                                    @endif

                                    @if($ordenpago->nordenpago>=10 && $ordenpago->nordenpago<100)
                                    {{ '000'.$ordenpago->nordenpago }}
                                    @endif

                                    @if($ordenpago->nordenpago>=100 && $ordenpago->nordenpago<1000)
                                    {{ '00'.$ordenpago->nordenpago }}
                                    @endif

                                    @if($ordenpago->nordenpago>=1000 && $ordenpago->nordenpago<10000)
                                    {{ '0'.$ordenpago->nordenpago }}
                                    @endif

                                    @if($ordenpago->nordenpago>=10000)
                                    {{ $ordenpago->nordenpago }}
                                    @endif

                        </td>
                        <td>  

                                    @if($ordenpago->compromiso->ncompromiso<10)
                                    {{ '0000'.$ordenpago->compromiso->ncompromiso }}
                                    @endif

                                    @if($ordenpago->compromiso->ncompromiso>=10 && $ordenpago->compromiso->ncompromiso<100)
                                    {{ '000'.$ordenpago->compromiso->ncompromiso }}
                                    @endif

                                    @if($ordenpago->compromiso->ncompromiso>=100 && $ordenpago->compromiso->ncompromiso<1000)
                                    {{ '00'.$ordenpago->compromiso->ncompromiso }}
                                    @endif

                                    @if($ordenpago->compromiso->ncompromiso>=1000 && $ordenpago->compromiso->ncompromiso<10000)
                                    {{ '0'.$ordenpago->compromiso->ncompromiso }}
                                    @endif

                                    @if($ordenpago->compromiso->ncompromiso>=10000)
                                    {{ $ordenpago->compromiso->ncompromiso }}
                                    @endif

                        </td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>CLASE:</strong></th>
                      <th scope="row"><strong>CODIGO:</strong></th>
                   </tr>
                   <tr>
                        <td>DIRECTA</td>
                        <td>01</td>
                   </tr>
                   <tr>
                      <th scope="row"> <strong>TIPO:</strong></th>
                      <th scope="row"><strong>CODIGO:</strong></th>
                   </tr>
                   <tr>
                        <td>ESPECIAL</td>
                        <td>02</td>
                   </tr>
                   <tr>
                      <th colspan="2" scope="row"><strong>FECHA:</strong></th>
                   </tr>
                   <tr>
                      <td colspan="2">{{ date('d-m-Y', strtotime($ordenpago->created_at)) }}</td>
                   </tr>
                   
            </th>
             </thead>
            </table>
        </table>

        </header>

        <!-- Datos del beneficiario -->
        <table class="table table-bordered table-sm resumen">
               <thead class="thead table-secondary">
                   <tr>
                     <th>BENEFICIARIO</th>
                     <th></th>
                     <th></th>
                     <th>CEDULA DE IDENTIDAD O R.I.F.</th>
                   </tr>
               </thead>
               <tbody>
                <tr>
                    <td colspan="3">{{ $compromiso->beneficiario->nombre }}</td>
                    <td>{{ $ordenpago->compromiso->beneficiario->caracterbeneficiario . ' - ' .$ordenpago->compromiso->beneficiario->rif }} </td>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center">CARACTERISTICAS DEL PAGO</th>
                </tr>
               </tbody>

               <thead class="thead table-secondary">
                   <tr>
                     <th>PLAZO DE PAGO</th>
                     <th>NRO. DE PAGOS</th>
                     <th>FORMA DE PAGO</th>
                     <th>CODIGO</th>
                   </tr>
               </thead>
               <tbody>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> CONTADO </td>
                    <td> </td>
                </tr>
                <tr>
                <th colspan="4" style="text-align: center">AÑO DEL PRESUPUESTO {{ $compromiso->created_at->year }}</th>
                </tr>
               </tbody>

               

            </table>

            <main>

            <!-- CARACTERISTICAS DEL PAGO -->
           
            <!-- tabla para colocar el sector de la unidad administrativa -->
           

            <!-- A#O DEL PRESUPUESTO -->
           
            <!-- tabla para colocar el sector de la unidad administrativa -->
            <table class="table table-bordered table-sm resumen">
               <thead class="thead table-secondary">
                   <tr>
                     <th>SECTOR</th>
                     <th>PROG</th>
                     <th>ACT</th>
                     <th>META</th>
                     <th>PART</th>
                     <th>GEN</th>
                     <th>ESP</th>
                     <th>SUB-ESP</th>
                     <th>FINANCIAMINENTO</th>
                     <th>MONTO</th>
                   </tr>
               </thead>
               <tbody>
               <?php 
               $suma_partidas = 0;
               ?>
                
                            @foreach ($detallescompromisos as $valor)
                   <tr>

                     
                       <td> {{ $valor->unidadadministrativa->sector }}</td>
                       <td> {{ $valor->unidadadministrativa->programa }}</td>
                       <td> {{ $valor->unidadadministrativa->actividad }}</td>

                      
                       <td>
                       {{ $valor->ejecucione->meta_id  }}
                      
                      </td>
                    <?php

                            $clasificador = explode('.', $valor->clasificadorpresupuestario);
                            $montocompromiso = $valor->montocompromiso;

                            //Luego cambiar esta linea
                            $suma_partidas += $montocompromiso;
                        

                    ?>
                       <td>{{  $clasificador[0] . '.' . $clasificador[1] }}</td>
                       <td>{{  $clasificador[2] }}</td>
                       <td>{{  $clasificador[3] }}</td>
                       <td>{{  $clasificador[4] }}</td>
                       <td>{{  $valor->financiamiento }}</td>
                       <td style="text-align: right">{{  number_format($montocompromiso,2,',','.') }}</td>
                       {{-- <td> {{ $ordenpago->compromiso->detallescompromiso->ejecucione->financiamiento->nombre }}</td> --}}
                     </tr>
                 @endforeach


                 <tr>
                    
                     <th colspan="9" style="text-align: right">TOTAL</th>
                     <th style="text-align: right">{{ number_format($suma_partidas,2,',','.') }}</th>
                   </tr>

               </tbody>

              
            </table>

            <!-- CONCEPTO -->

            <table class="table table-bordered table-sm resumen">
       
               <thead class="table-secondary">
                    <tr>
                        <th colspan="10" class="encabezado text-center justify-content ">CONCEPTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="10">{{ $concepto }}</td>
                    </tr>
                </tbody>
            </table>
            
           

            <!-- tabla para colocar el sector de la unidad administrativa -->
            <table class="table table-bordered table-sm resumen">
                <thead class="thead table-secondary">
                    <tr>
                      <th>MONTO BASE</th>
                      <th>MONTO EXENTO</th>
                      <th>MONTO IVA</th>
                      <th>MONTO NETO</th>
                      <th>MONTO RETENCION</th>
                      <th>MONTO A PAGAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                       <?php

                        $monto_pagar = ($ordenpago->montobase + $ordenpago->montoiva) - $suma_retenciones;
                        
                        ?>
                        <td style="text-align: right"> {{ number_format($ordenpago->montobase, 2,',','.') }}</td>
                        <td style="text-align: right"> {{ number_format($ordenpago->montoexento, 2,',','.') }}</td>
                        <td style="text-align: right"> {{ number_format($ordenpago->montoiva, 2,',','.') }}</td>
                        <td style="text-align: right">  {{ number_format($ordenpago->montobase + $ordenpago->montoiva, 2,',','.') }} </td>
                        <td style="text-align: right"> {{ number_format($suma_retenciones, 2,',','.') }}</td>
                        <td style="text-align: right">  {{ number_format($monto_pagar, 2,',','.') }}
                          {{-- number_format($ordenpago->montoneto, 2,',','.') --}} </td>
                    </tr>
                </tbody>
             </table>
{{--              <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">MONTO A PAGAR EN LETRAS: {{ $montoletras }}</td>
                    </tr>
                </tbody>
            </table> --}}

                       <!-- tabla para cargar las retenciones de la orden de pago -->

            @if(count($detalleretenciones)>0)
            <table class="table table-bordered table-sm resumen">
            <thead class="thead table-secondary">
                <tr>
                    <th>RETENCIÓN</th>
                    <th class="text-right justify-content">MONTO</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($detalleretenciones as $valor)
                <tr>
                    <td> {{ $valor->retencione->descripcion . ' ' . $valor->retencione->porcentaje . '%' }}</td>
                    <td class="text-right justify-content"> {{ number_format($valor->montoneto, 2,',','.') }}</td>
                </tr>
                @endforeach

                <tr>
                    <th class="text-right justify-content">TOTAL</th>
                    <th class="text-right justify-content">{{ number_format($suma_retenciones, 2,',','.') }}</th>
                </tr>
            </tbody>
            </table>
            @else
            <table class="table table-bordered table-sm resumen ">
            <thead class="thead table-secondary">
                <tr>
                    <th>RETENCIÓN</th>
                    <th class="text-right justify-content">MONTO</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <td> </td>
                    <td class="text-right justify-content"> </td>
                </tr>

                <tr>
                    <th class="text-right justify-content">TOTAL</th>
                    <th class="text-right justify-content"></th>
                </tr>
            </tbody>
            </table>
            @endif





       </main>



<table class="resumen1">
                <thead >
                  <tr>
                    <th width="50%" class="firma"> </th>
                    <th width="50%" class="firma"> 
                    <div style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      @php
      $ruta ='http://localhost/siproespati/public/rutas/ODPAGO-' . $ordenpago->id;
      @endphp
      <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->generate($ruta)) }}">
      </div>

                    </th>
                  </tr>
                </thead>
               
              </table>

       <footer>
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th width="50%" class="firma" >GERENTE(A) DE ADMINISTRACION</th>
                    <th width="50%" class="firma"  >PRESIDENTE(A)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="pie text-left justify-left">ELABORADO POR EL USUARIO :  {{ $ordenpago->usuario->name }}</div>
       
        </footer>

      </div>

</body>
</html>