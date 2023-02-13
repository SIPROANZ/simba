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


 Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<!-- Area para colocar la descripcion de la orden de compra -->
<section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Modificacion Presupuestaria</span>
                        </div>
                       
                    </div>

                    <div class="card-body">

                    <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $modificacione->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de modificacion:</strong>
                            {{ $modificacione->tipomodificacione->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Numero credito:</strong>
                            {{ $modificacione->ncredito }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $modificacione->descripcion }}
                        </div>



                        
                       

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Area para colocar los detalles del analisis de cotizacion-->
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                      
                                    <th>S/P/SP/PR/A</th>
                                    <th>POA</th>
                                    <th>META</th>
                                    <th>P/G/E/SE</th>
										<th>FINANCIAMIENTO</th>
										<th>AUMENTO</th>
										<th>DISMINUCION</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $aumento=0;
                                       $disminucion=0;
                                ?>
											
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                           
                                            <?php

                                            $aumento+=$detallesmodificacione->montoacredita;
                                            $disminucion+=$detallesmodificacione->montodebita;
                                            
                                            $spsppra= $detallesmodificacione->unidadadministrativa->sector . '.' . $detallesmodificacione->unidadadministrativa->programa . '.' . $detallesmodificacione->unidadadministrativa->subprograma . '.' . $detallesmodificacione->unidadadministrativa->proyecto . '.' . $detallesmodificacione->unidadadministrativa->actividad;
                                            ?>
											
                                            <td>{{ $spsppra }}</td>
                                            <td>{{ $detallesmodificacione->ejecucione->poa_id }}</td>
                                            <td>{{ $detallesmodificacione->ejecucione->meta_id }}</td>
                                            <td>{{ $detallesmodificacione->ejecucione->clasificadorpresupuestario }}</td>
										    <td>ordinario</td>
										
											<td>{{ number_format($detallesmodificacione->montoacredita, 2,',','.') }}</td>
											<td>{{ 
                                                number_format($detallesmodificacione->montodebita, 2,',','.') }}</td>

                                            
                                        </tr>
                                    @endforeach

                                    <tr>
                                           
                                            
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
										    <th>TOTAL</th>
										
											<td>{{ 
                                                number_format($aumento, 2,',','.') }}</td>
											<td>{{ 
                                                number_format($disminucion, 2,',','.') }}</td>

                                            
                                        </tr>
                                </tbody>
                            </table>



    
                                    
</body>
</html>