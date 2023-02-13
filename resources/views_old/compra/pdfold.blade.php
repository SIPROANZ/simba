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

<!-- Area para colocar la descripcion de la orden de compra -->
<section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Orden de Compra</span>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="form-group">
                            <strong>NUMERO ORDEN DE COMPRA:</strong>
                            {{ $compra->numordencompra }}
                        </div>
                      

                        <div class="form-group">
                            <strong>NUMERO DE REQUISICION:</strong>
                            {{ $correlativo }}
                        </div>

                        <div class="form-group">
                            <strong>RAZON SOCIAL:</strong>
                            {{ $razon_social }}
                        </div>
                        <div class="form-group">
                            <strong>RIF:</strong>
                            {{ $rif }}
                        </div>

                        <div class="form-group">
                            <strong>SECTOR:</strong>
                            {{ $sector }}
                        </div>

                        <div class="form-group">
                            <strong>SUB-SECTOR:</strong>
                            {{ $sub_sector }}
                        </div>

                        <div class="form-group">
                            <strong>DEPARTAMENTO:</strong>
                            {{ $departamento }}
                        </div>

                        <div class="form-group">
                            <strong>USO DEL BIEN:</strong>
                            {{ $uso }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Area para colocar los detalles del analisis de cotizacion-->
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <?php $subtotal=0; $iva=0; $total=0; ?>
                                    <tr>
                                   
										<th>DESCRIPCION</th>
                                        <th>CANTIDAD</th>
										<th>PRECIO UNITARIO</th>
										<th>PRECIO TOTAL</th>
										   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesanalisis as $detallesanalisi)
                                        <tr>
                                          
											<td>{{ $detallesanalisi->bo->descripcion }}</td>
                                            <td>{{ $detallesanalisi->cantidad }}</td>
											
											<td>{{ $detallesanalisi->precio }}</td>
											<td>{{ $detallesanalisi->subtotal }}
                                            <?php 
                                                $subtotal+=$detallesanalisi->subtotal;
                                                $iva+=$detallesanalisi->iva;
                                                $total+=$detallesanalisi->total;
                                            ?>
                                            </td>
											
                                            
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th></th>
                                        
										
										<th></th>
										<th></th>
										<th>SUB TOTAL</th>
										<th>{{ $subtotal }}</th>
										
                                        
                                    </tr>
                                    <tr>
                                        <th></th>
                                        
										
										<th></th>
										<th></th>
										<th>I.V.A.</th>
										<th>{{ $iva }}</th>
										
                                        
                                    </tr>
                                    <tr>
                                        <th></th>
                                        
										
										<th></th>
										<th></th>
										<th>TOTAL</th>
										<th>{{ $total }}</th>
										
                                        
                                    </tr>
                                </tbody>
                            </table>
    <!-- Tabla con los clasificadores presupuestarios de esta orden de compra -->
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                      
										<th>SECTOR-SUBSECT-SUBPROG-PROY-ACT</th>
										<th>PART-GEN-ESP-SUBESP</th>
										<th>ASIGN. BS</th>
										<th>DISPONIBLE</th>

                               </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprascps as $comprascp)
                                        <tr>
                                           
                                            
											<td>{{ $comprascp->unidadadministrativa->sector .'-'. $comprascp->unidadadministrativa->programa .'-' .$comprascp->unidadadministrativa->subprograma .'-' . $comprascp->unidadadministrativa->proyecto .'-' . $comprascp->unidadadministrativa->actividad }}</td>
											<td>{{ $comprascp->ejecucione->clasificadorpresupuestario }}</td>
											<td>{{ $comprascp->monto }}</td>
											<td>{{ $comprascp->disponible }}</td>

                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


    
                                    
</body>
</html>