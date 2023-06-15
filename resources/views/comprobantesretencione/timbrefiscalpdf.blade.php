<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> COMPROBANTE DE RETENCIÓN TIMBRE FISCAL</title>

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    html, body {
    width: 95%;
    height: 95%;
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
    font-size: 11px;
    }
    .resumen-amd td{
    font-size: 11px;
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
    font-size: 10px;
    /*background-color: blue; */
    }

   .firma{
    font-size: 10px;
  }
  .pie{
    font-size: 10px;
    margin-left: 5px;

  }
  .contenido{
    text-align: center;
    justify-content: center;
    margin-left:10px;
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
                    <div class="col-md-12">
                            <div class="text-center justify-content">
                                    <h2 class="titulo2">REPÚBLICA BOLIVARIANA DE VENEZUELA
                                        <br>   PROANZOÁTEGUI<br>
                                        SUPERINTENDENCIA DE ADMINISTRACIÓN TRIBUTARIA DEL ESTADO ANZOÁTEGUI<br>
                                    <h3 class="subtitulo"> </h3>

                            </div>
                    </div>
                </div>
            </section>
        </header>
        <main>
            <table class="table table-bordered table-sm resumen-amd" >
              <thead>
                  <tr>
                      <th  class="encabezado text-right justify-content">FECHA ELABORACIÓN: </th>
                      <td  class="encabezado text-left justify-content">{{ $comprobantesretencione->created_at->toDateString() }}</th>
                      <th  class="encabezado text-right justify-content">N° ORDEN DE PAGO: </th>
                      <td  class="encabezado text-left justify-content"><b>{{ $comprobantesretencione->ordenpago->nordenpago }}</b></td>

                  </tr>
              </thead>
             <tbody>
                  <tr>
                      <th class="encabezado text-right justify-content">N° FACTURAS: </th>
                      <td  class="encabezado text-left justify-content"> <b>
                    @foreach ($facturas as $item)
                    {{ $item->numero_factura . ', ' }} 
                    @endforeach
                
                      </b>
                </td>
                  
                      <th class="encabezado text-right justify-content">N° COMPROBANTE: </th>
                    <td  class="encabezado text-left justify-content"><b>{{ $comprobantesretencione->ncomprobante }}</b> </td>

                    
                  </tr>

                  <tr>

                    <th colspan="4" class="encabezado text-center justify-content"> PLANILLA PARA EL CALCULO DEL IMPUESTO TIMBRE FISCAL {{ $comprobantesretencione->detretencione->retencione->porcentaje  }} % <br>
                        AGENTES DE RETENCIÓN <br>
                        SECTORES ENTES PÚBLICOS </th>
                   

                </tr>

                 
                  

              </tbody>

         </table>

         <table class="table table-bordered table-sm resumen-amd" >
            <thead>
                <tr>

                    <td class=" text-left justify-content"> AGENTE DE RETENCIÓN: PROANZOATEGUI </td>
                 </tr>

                 <tr>

                    <td class=" text-left justify-content"> NÚMERO DE RIF DEL AGENTE DE RETENCIÓN: G-20... </td>
                 </tr>

                    <tr>

                    <td class=" text-left justify-content"> NOMBRE/RAZÓN SOCIAL DEL CONTRIBUYENTE <br>  <h4> <b>{{ $comprobantesretencione->ordenpago->beneficiario->nombre }} </b> </h4></td>
                    
                </tr>

            

                <tr>
                    <td class=" text-left justify-content"> NÚMERO DEL RIF DEL CONTRIBUYENTE: {{ $comprobantesretencione->ordenpago->beneficiario->rif }} </td>
                    
                </tr>

                <tr>

                    <td class="text-left justify-content"> CONCEPTO DE LA ORDEN DE PAGO:
                    <br>{{ $concepto }}

                    </td>
                    

                </tr>








            </thead>
        </tbody>

       </table>


        <table class="table table-bordered table-sm resumen-amd" >
         <thead>

            <tr>

                <th colspan="4" class="encabezado text-center justify-content"> CALCULO DEL IMPUESTO TIMBRE FISCAL {{ $comprobantesretencione->detretencione->retencione->porcentaje  }} %  </th>
                
            </tr>
            <tr>

                <th width="50%" colspan="2" class="encabezado text-center justify-content"> CALCULO CONTRIBUYENTE ORDINARIO DEL IVA  </th>
                
                <th width="50%" colspan="2" class="encabezado text-center justify-content">  CALCULO CONTRIBUYENTE FORMAL DEL IVA </th>

            </tr>

            <tr>

                <td class="encabezado text-center justify-content"> MONTO BRUTO  </td>
                <td class="encabezado text-center justify-content"> {{ number_format($comprobantesretencione->ordenpago->montobase,2,',','.') }} </td>
                
                <td class="encabezado text-center justify-content">  MONTO BRUTO </td>
                <td class="encabezado text-center justify-content"> 0,00 </td>
            </tr>
<tbody>
    <tr>

        <td class="encabezado text-center justify-content"> MONTO DEL IVA 16%  </td>
        <td class="encabezado text-center justify-content"> {{ number_format($comprobantesretencione->ordenpago->montoiva,2,',','.') }} </td>
        
        <td class="encabezado text-center justify-content">  MONTO NETO GRAVABLE </td>
        <td class="encabezado text-center justify-content"> 0,00 </td>
    </tr>
</tbody>
<tbody>
    <tr>

        <td  class="encabezado text-center justify-content"> MONTO NETO GRAVABLE  </td>
        <td class="encabezado text-center justify-content">  {{ number_format($monto_total_grabable,2,',','.') }}</td>
        <td colspan="2" class="encabezado text-center justify-content"> </td>
    </tr>
    
</tbody>

         </thead>


        </table>
        <table class="table table-bordered table-sm resumen-amd" >
         <thead>
            <tr>

                <td width="50%" class="encabezado text-right justify-content"> IMPUESTO TIMBRE FISCAL {{ $comprobantesretencione->detretencione->retencione->porcentaje  }} % A RETENER:  </th>
                <td width="50%" class="encabezado text-left justify-content"> {{ number_format($comprobantesretencione->montoretencion,2,',','.') }} </th>
                
            </tr>

   </table>

        </main>
        <br>  <br>
        

            <footer class="footer">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="33.33%" class="firma" >EL LIQUIDADOR </th>
                      <th width="33.33%" class="firma"  >ENTE GUBERNAMENTAL </th>
                      <th width="33.33%" class="firma"  >RICIBIDO POR </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="lateral">FIRMA: <BR> <BR> FECHA: </td>
                      <td class="lateral">FIRMA:  <BR><BR> SELLO:<BR> <BR> FECHA: </td>
                      <td class="lateral">FIRMA:  <BR><BR> SELLO:<BR> <BR> FECHA: </td>
                        </tr>
                  </tbody>
  
                </table>
  
                
              </footer>
  </body>
</html>