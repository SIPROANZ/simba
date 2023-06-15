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
                    </div>
                    <div class="col-md-12">
                            <div class="text-center justify-content">
                                    <h2 class="titulo2">REPUBLICA BOLIVARIANA DE VENEZUELA
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
                      <th width="18%">FECHA ELABORACION: </th>
                      <th width="25%" class="encabezado text-center justify-content">3/3/2023</th>
                      <th width="57%" class="encabezado text-center justify-content"></th>

                  </tr>
              </thead>
             <tbody>
                  <tr>
                    <th>N° ORDEN DE PAGO </th>
                      <td  class="encabezado text-center justify-content"> PAGO 0000000</td>
                  </tr>
                   <tr>
                    <th>N° FACTURAS: </th>
                       <td  class="encabezado text-center justify-content">FACTURAS 00000000 </td>

                  </tr>
                  <tr>
                    <th>N° DE COMPROBANTE </th>
                       <td  class="encabezado text-center justify-content">COMPROBANTE 0000000 </td>

                  </tr>

              </tbody>

         </table>




         <table class="table table-bordered table-sm resumen-amd" >
            <thead>
                <tr>

                    <th width="45%" class="encabezado text-center justify-content"> AGENTE DE RETENCION  </th>
                    <th width="25%" class="encabezado text-center justify-content"> 0000000000  </th>
                    <th width="30%" class="encabezado text-center justify-content">   </th>

                </tr>
                    <tr>

                    <th width="25%" class="encabezado text-center justify-content"> NUMERO DEL RIF AGENTE DE RETENCION  </th>
                    <th width="18%" class="encabezado text-center justify-content"> RIF J-0000000000  </th>
                    <th width="70%" class="encabezado text-center justify-content">   </th>
                </tr>
                <tr>
                    <th width="25%" class="encabezado text-center justify-content"> NOMBRE/RAZÓN SOCIAL DEL CONTRIBUYENTE   </th>
                    <th width="18%" class="encabezado text-center justify-content"> NOMBRE -0000000000  </th>
                    <th width="70%" class="encabezado text-center justify-content">   </th>
                </tr>

                <tr>

                    <th width="25%" class="encabezado text-center justify-content"> NUMERO DEL RIF DEL CONTRIBUYENTE</th>
                    <th width="18%" class="encabezado text-center justify-content"> RIF J-0000000000  </th>
                    <th width="70%" class="encabezado text-center justify-content">   </th>

                </tr>








            </thead>
        </tbody>

       </table>
       <table class="table table-bordered table-sm resumen-amd" >
        <thead>
            <tr>
                <th width="100%" class="encabezado text-center justify-content"> CONCEPTO DE LA ORDEN DE PAGO  </th>
            </tr>
            <tr>

                <th width="25%" class="encabezado text-center justify-content"> DETALLE DEL CONCEPTO DE LA ORDEN DE PAGO</th>


            </tr>S
        </thead>

        </table>
        <table class="table table-bordered table-sm resumen-amd" >
         <thead>
            <tr>

                <th width="45%" class="encabezado text-center justify-content"> CALCULO DEL IMPUESTO TIMBRE FISCAL 2%  </th>
                <th width="25%" class="encabezado text-center justify-content">   </th>
                <th width="30%" class="encabezado text-center justify-content">   </th>
            </tr>
            <tr>

                <th width="50%" class="encabezado text-center justify-content"> CALCULO CONTRIBUYENTE ORDINARIO DEL IVA  </th>
                <th width="10%" class="encabezado text-center justify-content">   </th>
                <th width="50%" class="encabezado text-center justify-content">  CALCULO CONTRIBUYENTE FORMAL DEL IVA </th>

            </tr>
            //AACA EL
        </table>
        <table class="table table-bordered table-sm resumen-amd" >
         <thead>
            <tr>

                <th width="15%" class="encabezado text-center justify-content"> MONTO BRUTO  </th>
                <th width="15%" class="encabezado text-center justify-content"> ACA MONTO BRUTO ORDI </th>
                <th width="15%" class="encabezado text-center justify-content">   </th>
                <th width="15%" class="encabezado text-center justify-content">  MONTO BRUTO </th>
                <th width="15%" class="encabezado text-center justify-content"> ACA MONTO BRUTO CONTRI </th>
            </tr>
<tbody>
    <tr>

        <th width="15%" class="encabezado text-center justify-content"> MONTO DEL IVA 16%  </th>
        <th width="15%" class="encabezado text-center justify-content"> ACA MONTO DEL IVA 16% </th>
        <th width="15%" class="encabezado text-center justify-content">   </th>
        <th width="15%" class="encabezado text-center justify-content">  MONTO NETO GRAVABLE </th>
        <th width="15%" class="encabezado text-center justify-content"> ACA MONTO NETO GRAVAB </th>
    </tr>
</tbody>
<tbody>
    <tr>

        <th width="15%" class="encabezado text-center justify-content"> MONTO NETO GRAVABLE  </th>
        <th width="15%" class="encabezado text-center justify-content"> MONTO NETO GRAVABLE</th>
        <th width="15%" class="encabezado text-center justify-content">   </th>
        <th width="15%" class="encabezado text-center justify-content">  </th>
        <th width="15%" class="encabezado text-center justify-content">  </th>
    </tr>
</tbody>

         </thead>


        </table>
        <table class="table table-bordered table-sm resumen-amd" >
         <thead>
            <tr>

                <th width="46%" class="encabezado text-center justify-content"> IMPUESTO TIMBRE FISCAL 2% A RETENER:  </th>
                <th width="15%" class="encabezado text-center justify-content"> 00000000  </th>
                <th width="55%" class="encabezado text-center justify-content">   </th>
            </tr>


   </table>

        </main>
        <br>  <br>
        <footer class="footer">
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th class="firma" >EL LIQUIDADOR <br><br><BR> FIRMA: <BR> <BR> FECHA: </th>
                    <th  class="firma"  >ENTE GUBERNAMENTAL <br> <br>  FIRMA:  <BR> SELLO<BR> <BR> FECHA: </th>
                   <th  class="firma"  >RICIBO POR  <br> <br>  FIRMA:  <BR> SELLO<BR> <BR> FECHA: </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

              </table>



            </footer>
  </body>
</html>
