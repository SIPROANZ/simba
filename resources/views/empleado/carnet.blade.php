<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificacion de Carnet de Empleado Publico</title>

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css"> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<style>
  * {
    margin: 0;
    padding:0;
  }
  html, body {
  width:100%;
  height: 100%;
  
  margin-top: 60px; 
  margin-bottom: 60px; 

  background-image: url({{ asset('images/logo.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            background-size: 100%;
            margin: 0px;
  }

 
  
  img
  {
   width: 140;
   height: 55;
  }

  .titulo{
    font-size: 13px;
    margin-left: 5px; 
    font-family: Arial, sans-serif;

  }

  .subtitulo{
    font-size: 19px; 
    margin:19px;
  }
  hr {
  height: 15px;
  width: 100%;
  /*background-color:#0380FF;*/
  background-color: #000000;
  }
  td{
    padding-left:15px;
  }

  .resumen1{
    margin-left:10px;
    text-align: center;
  }

  .resumen1 th{
    font-size: 11px;
  }

  .resumen1 td{
    font-size: 11px;
    text-align: center;
  }

  .resumen1 img
  {
   width: 70px;
   height: 70px;
  }


  .resumen{
    margin-left:10px;
  }
  .resumen th{
    font-size: 11px;
  }
  .resumen td{
    font-size: 9px;
    text-align: justify;
  }

  .encabezado{
    font-size: 5px; 
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
   margin-bottom:40px;
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

  .circular--landscape {
  display: inline-block;
  position: relative;
  width: 100px;
  height: 100px;
  overflow: hidden;
  border-radius: 50%;
}

.circular--landscape img {
  width: auto;
  height: 100%;
 /* margin-left: -50px; */
}

.qr {
  display: inline-block;
  position: relative;
  width: 100px;
  height: 100px;
  overflow: hidden;
 /* border-radius: 50%; */
}

.qr img
  {
   width: 70px;
   height: 70px;
  }
</style>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
        <header>
               
        </header>
        <main>

       

        <table class="table-sm resumen">
                             
                             <tr>

                               <td style="text-align: center;"> 
                              
                               <div class="col-sm-4">
                        <div class="form-group">

                        <div style="width: 18rem;">

                                <div class="circular--landscape" style="text-align: center;">
                                <img src="{{ asset ($empleado->imagen) }}" alt="Imagen de Perfil del empleado">
                                
                                </div>

                                                                      <p>
                                                                      <strong>Nombre:</strong>
                                                                      {{ $empleado->nombre }} <br>
                                                                      <strong>Cedula:</strong>
                                                                      {{ $empleado->cedula }} <br>
                                                                      <strong>Fecha de Nacimiento:</strong>
                                                                      {{ $empleado->created_at->toDateString() }}<br>
                                                                      <strong>Edad:</strong>
                                                                      {{ $obj_carbon->createFromDate($obj_carbon->parse($empleado->created_at))->age }}<br>
                                                                      <strong>Genero:</strong>
                                                                      {{ $empleado->genero }}<br>
                                                                      <strong>Telefono:</strong>
                                                                      {{ $empleado->telefono }}<br>
                                                                      <strong>Tipo:</strong>
                                                                      {{ $empleado->tipo }}<br>
                                                                      <strong>Pertenece a:</strong>
                                                                      {{ $empleado->unidade->nombre }}<br>
                                                                      <strong>Gabinete:</strong>
                                                                      {{ $empleado->unidade->gabinete->nombre }}
                                                                      </p>
                                                                      

                                                                      
                                                                        <div class="qr" style="text-align: center;">
                                                                              @php
                                                                              $ruta ='http://localhost/simba/public/empleados/'. $empleado->id;
                                                                              @endphp
                                                                              <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->generate($ruta)) }}" alt="Código Qr">
                                                                         </div>
                                                                        
          
                                              
                                                              </div>

                        </div>
                        </div>

                               </td>
                               <td> 
                              
                           <!-- Lado derecho del carnet -->



                               </td>
                             </tr>
                          
                           
                           </table>
            
       </main>

       <footer class="footer">
              
             
        </footer>
      </div> 
                                                                
</body>
</html>