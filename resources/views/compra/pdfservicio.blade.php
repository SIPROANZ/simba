<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Servicio Numero: {{ $compra->numordencompra }}</title>

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
    font-size: 9px;
    margin-left: 15px; 
    font-family: Arial, sans-serif;

  }
  .titulo2{
    font-size: 13px;
    margin-left: 15px; 
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
  td{
    padding-left:15px;
  }
  .resumen1{
    margin-left:10px;
  }
  .resumen1 th{
    font-size: 13px;
  }
  .resumen1 td{
    font-size: 13px;
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
    font-size: 10px;
  }
  .resumen td{
    font-size: 10px;
    text-align: justify;
  }

  .encabezado{
    font-size: 13px; 
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

  .firma{
    font-size: 10px;
    width: 200px
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
            <table>
                   <thead class="thead">
                        <tr>
                          <th class="text-center justify-content">
                          <img src="{{ asset('images/logo.png') }}"> 
                         </th>
                          <th class="text-center " WIDTH="40%">
         <h2 class="titulo2" >REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI.<h2>
                          
                              <h2 class="titulo2" > G-20016716-5 <h2>
                             <h3 class="subtitulo"> ORDEN DE SERVICIO </h3> 
                          </th>
                           <th>
                           <table class="table table-bordered table-sm resumen text-right justify-content ">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="encabezado text-center justify-content">CONTROL PREVIO</th>
                                    <th class="encabezado text-center justify-content" WIDTH="50%">ORDEN DE SERVICIO</th>                     
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="encabezado text-center justify-content"></td>
                                        <td class="encabezado text-center justify-content">   {{ $compra->numordencompra . ' - ' . $fecha }}</td>                    
                                    </tr>
                                    <tr>
                                        <th class="encabezado text-center justify-content">CONTROL POSTERIOR</th>
                                        <td class="encabezado text-center justify-content">FECHA</td>                    
                                    </tr>
                                    <tr>
                                        <td class="encabezado text-center justify-content"></td>
                                        <td class="encabezado text-center justify-content">{{ $compra->created_at->toDateString() }}</td>                    
                                    </tr>
                                </tbody>
                        </table>
                          </th>
                        </tr>
                       
                    </thead>
                </table>
        </header>

        <main>

            <table class="table table-bordered table-sm resumen">
                <thead>
                    <tr>
                        <th>RAZON SOCIAL</th>
                        <th class="encabezado text-center justify-content">CONTRALOR</th>
                        <th class="encabezado text-center justify-content">REQUISICIÓN</th>                      
                    </tr>
                </thead>
               <tbody>
                    <tr>
                        <td > {{ $razon_social }}</td>
                        <td  class="encabezado text-center justify-content"></td>  
                        <td  class="encabezado text-center justify-content">{{ $correlativo  }}</td>  

                    </tr>
                     <tr>
                        <td>RIF:  {{ $rif }}</td>
                         <td  class="encabezado text-center justify-content">CONFORME</td>
                        <td  class="encabezado text-center justify-content">IMPORTANTE</td> 
                                      
                    </tr>
                    <tr >
                        <td  style='border: 0'  colspan="2" width="70%">
                        <strong>DESPACHAR A: </strong><br>
                        <strong>SECTOR: </strong> {{ $sector }} <br>
                        <strong>SUB-SECTOR:</strong> {{ $sub_sector }} <br>
                        <strong>DEPARTAMENTO:</strong> {{ $departamento }} <br>
                        <strong>USO DEL BIEN:</strong> {{ $uso }} <br>


                        </td> 
                        
                        <td width="30%">1er - Sirvase citar numero de muestra Orden De
                              Compra en sus Facturas y Notas de Entrega
                              2do - No se aceptan tachaduras ni Emmendaduras
                              3er - Es Impresindible de la Presentación de la
                              presente ORDEN DE SERVICIO para efectuar el
                              cobro respectivo con factura original y 2 copias.
                       </td>

                    </tr>
                   
                </tbody>
           </table>
           <br>
            <!-- Area para colocar los detalles del analisis de cotizacion-->
    <table class="table table-bordered table-sm resumen">
                                <thead class="table-secondary">
                                    <?php //$subtotal=0;
                                    //$iva=0; 
                                    //$total=0; ?>
                                    <tr>
                                   
										<th class="text-center justify-content">DESCRIPCION</th>
                   <th class="text-center justify-content">CANTIDAD</th>
										<th class="text-center justify-content">PRECIO UNITARIO</th>
										<th class="text-center justify-content">PRECIO TOTAL</th>
										   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesanalisis as $detallesanalisi)
                                        <tr>
                                          
											<td>{{ $detallesanalisi->bo->descripcion }}</td>
                      <td class="text-center justify-content">{{ $detallesanalisi->cantidad }}</td>
											<td class="text-right justify-content">  {{  number_format($detallesanalisi->precio,2,',','.') }}</td>
											<td class="text-right justify-content"> {{  number_format($detallesanalisi->subtotal,2,',','.') }}</td>
                                            <?php 
                                                // $subtotal+=$detallesanalisi->subtotal;
                                                //$iva+=$detallesanalisi->iva;
                                                //$total+=$detallesanalisi->total;
                                            ?>
                                            </td>
									    </tr>
                                    @endforeach
                                    <tr>
										<th></th>
										<th></th>
										<th class="text-right justify-content">SUB TOTAL</th>
										<th class="text-right justify-content">   {{  number_format($subtotal,2,',','.') }}</th>
                                    </tr>
                                    <tr>
										<th></th>
										<th></th>
										<th class="text-right justify-content">I.V.A.</th>
										<th class="text-right justify-content"> {{  number_format($iva,2,',','.') }}</th>  
                                    </tr>
                                    <tr>
										<th></th>
										<th></th>
										<th class="text-right justify-content">TOTAL</th>
										<th class="text-right justify-content"> {{  number_format($total,2,',','.') }}</th>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Tabla con los clasificadores presupuestarios de esta orden de compra -->
                           <table class="table table-bordered table-sm resumen">
                               <tr>
                                   <th class="text-center justify-content">
                                      MONTO EN LETRAS: (***{{ $total_letras }}***)
                                   </th>
                               </tr>
                           </table>
                           <table class="table table-bordered table-sm resumen">
                               <tr>
                                   <th class="table-secondary"> TIEMPO DE ENTREGA </th>
                                   <th>  CORTO PLAZO </th>
                                   <th class="table-secondary">  FORMA DE PAGO </th>
                                   <th>  CONTADO </th>
                                   <th class="table-secondary">  FORMA DE ENTREGA  </th>
                                   <th>  COMPLETA  </th>
                               </tr>
                           </table>

                           <table class="table table-bordered table-sm resumen">
                                <thead class="table-secondary">
                                    <tr>
										<th>SECTOR</th>
                                        <th>SUBSECT</th>
                                        <th>SUBPROG</th>
                                        <th>PROY</th>
                                        <th>ACT</th>
                                        <th>POA</th>
                                        <th>META</th>
										<th>PART-GEN-ESP-SUBESP</th>
										<th>ASIGN. BS</th>
									
                               </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprascps as $comprascp)
                                        <tr>
											<td>{{ $comprascp->unidadadministrativa->sector}}</td>
											<td>{{ $comprascp->unidadadministrativa->programa}}</td>
                       <td>{{ $comprascp->unidadadministrativa->subprograma}} </td>
                                            <td>{{ $comprascp->unidadadministrativa->proyecto}}</td>
                                            <td>{{ $comprascp->unidadadministrativa->actividad }}</td>

                                            <td>{{ $comprascp->ejecucione->poa_id }}</td>
                                            <td>{{ $comprascp->ejecucione->meta_id }}</td> 

                                            <td>{{ $comprascp->ejecucione->clasificadorpresupuestario }}</td>
											<td class="text-right justify-content">{{  number_format($comprascp->monto ,2,',','.') }} </td>
						
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                           <br><br>

                           <table class="table-sm resumen1">
                <thead >
               
                  <tr>
                    <th class="firma" style="width: 50%"></th>
                    <th  class="firma"  style="width: 50%">
                  
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
                                  @php
                                  $ruta ='http://siproapp.ideasrenovacion.com/rutas/SERV-' . $compra->id;

                                  @endphp
                                  <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->generate($ruta)) }}">
                                  </div>

                  </th>
                    
                  </tr>
                </thead>
                
               
              </table>
        </main>  

       

        <footer class="footer">
        <table class="table table-bordered">
                <thead >
               
                  <tr>
                    <th class="firma" style="width: 50%">ADMINISTRADOR(A)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                    
                  </tr>
                </tbody>
               
              </table>
              <div class="pie text-left justify-left">Elaborado por: {{ $compra->usuario->name }}</div>
            </footer>
        <div><!-- fin del div container -->  
</body>
</html>