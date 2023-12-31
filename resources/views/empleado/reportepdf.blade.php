<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> REPORTE DE EMPLEADOS</title>

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    html, body {
    width: 95%;
    height: 100%;
    margin-top: 15px;
    }
    img
    {
   width: 140;
   height: 55;
    }
    .titulo{
    font-size: 14px;
    margin-left: 15px;
    font-family: Arial, sans-serif;

    }
   .titulo2{
    font-size: 13px;
    margin-left: 15px;
    font-family: Arial, sans-serif;
    margin-top: 20px;
    /*background-color:#0380FF;*/

    }
    .subtitulo{
    font-size: 19px;
    margin:19px;
    }



.resumen-amd {
    border: white 10px solid;
    margin-left:10px;
    }
    .resumen-amd th{
    font-size: 10px;
    }
    .resumen-amd td{
    font-size: 10px;
    }

    hr {
    height: 20px;
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
    }
    .resumen1 td{
    font-size: 11px;
    }
    .resumen{
    margin-left:10px;
    }
    .resumen th{
    font-size: 10px;
    }
    .resumen td{
    font-size: 9px;
    }
    P{
    font-size: 11px;
    margin-left: 10px;
    }
    .footer {
    text-align: center;
    justify-content: center;
    margin:auto;
    /*background-color: #F1C40F;*/
    position: fixed;
    width: 95%;
    height: 100px;
    bottom:0;
    margin-bottom:10px;
    margin-left:10px;
    }
    .lateral{
    height: 50px;
    /*background-color: blue; */
    }

   .firma{
    font-size: 10px;
    margin-left: 5px;
    text-align: center;
    justify-content: center;
  }
  .pie{
    font-size: 10px;
    margin-left: 5px;
    text-align: center;
    justify-content: center;

  }
  .contenido{
    text-align: center;
    justify-content: center;
    margin-left:20px;
  }



</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
       <header>
            <section class="content container-fluid">
                <div class="row text-center justify-content">
                    <div class="col-md-12">
                            <div class="float-left">
                            <img src="{{ asset('images/logo.png') }}"> 
                         </div>
                    </div>
                    <div class="col-md-12">
                            <div class="text-center justify-content">
                                    <h2 class="titulo2">PROANZOÁTEGUI<br>
                                    G-20016716-5<br>
                                    <h4>
                                    Reporte de Empleados<br></h4>
                                </h2>

                                   

                            </div>
                    </div>




                </div>
            </section>
        </header>
        <main>

         <!-- Inicio de tabla con todas las PRECOMPROMISOS -->
        
            <table class="table table-bordered table-sm resumen">
                                      <thead class="thead">
                                          <tr>
                                          <th>ID</th>
                                        @if($datos['imagen']=='CON IMAGEN')
                                        <th>Perfil</th>
                                        @endif
										<th>Nombre</th>
										<th>Cedula</th>
                                        @if($datos['imagen']=='CON IMAGEN')
                                        <th>Imagen</th>
                                        @endif
                                        <th>Fecha Nac.</th>
                                        <th>Edad</th>
										<th>Genero</th>
										<th>Telefono</th>
										<th>Tipo</th>
										<th>Pertenece a</th>
                                        <th>Gabinete</th>
                                        <th>Usuario</th>
                                         
      
                                          </tr>
                                      </thead>
                                      <tbody>
                                        

                                      @foreach ($empleados as $empleado)
                                        <tr>
                                            <td>{{ $empleado->id }}</td>
                                            @if($datos['imagen']=='CON IMAGEN')
                                            <td><img src="{{ asset ($empleado->imagen) }}" class="img-responsive" style="max-height: 40px; max-width: 40px" alt="Imagen de perfil del empleado"></td>
                                            @endif
                                            <td>{{ $empleado->nombre }}</td>
											<td>{{ $empleado->cedula }}</td>
                                            @if($datos['imagen']=='CON IMAGEN')
                                            <td><img src="{{ asset ($empleado->imagencedula) }}" class="img-responsive" style="max-height: 40px; max-width: 40px" alt="Imagen de la cedula de identidad del empleado"></td>
                                            @endif
                                            <td>{{ $empleado->created_at->toDateString() }}</td>
                                            <td>
                                            {{ $obj_carbon->createFromDate($obj_carbon->parse($empleado->created_at))->age }}
                                            </td>
											<td>{{ $empleado->genero }}</td>
											<td>{{ $empleado->telefono }}</td>
											<td>{{ $empleado->tipo }}</td>
											<td>{{ $empleado->unidade->nombre }}</td>
                                            <td>{{ $empleado->unidade->gabinete->nombre }}</td>
                                            <td>{{ $empleado->usuario->name }}</td>

                                          
                                        </tr>
                                    @endforeach

                                       
     
                                      </tbody>
                                  </table>




                                  <!-- Resumen Estadistico -->
                                  <table class="table table-bordered table-sm resumen">
                                    <thead class="thead">
                                        <tr>
                                            <th style="text-align: center" colspan="3">RESUMEN EMPLEADO</th>
    
                                        </tr>
                                        <tr>
                                            
                                        <th style="text-align: center">Total Hombres</th>
                                        <th style="text-align: center">Total Mujeres</th>
                                        <th style="text-align: center">Total General</th>
                                            
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <tr>
                                           <td style="text-align: center">
                                                {{ $datos['total_ninos'] }}
                                             </td>
                                             <td style="text-align: center">
                                                {{ $datos['total_ninas'] }}
                                             </td>
                                             <td style="text-align: center">
                                                {{ $datos['total'] }}
                                             </td>
                                            
                                            </tr>

                                            
                                   
                                    </tbody>
                                </table>

                                

                                 <!-- Resumen Filtrado  -->
                                 <table class="table table-bordered table-sm resumen">
                                    <thead class="thead">
                                        <tr>
                                            <th style="text-align: center" colspan="7">FILTRADO POR</th>
    
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">Nombre</th>
                                            <th style="text-align: center">Genero</th>
                                            <th style="text-align: center">Tipo</th>
                                            <th style="text-align: center">Pertenece a</th>
                                            <th style="text-align: center">Gabinete</th>
                                            <th style="text-align: center">Inicio</th>
                                            <th style="text-align: center">Fin</th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <tr>
                                            
                                             <td style="text-align: center">{{ $datos['nombre'] }}</td>
                                             
                                             
                                             <td style="text-align: center">
                                                {{ $datos['genero'] }}
                                              
                                            </td>
                                             <td style="text-align: center"> {{ $datos['tipo'] }}</td>
                                             <td style="text-align: center"> {{ $datos['nombre_unidad'] }}</td>
                                             <td style="text-align: center"> {{ $datos['nombre_gabinete'] }}</td>
                                             <td style="text-align: center"> {{ $datos['inicio'] }}</td>
                                             <td style="text-align: center">{{ $datos['fin'] }}</td>
                                            </tr>

                                            
                                   
                                    </tbody>
                                </table>

                                

                              
       


        
                                </main>
        
                                <br>  <br>
        <footer class="footer">
             

              <div class="pie"></div>

            </footer>
  </body>
</html>