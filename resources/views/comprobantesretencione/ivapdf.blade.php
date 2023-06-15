<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> COMPROBANTE DE RETENCIÓN I.V.A</title>

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
                                    ADMINISTRACIÓN<br>
                                    <h3 class="subtitulo"> COMPROBANTE DE RETENCIÓN I.V.A </h3>

                            </div>
                    </div>
                </div>
            </section>
        </header>
        <main>


            <table class="table table-bordered table-sm resumen-amd" >
              <thead>
                  <tr>
                      <th width="20%">PROVEEDOR: </th>
                      <td width="50%" class="encabezado text-left justify-content">{{ $comprobantesretencione->ordenpago->beneficiario->nombre }}</td>
                      <th width="15%" class="encabezado text-right justify-content">No COMPROBANTE: </th>
                      <td width="15%" class="encabezado text-left justify-content"><b>{{ $comprobantesretencione->ncomprobante }}</b></td>
                  </tr>
              </thead>
             <tbody>
                  <tr>
                      <th>RIF: </th>
                      <td  class="encabezado text-left justify-content">{{ $comprobantesretencione->ordenpago->beneficiario->caracterbeneficiario . ' - ' .$comprobantesretencione->ordenpago->beneficiario->rif }}</td>
                      <th class="encabezado text-right justify-content">FECHA EMISION: </th>
                      <td  class="encabezado text-left justify-content">{{ $comprobantesretencione->created_at->toDateString() }}</td>

                  </tr>
                   <tr>
                        <th>N° O/P: </th>
                       <td  class="encabezado text-left justify-content">{{ $comprobantesretencione->ordenpago->nordenpago }} </td>
                       <th class="encabezado text-right justify-content">FECHA O/P: </th>
                       <td  class="encabezado text-left justify-content">{{ $comprobantesretencione->ordenpago->created_at->toDateString() }} </td>
                     

                  </tr>
                  {{-- <tr>

                      <th>FECHA O/P: </th>
                       <td  class="encabezado text-left justify-content">{{ $comprobantesretencione->ordenpago->created_at->toDateString() }} </td>
                      <td  class="encabezado text-center justify-content"></td>
                      <td  class="encabezado text-center justify-content"></td>

                  </tr> --}}


              </tbody>

         </table>

         <table class="table table-bordered table-sm resumen-amd" >
            <thead>
                <tr>

                    <th width="25%" class="encabezado text-center justify-content">N° FACTURA </th>
                    <th width="25%" class="encabezado text-center justify-content">N° CONTROL </th>
                    <th width="25%" class="encabezado text-center justify-content">FECHA FACTURA </th>
                    <th width="25%" class="encabezado text-center justify-content">MONTO TOTAL</th>
                    <th width="25%" class="encabezado text-center justify-content">MONTO BASE</th>
                    <th width="25%" class="encabezado text-center justify-content">ALICUOTA</th>
                    <th width="25%" class="encabezado text-center justify-content"> IMPUESTO IVA</th>
                    <th width="25%" class="encabezado text-center justify-content">IMPUESTO RETENIDO</th>
                    <th width="25%" class="encabezado text-center justify-content"> EXCENTO </th>

                </tr>
            </thead>
           <tbody>
            @foreach ($facturas as $item)
                <tr>
                    <td  class="encabezado text-center justify-content">{{ $item->numero_factura }}</td>
                    <td  class="encabezado text-center justify-content">{{ $item->numero_control }}</td>
                    <td  class="encabezado text-center justify-content">{{ $item->fecha }}</td>
                    <td  class="encabezado text-right justify-content">{{ number_format($item->montototal,2,',','.') }}</td>
                    <td  class="encabezado text-right justify-content">{{ number_format($item->montobase,2,',','.') }}</td>
                    <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->detretencione->retencione->porcentaje,2,',','.') }}</td>
                    <td  class="encabezado text-right justify-content">{{ number_format($item->montoiva,2,',','.') }}</td>
                    <td  class="encabezado text-right justify-content">{{ number_format(($item->montoiva * ($comprobantesretencione->detretencione->retencione->porcentaje / 100)),2,',','.') }}</td>
                    <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->ordenpago->montoexento,2,',','.') }}</td>
               </tr>
                @endforeach

                <tr>

                  
                  <th  class="encabezado text-right justify-content" colspan="3">TOTAL: </th>
                  <td  class="encabezado text-right justify-content">{{ number_format(($comprobantesretencione->ordenpago->montobase + $comprobantesretencione->ordenpago->montoiva),2,',','.') }}</td>
                  <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->ordenpago->montobase,2,',','.') }}</td>
                  <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->detretencione->retencione->porcentaje,2,',','.') }}</td>
                  <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->ordenpago->montoiva,2,',','.') }}</td>
                  <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->montoretencion,2,',','.') }}</td>
                  <td  class="encabezado text-right justify-content">{{ number_format($comprobantesretencione->ordenpago->montoexento,2,',','.') }}</td>
  
              </tr>


            </tbody>
       </table>


        </main>
        <br>  <br>
        <footer class="footer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="firma" >FIRMA Y SELLO : <br> Administración
                    </th>
                    <th  class="firma"  >FIRMA Y SELLO <br>Proveedor </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"> </td>
                    <td class="lateral"> </td>
                      </tr>
                </tbody>

              </table>

              <div class="pie">AV 05 DE JULIO, CASCO CENTRAL, BARCELONA ESTADO ANZOÁTEGUI </div>

            </footer>
  </body>
</html>
