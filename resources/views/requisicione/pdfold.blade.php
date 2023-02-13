<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS only 
     <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css"> 

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  -->
<!--
<style>
    body{
      font-family: arial, sans-serif;
      margin: 45mm 8mm 2mm 8mm;
      
    }
    @page {
       margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #ffffff;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    table{
      border-collapse: collapse;
      width:100%;
    }
    td, th {
      border: 1px solid #dddddd;
      text-aling:left;
      padding: 8px;
    }
    tr:nth-child(even){
      background-color: #dddddd;
    }

    </style>

 Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
  <header> 
  <!-- Tabla para el encabezado -->  
  <!-- DETALLES DE LA REQUISICION-->
  <table class="table table-secondary">
                                <thead class="thead">
                                    <tr>
                                        
										<th>LOGO GOBERNACIÓN</th>
										<th>REPÚBLICA BOLIVARIANA DE VENEZUELA <br>GOBERNACIÓN DEL ESTADO ANZOATEGUI</th>

                                    </tr>
                                </thead>
                                <tbody>
                       
                                   
                                </tbody>
                            </table>
    



  </header> 
  <footer></footer> 

  <!-- DATOS DE LA REQUISICION -->

                        <div class="form-group">
                            <strong>NUMERO: REQ -</strong>
                            {{ $requisicione->correlativo }}
                        </div>
                        <div class="form-group">
                            <strong>TIPO: </strong>
                            {{ $requisicione->tipossgp->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>FECHA</strong>
                            {{ $requisicione->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $requisicione->unidadadministrativa->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $requisicione->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Uso:</strong>
                            {{ $requisicione->uso }}
                        </div>

                        <br><br>
                <!-- MMENSAJE -->
                        <div class="form-group">
                            <strong> Me dirijo a usted en la oportunidad de solicitar el trámite para llevar a cabo la entrega del requerimiento que se especifica a
                            continuación.</strong>
                        </div>
                          <br><br>

                          
    <!-- DETALLES DE LA REQUISICION-->
    <table class="table">
                                <thead class="thead">
                                    <tr>
                                    <th>CANTIDAD</th>
                                    <th>UNIDAD</th>                     
										                <th>DESCRIPCIÓN</th>
										

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesrequisiciones as $detallesrequisicione)
                                        <tr>
                                        <td>{{ $detallesrequisicione->cantidad }}</td>
                                        <td>{{ $detallesrequisicione->nombre }}</td>                    
											                  <td>{{ $detallesrequisicione->descripcion }}</td>
											

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- A#O DEL PRESUPUESTO -->
                        <div class="form-group">
                            <strong> AÑO DEL PRESUPUESTO {{ $requisicione->ejercicio->ejercicioejecucion }}</strong>
                        </div>
                          <br><br>

                          <!-- tabla para colocar el sector de la unidad administrativa -->
    <table class="table table-sm">
                                <thead class="thead">
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
    
                            
                                       
                                       
											

                                        
                                    
</body>
</html>