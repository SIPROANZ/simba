<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSFERENCIAS ENTRE CUENTAS</title>

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
  margin-top: 20px; 
  margin-bottom: 20px; 
  }

  img
  {
   width: 160;
   height: 55px;
  }

  .titulo{
   text-align: center;
    font-size: 13px;
    margin-left: 5px;
    font-family: Arial, sans-serif;
  }

  .subtitulo{
   text-align: center;
   justify-content: center;
    font-size: 19px;
    margin:19px;
  }
  .logo{
   width: 350px;
   text-align: center;
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
  }
  .resumen1 th{
    font-size: 12px;
  border: 0.5px solid #0a0a0a;
  border-collapse: collapse;
   text-align: center;
   justify-content: center;
  /* width: 160px; */
  }
  .resumen1 td{
    font-size: 11px;
  border: 0.5px solid #0a0a0a;
   text-align: center;
   justify-content: center;
  /* width: 160px; */
   font-weight: normal;
  }


  .resumen{
    margin-left:10px;
  }
  .resumen th{
    font-size: 11px;
  }
  .resumen td{
    font-size: 10px;
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
    font-size: 10px;
    margin-left: 5px;  
  }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
        <header>
            <table>
                <tr>
               
                <th class="text-center justify-content">   
                 <img src="{{ asset('images/logo.png') }}"> 
                </th>

                    <th class="text-center">
                        <h2 class="titulo" >REPÚBLICA BOLIVARIANA DE VENEZUELA <br> PROANZOATEGUI
                        <br>ADMINISTRACIÓN - TRANSFERENCIA ENTRE CUENTA<h2>
                        <h2 class="titulo">FECHA: {{ $transferenciaentrecuenta->created_at->toDateString() }}</h2>
                        
                    </th>
                    
                </tr>
            </table>
        </header>
        <main>
       

        <!-- Datos del beneficiario -->
        <table class="table table-bordered table-sm resumen">


                    <tr>
                      <th><strong>COMPROBANTE DE TRANSFERENCIA ENTRE CUENTAS:</strong></th>
                      <td class="text-center justify-content"><strong>{{ $transferenciaentrecuenta->id }}</strong></td>
                   </tr>
                  

                   <thead class="thead table-secondary">

                   <tr>
                     <th colspan="2" class="text-center justify-content">MOTIVO DE LA TRANSFERENCIA ENTRE CUENTAS</th>
                     
                     
                   </tr>
               </thead>
               <tbody>
                <tr>
                    <td colspan="2">{!! $transferenciaentrecuenta->descripcion !!}</td>
                 </tr>
               
               </tbody>

               <thead class="thead table-secondary">

                   <tr>
                     <th colspan="2" class="text-center justify-content">MONTO EN LETRAS</th>
                      
                   </tr>
               </thead>
               <tbody>
                <tr>
                    <td colspan="2" class="text-center justify-content">{{ '(*** ' .  $total_letras . ' ***)' }}</td>
                  </tr>
               
               </tbody>
               <thead class="thead table-secondary">

                   <tr>
                     <th>BANCO DESTINO:</th>
                     
                     <th>CUENTA BANCARIA DESTINO.</th>
                   </tr>
               </thead>
               <tbody>
                <tr>
                    <td>{{ $transferenciaentrecuenta->bancodestino->denominacion }}</td>
                    <td>{{ $transferenciaentrecuenta->cuentasbancariadestino->cuenta }} </td>
                </tr>
               
               </tbody>

            </table>

            

          
            <table class="table table-bordered table-sm resumen ">
            <thead class="thead table-secondary">
                <tr>
                    
                
                <th>REFERENCIA</th>
                <th>BANCO ORIGEN</th>
                <th>NUMERO CUENTA ORIGEN</th>
                    <th class="text-right justify-content">MONTO</th>
                </tr>
            </thead>
            <tbody>

               
                <tr>
                    <td> {{ $transferenciaentrecuenta->referencia }}</td>
                    <td> {{ $transferenciaentrecuenta->banco->denominacion }}</td>
                    <td> {{ $transferenciaentrecuenta->cuentasbancaria->cuenta  }}</td>
                    <td class="text-right justify-content"> {{ number_format($transferenciaentrecuenta->monto,2,',','.') }}</td>
                </tr>
               

                <tr>
                    <th colspan="3" class="text-right justify-content">TOTAL</th>
                    <th class="text-right justify-content">{{ number_format($transferenciaentrecuenta->monto,2,',','.') }}</th>
                </tr>
            </tbody>
            </table>
           
       </main>

       <footer class="footer">
              <table class="table table-bordered">
                <thead >
                  <tr>
                    <th width="50%" class="firma">ADMINISTRADOR(A):</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="lateral"></td>
                    
                  </tr>
                </tbody>
              </table>

              <div class="pie text-left justify-left">ELABORADO POR:  {{ $transferenciaentrecuenta->usuario->name }}</div>

        </footer>
      </div>

</body>
</html>