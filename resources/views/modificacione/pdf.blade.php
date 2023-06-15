<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> COMPROBANTE DE RETENCIÓN NOMINA</title>

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
    width: 160px;
    height: 55px;
    }
    .titulo{
    font-size: 14px;
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



.resumen-amd {
    border: white 10px solid;
    margin-left:10px;
    }
    .resumen-amd th{
    font-size: 10px;
    }
    .resumen-amd td{
    font-size: 10px;
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
    font-size: 11px;
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
    margin-bottom:80px;
    margin-left:10px;
    }
    .lateral{
    height: 50px;
    /*background-color: blue; */
    }

   .firma{
    font-size: 10px;
    margin-left: 5px;
    text-align: center;
    justify-content: center;
  }
  .pie{
    font-size: 10px;
    margin-left: 5px;
    text-align: center;
    justify-content: center;

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
                                    <h2 class="titulo2">PROANZOÁTEGUI<br>
                                    G-20016716-5<br>
                                    PRESUPUESTO<br>
                                    <h3 class="subtitulo">MODIFICACION PRESUPUESTARIA</h3>

                            </div>
                    </div>
                </div>
            </section>
        </header>
        <main>

            <!-- Informacion Principal del Sistema -->
            <table class="table table-bordered table-sm resumen-amd" >
                <thead>
                    <tr>
                        <th >Fecha: </th>
                        <td  class="encabezado text-left justify-content"> {{ $modificacione->created_at->toDateString() }}</td>
                        
                        <th >Tipo de modificacion: </th>
                        <td  class="encabezado text-left justify-content"> {{ $modificacione->tipomodificacione->nombre }}</td>
                        
                        <th >Numero credito: </th>
                        <td  class="encabezado text-left justify-content"> {{ $modificacione->ncredito }} </td>
                        
                      </tr>
                </thead>
               <tbody>
                    <tr>
                        <th colspan="6">CONCEPTO: {{ $modificacione->descripcion }} </th>
    
                    </tr>
                    
                </tbody>
    
           </table>
            <!-- Fin Informacion Principal de la modificacion -->

            <!-- iNICIO DETALLES DE LA MODIFICACION PRESUPUESTARIA -->
            <table class="table table-bordered table-sm resumen-amd">
                <thead>
                    <tr>
                      
                    <th>S /P /SP /PR /A</th>
                   {{-- <th>POA</th>
                    <th>META</th> --}}
                    <th>P /G /E /SE</th>
                        <th>FINANCIAMIENTO</th>
                        <th>AUMENTO</th>
                        <th>DISMINUCION</th>

                        
                    </tr>
                </thead>
                <tbody>
                <?php $aumento=0;
                       $disminucion=0;
                ?>
                            
                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                        <tr>
                           
                            <?php

                            $aumento+=$detallesmodificacione->montoacredita;
                            $disminucion+=$detallesmodificacione->montodebita;
                            
                            $spsppra= $detallesmodificacione->unidadadministrativa->sector . '.' . $detallesmodificacione->unidadadministrativa->programa . '.' . $detallesmodificacione->unidadadministrativa->subprograma . '.' . $detallesmodificacione->unidadadministrativa->proyecto . '.' . $detallesmodificacione->unidadadministrativa->actividad;
                            ?>
                            
                            <td>{{ $spsppra }}</td>
                          {{--  <td>{{ $detallesmodificacione->ejecucione->poa_id }}</td>
                            <td>{{ $detallesmodificacione->ejecucione->meta_id }}</td> --}}
                            <td>{{ $detallesmodificacione->ejecucione->clasificadorpresupuestario }}</td>
                            <td>{{ $detallesmodificacione->financiamiento }}</td>
                        
                            <td class="text-right justify-content">{{ number_format($detallesmodificacione->montoacredita, 2,',','.') }}</td>
                            <td class="text-right justify-content">{{ number_format($detallesmodificacione->montodebita, 2,',','.') }}</td>

                            
                        </tr>
                    @endforeach

                    <tr>
                           
                            
                            
                            <th colspan="3" class="text-right justify-content">TOTAL</th>
                        
                            <td class="text-right justify-content">{{ 
                                number_format($aumento, 2,',','.') }}</td>
                            <td class="text-right justify-content">{{ 
                                number_format($disminucion, 2,',','.') }}</td>

                            
                        </tr>
                </tbody>
            </table>
            <!-- FIN EJECUCION PRESUPUESTARIA -->




           



       


        </main>
        <br>  <br>
        <footer class="footer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    
                    <th  class="firma"  >FIRMA Y SELLO <br>Gerente de Presupuesto </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"> </td>
                      </tr>
                </tbody>

              </table>

              <div class="pie">AV 05 DE JULIO, CASCO CENTRAL, BARCELONA ESTADO ANZOÁTEGUI </div>

            </footer>
  </body>
</html>