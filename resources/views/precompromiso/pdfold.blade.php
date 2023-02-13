<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDf Precompromisos</title>

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
                            <strong>Documento:</strong>
                            {{ $precompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Montototal:</strong>
                            {{ $precompromiso->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $precompromiso->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $precompromiso->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $precompromiso->unidadadministrativa->unidadejecutora }}
                        </div>
                        <div class="form-group">
                            <strong>Tipocompromiso Id:</strong>
                            {{ $precompromiso->tipodecompromiso->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $precompromiso->beneficiario->nombre }}
                        </div>
  
    <!-- DETALLES DE LOS COMPROMISO, IMPUTACIONES PRESUPUESTARIAS -->
    <br><br>
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
                                        
										<th>Montocompromiso</th>
										<th>Precompromiso Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>

                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesprecompromisos as $detallesprecompromiso)
                                        <tr>
                                           
                                            
											<td>{{ $detallesprecompromiso->montocompromiso }}</td>
											<td>{{ $detallesprecompromiso->precompromiso_id }}</td>
											<td>{{ $detallesprecompromiso->unidadadministrativa->denominacion }}</td>
											<td>{{ $detallesprecompromiso->ejecucione->clasificadorpresupuestario }}</td>

                                         
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
    
                                    
                                    
</body>
</html>