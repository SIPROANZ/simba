<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisicion - Depurar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
    padding-left:12px;
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
   margin-bottom:50px;
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
                   <thead class="thead">
                        <tr>
                         
                        <th class="text-center justify-content " scope="col">  
                          <img src="{{ asset('images/logo.png') }}"> 
                        </th>
                        <th class="text-center ">
                             <h2 class="titulo2" >REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI
 <h2>
                             <h3 class="subtitulo">REQUISICIÓN.</h3> 
                          </th>
                          <th scope="col">
                            <table class="table table-bordered border-dark  table-sm resumen1">
                              <thead >
                                <tr>
                                  <th> <h3 class="titulo">NUMERO </h3></th>
                                  <th><h3 class="titulo">TIPO</h3></th>
                                </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <td ><h3 class="titulo">REQ-{{ $requisicione->correlativo }}</h3></td>
                                <td><h3 class="titulo">{{ $requisicione->tipossgp->denominacion }}</h3></td>
                              </tr>
                                </tbody>
                              </table>
                          </th>
                        </tr>
                    </thead>
                    
                </table>
                <hr>
           </header>
  <!-- DATOS DE LA REQUISICION -->
  <main>
      <table class="resumen1">
          <tr>
             <th scope="row">FECHA:</th>
             <td>{{ $requisicione->created_at->toDateString() }}</td>
          </tr>
          <tr>
            <th scope="row"> <strong>UNIDAD SOLICITANTE:</strong></th>
            <td> {{ $requisicione->unidadadministrativa->unidadejecutora }}</td>
          </tr>
          <tr>
            <th scope="row"><strong>CONCEPTO:</strong></th>
            <td> {{ $requisicione->concepto }}</td>
          </tr>
          <tr>
            <th scope="row"><strong>USO:</strong></th>
            <td> {{ $requisicione->uso }}</td>
          </tr>
      </table>
      <br>
      <!-- MMENSAJE -->
      <div>
        <p> Me dirijo a usted en la oportunidad de solicitar el trámite 
        para llevar a cabo la entrega del requerimiento que se especifica a continuación</p>
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
						<td>{{ $detallesrequisicione->descripcion . ' - ' . $detallesrequisicione->cuenta }}</td>
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
              <th>META</th>
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
                <td>{{ $valor->meta_id }}</td>
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

 <footer class="footer">
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th class="firma" >PRESIDENTE(A)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                  </tr>
                </tbody>
              </table>
              <div class="pie text-left justify-left">ELABORADO POR EL USUARIO :  {{ $requisicione->usuario->name; }}</div>
        </footer>


  </div> <!--fin de container--->
 
                            
                                       
                                       
						                                
</body>
</html>