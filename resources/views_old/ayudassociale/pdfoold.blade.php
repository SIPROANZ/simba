<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Ayudas Sociales</title>

    <!-- CSS only 
     <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css"> 

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  -->
<!--


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

  <!-- DATOS DEL COMPROMISO -->
  <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ayudassociale->beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ayudassociale->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto total de la ayuda:</strong>
                            {{ $ayudassociale->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ayudassociale->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $ayudassociale->unidadadministrativa->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $ayudassociale->tipodecompromiso->nombre }}
                        </div>

    <!-- DETALLES DE LOS COMPROMISO, IMPUTACIONES PRESUPUESTARIAS -->
    <br><br>
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                      
                                        
										<th>Montocompromiso</th>
										<th># Ayuda</th>
										<th>Unidadadministrativa</th>
										<th>Ejecucion</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesayudas as $detallesayuda)
                                        <tr>
                                          
                                            
											<td>{{ $detallesayuda->montocompromiso }}</td>
											<td>{{ $detallesayuda->ayuda_id }}</td>
											<td>{{ $detallesayuda->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallesayuda->ejecucione->clasificadorpresupuestario }}</td>

                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>  
  

   
    
                            
                                       
                                       
											

                                        
                                    
</body>
</html>