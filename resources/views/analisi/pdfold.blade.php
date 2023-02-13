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

  <!-- DATOS DEL ANALISIS -->
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $analisi->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Requisicion:</strong>
                            {{ $analisi->requisicion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Criterio:</strong>
                            {{ $analisi->criterio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Numer0:</strong>
                            {{ $analisi->numeracion }}
                        </div>
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $analisi->observacion }}
                        </div>

    <!-- CREAMOS LOS DATOS DEL ANALISIS DE LA COTIZACION -->
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
										<th>Proveedor</th>
										<th>Analisis</th>
										<th>Bos</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Subtotal</th>
										<th>Iva</th>
										<th>Total</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesanalisis as $detallesanalisi)
                                        <tr>
                                           
											<td>{{ $detallesanalisi->beneficiario->nombre }}</td>
											<td>{{ $detallesanalisi->analisi->numeracion }}</td>
											<td>{{ $detallesanalisi->bo->descripcion }}</td>
											<td>{{ $detallesanalisi->cantidad }}</td>
											<td>{{ $detallesanalisi->precio }}</td>
											<td>{{ $detallesanalisi->subtotal }}</td>
											<td>{{ $detallesanalisi->iva }}</td>
											<td>{{ $detallesanalisi->total }}</td>

                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>

   
    
                            
                                       
                                       
											

                                        
                                    
</body>
</html>