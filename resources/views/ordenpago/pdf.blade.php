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
margin: 90px 5px;
}

header {
position: fixed;
top: -60px;
left: 0px;
right: 0px;
height: 50px;

/** Extra personal styles 
background-color: #03a9f4;
color: white;
text-align: center;
line-height: 35px; **/
}

footer {
position: fixed;
bottom: 10px;
left: 45px;
right: 30px;
height: 50px;

/** Extra personal styles 
background-color: #03a9f4;
color: white;
text-align: center;
line-height: 35px; **/
}


  /* {
    margin: 0;
    padding:0;
  }
  html, body {
  width:100%;
  height: 100%;
  margin-top: 20px; 
  margin-bottom: 10px; 
 

  }

  */

  img
  {
   width: 180px;
   height: 180px;
  }

  .titulo{
   text-align: center;
    font-size: 13px;
    margin-left: 5px;
    font-family: Arial, sans-serif;
  }

  .subtitulo{
   text-align: center;
   justify-content: center;
    font-size: 19px;
    margin:19px;
  }
  .logo{
   width: 350px;
   text-align: center;
  }
  hr {
  height: 13px;
  width: 100%;
  /*background-color:#0380FF;*/
  background-color: #000000;
  }
  td{
    padding-left:13px;
  }

  .resumen1{
    margin-left:10px;
  }
  .resumen1 th{
    font-size: 12px;
  border: 0.5px solid #0a0a0a;
  border-collapse: collapse;
   text-align: center;
   justify-content: center;
  /* width: 160px; */
  }
  .resumen1 td{
    font-size: 11px;
  border: 0.5px solid #0a0a0a;
   text-align: center;
   justify-content: center;
  /* width: 160px; */
   font-weight: normal;
  }


  .resumen{
    margin-left:10px;
  }
  .resumen th{
    font-size: 11px;
  }
  .resumen td{
    font-size: 10px;
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
            <table class="table">
                <tr>
                    <th class="text-center">
                        <h2 class="titulo">REPÚBLICA BOLIVARIANA DE VENEZUELA <br> GOBERNACION DEL ESTADO ANZOÁTEGUI
                        <br> DIRECCIÓN DE ADMINISTRACIÓN Y FINANZAS<h2>
                        
                    </th>
                    
                </tr>
            </table>
        </header>
        <main>
        <table>
            <th class="logo">   <img src="data:image/png;base64,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"></th>
            <td></td>
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
            </table>
        </table>

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
            <table class="table table-bordered table-sm resumen ">
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
                        <td align="right"> {{ number_format($ordenpago->montobase, 2,',','.') }}</td>
                        <td align="right"> {{ number_format($ordenpago->montoexento, 2,',','.') }}</td>
                        <td align="right"> {{ number_format($ordenpago->montoiva, 2,',','.') }}</td>
                        <td align="right">  {{ number_format($ordenpago->montobase + $ordenpago->montoiva, 2,',','.') }} </td>
                        <td align="right"> {{ number_format($ordenpago->montoretencion, 2,',','.') }}</td>
                        <td align="right">  {{ number_format($ordenpago->montoneto, 2,',','.') }} </td>
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
            <table class="table table-bordered table-sm resumen ">
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

       <footer>
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th width="50%" class="firma" >DIRECTOR(A) DE ADMINISTRACION Y FINANZAS</th>
                    <th width="50%" class="firma"  >GOBERNADOR(A) Y/O SECRETARIO(A) GENERAL DE GOBIERNO</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="pie text-left justify-left">Elaborado por: {{ $ordenpago->usuario->name }}</div>
       
        </footer>
      </div>

</body>
</html>