<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisicion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
   @page {
margin: 150px 10px 140px 10px;
}

header {
position: fixed;
top: -120px;

left: 20px;
right: 35px;
height: 50px;
/** Extra personal styles 
background-color: #03a9f4;
color: white;
text-align: center;
line-height: 35px; **/
}

footer {
position: fixed;
bottom: -30px;
left: 45px;
right: 35px;
height: 50px;

/** Extra personal styles 
background-color: #03a9f4;
color: white;
text-align: center;
line-height: 35px; **/
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
 
  td{
    padding-left:12px;
  }
  .resumen1{
  /* margin-left:10px;
    margin-right:10px; */
    left: 45px;
right: 35px;
    
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
   /* margin-left:10px;
    margin-right:10px; */

    left: 45px;
right: 35px;
  }
  .resumen th{
    font-size: 11px;
  }
  .resumen td{
    font-size: 10px;
    text-align: justify;
  }

  .encabezado{
    font-size: 13px; 
  }
  P{
    font-size: 10px;  
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
   margin-bottom:50px;
   margin-left:10px;
   }

   .imagenright {
   text-align: right;
   justify-content: right;
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
                             <h2 class="titulo2" >REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI<h2>
                              <h2 class="titulo2" > G-20016716-5 <h2>
                             <h3 class="subtitulo">REQUISICIÓN</h3> 
                          </th>
                          <th scope="col">
                            <table class="table-sm resumen1">
                             
                                <tr>

                                  <th> 
                                  <div style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  @php
                                  $ruta ='http://siproapp.ideasrenovacion.com/rutas/REQ-' . $requisicione->correlativo;

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
  <!-- DATOS DE LA REQUISICION -->
  <main>
      <table class="resumen1">
          <tr>
             <th scope="row">FECHA:</th>
             <td>{{ $requisicione->created_at->toDateString() }}</td>
             <th scope="row" class="text-right">NUMERO:</th>
             <td class="text-left">REQ - {{ $requisicione->correlativo }}</td>
          </tr>
          <tr>
            <th scope="row"> <strong>UNIDAD SOLICITANTE:</strong></th>
            <td> {{ $requisicione->unidadadministrativa->unidadejecutora }}</td>
            <th scope="row" class="text-right"> <strong>TIPO:</strong></th>
            <td class="text-left"> {{ $requisicione->tipossgp->denominacion }} </td>
          </tr>
      
           <br>
          <tr>
            <th scope="row"><strong>CONCEPTO:</strong></th>
            <td class="justify-content" colspan="3"> {{ $requisicione->concepto }}</td>
          </tr>
          <br>

          <tr>
            <th scope="row"><strong>USO:</strong></th>
            <td class="justify-content" colspan="3"> {{ $requisicione->uso }}</td>
          </tr>
      </table>
      <br>
      <!-- MMENSAJE -->
      <div>
        <p> Me dirijo a Usted en la oportunidad de solicitar el trámite 
        para llevar a cabo la entrega del requerimiento que se especifica a continuación :</p>
      </div>
      <br>
      <!-- DETALLES DE LA REQUISICION-->
     <table class="table table-bordered table-sm resumen">
        <thead class="table-secondary">
            <tr>
              <th class="encabezado text-center justify-content">CANTIDAD</th>
              <th class="encabezado text-center justify-content">UNIDAD</th>                     
              <th class="encabezado text-center justify-content">DESCRIPCIÓN</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($detallesrequisiciones as $detallesrequisicione)
        <tr>
       
            <td>{{  number_format($detallesrequisicione->cantidad,2,',','.') }}</td>
            <td>{{ $detallesrequisicione->nombre }}</td>                    
						<td>{{ $detallesrequisicione->descripcion }}</td>
				</tr>
        @endforeach
       </tbody>
     </table>
    
     <!-- A#O DEL PRESUPUESTO -->
     <div class="form-group">
        <h2 class="titulo"><strong> AÑO DEL PRESUPUESTO {{ $requisicione->ejercicio->ejercicioejecucion }}</strong><h2>
     </div>
     <!-- tabla para colocar el sector de la unidad administrativa -->
     <table class="table table-bordered table-sm resumen ">
        <thead class="thead table-secondary">
            <tr>
              <th>SECTOR</th>
              <th>PROGRAMA</th>                     
						  <th>ACTIVIDAD</th>
              
              <th>PARTIDA</th>
              <th>GENERICA</th>
              <th>ESPECIFICA</th>
              <th>SUB-ESP</th>
            </tr>
        </thead>
        <tbody>  
          @foreach ($partidas as $valor) 
            <tr>
                <td> {{ $requisicione->unidadadministrativa->sector }}</td>
                <td> {{ $requisicione->unidadadministrativa->programa }}</td>
                <td> {{ $requisicione->unidadadministrativa->actividad }}</td>
                
                  <?php 
                    $clasificador = explode('.',  $valor->claspres);               
                  ?>
                <td>{{  $clasificador[0] . '.' . $clasificador[1] }}</td>
                <td>{{  $clasificador[2] }}</td>
                <td>{{  $clasificador[3] }}</td>
                <td>{{  $clasificador[4] }}</td>
              </tr>
          @endforeach
        </tbody>
     </table>
 </main>

 <footer>
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
              <div class="pie text-left justify-left">ELABORADO POR EL USUARIO:  {{ $requisicione->usuario->name; }}</div>
        </footer>


  </div> <!--fin de container--->
 
                            
                                       
                                       
						                                
</body>
</html>