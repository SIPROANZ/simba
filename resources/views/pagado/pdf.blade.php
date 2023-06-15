<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagado</title>

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
  margin-top: 20px; 
  margin-bottom: 20px; 
  }

  img
  {
   width: 140px;
   height: 55px;
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
   width: 80px;
   text-align: center;
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
  /* border: 0.5px solid #0a0a0a; */
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
                <tr>
                 
                
                <th class="text-center justify-content">   
                 <img src="{{ asset('images/logo.png') }}"> 
                </th>



                    <th class="text-center">

                        <h2 class="titulo" >REPÚBLICA BOLIVARIANA DE VENEZUELA <br> PROANZOÁTEGUI
                        <br> ADMINISTRACIÓN - PAGADO<h2>
                        
                    </th>


                    <th>

              <table class="table table-bordered table-sm resumen text-right justify-content">
                
                <tr>


                   <th scope="row">NRO. PAGADO:</th>
                   <th scope="row">NRO. ORDEN DE PAGO:</th>
                </tr>
                   <tr>
                        <td> 

                                {{ $pagado->correlativo }}

                        </td>
                        <td>  
            {{ $pagado->ordenpago->nordenpago }}

                        </td>
                   </tr>
                  
                   <tr>
                      <th colspan="2" scope="row"><strong>FECHA:</strong></th>
                   </tr>
                   <tr>
                      <td colspan="2">{{ $pagado->created_at }}</td>
                   </tr>
                   </table>  

            </th>
                </tr>
            </table>
        </header>


        <main>
       

        <!-- Datos del beneficiario -->
        <table class="table table-bordered table-sm resumen ">
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
                    <td colspan="3">{{ $pagado->beneficiario->nombre }}</td>
                    <td>{{ $pagado->beneficiario->caracterbeneficiario . ' - ' . $pagado->beneficiario->rif }} </td>
                </tr>
               
               </tbody>

            </table>

            <!-- CARACTERISTICAS DEL PAGO -->
           
            <!-- tabla para colocar el sector de la unidad administrativa -->
           

            <!-- A#O DEL PRESUPUESTO -->
           
            <!-- tabla para colocar el sector de la unidad administrativa -->
          

            <!-- tabla para colocar el sector de la unidad administrativa -->
            <table class="table table-bordered table-sm resumen ">
                <thead class="thead table-secondary">
                    <tr>
                      <th  class="text-center justify-content">MONTO PAGADO</th>
                      <th  class="text-center justify-content">MONTO ORDEN PAGO</th>
                      <th  class="text-center justify-content">MONTO POR PAGAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="right"> {{ number_format($pagado->montopagado,2,',','.')  }}</td>
                        <td align="right"> {{ number_format($pagado->montoordenpago,2,',','.') }}</td>

                        <td align="right"> {{ number_format(($pagado->montoordenpago - $pagado->montopagado),2,',','.') }}</td>

                       </tr>
                </tbody>
             </table>


                       <!-- tabla para cargar las retenciones de la orden de pago -->

            @if(count($transferencias)>0)
            <table class="table table-bordered table-sm resumen ">
            <thead class="thead table-secondary">
                <tr>
                    
                <th>EGRESO</th>
                <th>REFERENCIA</th>
                <th>BANCO</th>
                    <th class="text-right justify-content">MONTO</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($transferencias as $valor)
                <tr>
                    <td> {{ $valor->egreso }}</td>
                    <td> {{ $valor->referenciabancaria }}</td>
                    <td> {{ $valor->cuentasbancaria->cuenta . ', ' . $valor->cuentasbancaria->banco->denominacion }}</td>
                    <td class="text-right justify-content"> {{ number_format($valor->montotransferencia,2,',','.') }}</td>
                </tr>
                @endforeach

                <tr>
                    <th colspan="3" class="text-right justify-content">TOTAL</th>
                    <th class="text-right justify-content">{{ number_format($total_transferencia,2,',','.') }}</th>
                </tr>
            </tbody>
            </table>
            @else
            <table class="table table-bordered table-sm resumen ">
            <thead class="thead table-secondary">
                <tr>
                    <th>EGRESO</th>
                    <th class="text-left justify-content">REFERENCIA</th>
                    <th>BANCO</th>
                    <th class="text-right justify-content">MONTO</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <td> </td>
                    <td class="text-right justify-content"> </td>
                    <td> </td>
                    <td class="text-right justify-content"> 0,00</td>
                </tr>

                <tr>
                    <th class="text-right justify-content" colspan="3">TOTAL</th>
                    <th class="text-right justify-content">0,00</th>
                </tr>
            </tbody>
            </table>
            @endif

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
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      @php

      $ruta ='http://siproapp.ideasrenovacion.com/rutas/PAG-' . $pagado->id;

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
                    <th width="50%" class="firma">GERENTE(A) DE ADMINISTRACION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                  </tr>
                </tbody>
              </table>
              <div class="pie text-left justify-left">Elaborado por: {{ $pagado->usuario->name }}</div>
        </footer>
      </div>

</body>
</html>