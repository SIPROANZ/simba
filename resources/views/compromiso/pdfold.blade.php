<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Compromisos</title>

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
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $compromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $compromiso->tipodecompromiso->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Ncompromiso:</strong>
                            {{ $compromiso->ncompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $compromiso->beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Montocompromiso:</strong>
                            {{ $compromiso->montocompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $compromiso->status }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $compromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $compromiso->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Precompromiso Id:</strong>
                            {{ $compromiso->precompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Compra Id:</strong>
                            {{ $compromiso->compra_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ayuda Id:</strong>
                            {{ $compromiso->ayuda_id }}
                        </div>

                        <div class="form-group">
                            <strong>COMPROMISO ID:</strong>
                            {{ $compromiso->id }}
                        </div>

                        <div class="form-group">
                            <strong>CONCEPTO:</strong>
                            {{ $concepto }}
                        </div>
                        
                    

    <!-- DETALLES DE LOS COMPROMISO, IMPUTACIONES PRESUPUESTARIAS -->
    <br><br>
                        <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                    
                                        
										
										<th>CLASIFICACION PROGRAMATICA</th>
										<th></th>
										<th></th>
                                        <th>MONTO COMPROMISO</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            
                                            
											
											
											<td>{{ $detallescompromiso->unidadadministrativa->sector . " " . $detallescompromiso->unidadadministrativa->programa . " " . $detallescompromiso->unidadadministrativa->subprograma . " " . $detallescompromiso->unidadadministrativa->proyecto . " " . $detallescompromiso->unidadadministrativa->actividad  . " " .$detallescompromiso->ejecucione->clasificadorpresupuestario  }}</td>
											<td>{{ $datos[$detallescompromiso->ejecucion_id] }}</td>
                                            <td></td>
                                            <td>{{ $detallescompromiso->montocompromiso }}</td>

                                           
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tr>
                                            
											<td> </td>
											<td></td>
                                            <td>Total</td>
                                            <td>{{ $totalcompromiso }}</td>
     
                                        </tr>
                            </table>
  

   
    
                            
                                       
                                       
											

                                        
                                    
</body>
</html>