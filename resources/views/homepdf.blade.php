<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen Presupuestario y Financiero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
   @page {
margin: 150px 10px 140px 10px;
}

header {
position: fixed;
top: -120px;

left: 20px;
right: 35px;
height: 50px;
/** Extra personal styles 
background-color: #03a9f4;
color: white;
text-align: center;
line-height: 35px; **/
}

footer {
position: fixed;
bottom: -30px;
left: 45px;
right: 35px;
height: 50px;

/** Extra personal styles 
background-color: #03a9f4;
color: white;
text-align: center;
line-height: 35px; **/
}
  
 
  .titulo{
    font-size: 9px;
    margin-left: 15px; 
    font-family: Arial, sans-serif;

  }
  .titulo2{
    font-size: 13px;
    margin-left: 15px; 
    font-family: Arial, sans-serif;

  }
  .subtitulo{
    font-size: 19px; 
    margin:19px;
  }
 
  td{
    padding-left:12px;
  }
  .resumen1{
  /* margin-left:10px;
    margin-right:10px; */
    left: 45px;
right: 35px;
    
  }
  .resumen1 th{
    font-size: 11px;
  }
  .resumen1 td{
    font-size: 11px;
    text-align: justify;
  }
 
  .resumen{
   /* margin-left:10px;
    margin-right:10px; */

    left: 45px;
right: 35px;
  }
  .resumen th{
    font-size: 11px;
  }
  .resumen td{
    font-size: 10px;
    text-align: justify;
  }

  .encabezado{
    font-size: 13px; 
  }
  P{
    font-size: 10px;  
    margin-left: 10px; 
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
   margin-bottom:50px;
   margin-left:10px;
   }

   .imagenright {
   text-align: right;
   justify-content: right;
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
    text-align: right;
    justify-content: right; 
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
                          <img src="{{ asset('images/logo.png') }}" width= "140" height= "55">
                          </th>
                          <th class="text-center">
                             <h2 class="titulo2" >REPÚBLICA BOLIVARIANA DE VENEZUELA PROANZOATEGUI<h2>
                              <h2 class="titulo2" > G-20016716-5 <h2>
                             <h3 class="subtitulo">RESUMEN PRESUPUESTARIO Y FINANCIERO</h3> 
                          </th>
                          <th scope="col">
                            <table class="table-sm resumen1">
                             
                                <tr>

                                  <th> 
                                  <div style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  @php
                                  $ruta ='http://siproapp.ideasrenovacion.com/home/pdf';

                                  @endphp
                                  <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->generate($ruta)) }}" width= "70" height= "70">
                                  </div>
                                  </th>
                                </tr>
                             
                              
                              </table>
                          </th>
                        </tr>
                    
                    
                </table>
               
           </header>

  <!-- DATOS DEL MAIN O CONTENIDO -->
  <main>

  <table class="table table-bordered table-sm resumen1">
      
        
          
            
        <tbody>
        <tr>
             <th class="text-center">TOTAL INICIAL</th>
             <th class="text-center">TOTAL MODIFICADO</th>
             <th class="text-center">TOTAL AJUSTADO</th>
             <th class="text-center">TOTAL FINANCIERA</th>
         </tr>
          <tr>
            <td class="text-center">{{ $datos['total_presupuestario'] }}</td>
            <td class="text-center">{{ $datos['total_modificacion'] }}</td>
            <td class="text-center">{{ $datos['total_ajustado'] }}</td>
            <td class="text-center">{{ $datos['total_financiera'] }}</td>
          </tr>

          <tr>
             <th class="text-center">COMPROMETIDO</th>
             <th class="text-center">CAUSADO</th>
             <th class="text-center">PAGADO</th>
             <th class="text-center">DISPONIBILIDAD PRESUPUESTARIA</th>
         </tr>
         <tr>
             <td class="text-center">{{ $datos['total_comprometido'] }}<br><strong>{{ $datos['porc_comprometido'] }}%</strong></td>
             <td class="text-center">{{ $datos['total_causado'] }}<br><strong>{{ $datos['porc_causado'] }}%</strong></td>
            <td class="text-center">{{ $datos['total_pagado'] }}<br><strong>{{ $datos['porc_pagado'] }}%</strong></td>
            <td class="text-center">{{ $datos['total_disponible'] }}<br><strong>{{ $datos['porc_disponible'] }}%</strong></td>
          </tr>
          <tr>
             <th class="text-center" colspan="2">Comprometido vs Causado vs Pagado</th>
             <th class="text-center" colspan="2">Compromiso \ Causado  \ Pagado \ Disponible</th>
         </tr>
           <tr>
             <td class="text-center" colspan="2">
              <img src="https://quickchart.io/chart?c={type:'pie',data:{
                labels:['Comprometido','Causado','Pagado','Disponible'],
                datasets:[{data:[{{ $datos['comprometido'] }}, {{ $datos['causado'] }}, 
                {{ $datos['pagado'] }}, {{  $datos['disponible'] }} ]}]}}" width="350" height="260">
             </td>

             <td class="text-center" colspan="2">
            

              <img src="https://quickchart.io/chart?c={
  type: 'line',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [
      {
        label: 'Compromiso Bs',
        data: [{{  $datos['cadena_compromiso'] }}],
        fill: false,
        borderColor: 'green',
      },
      {
        label: 'Causado Bs',
        data: [{{ $datos['cadena_causado'] }} ],
        fill: false,
        borderColor: 'yellow',
      },
      {
        label: 'Pagado Bs',
        data: [{{ $datos['cadena_pagado'] }} ],
        fill: false,
        borderColor: 'blue',
      },
      {
        label: 'Disponible Bs',
        data: [{{ $datos['cadena_disponible'] }} ],
        fill: false,
        borderColor: 'red',
      },
    ],
  },
}" width="350" height="260">

  

             </td>
           </tr>

         <tr>
             <th class="text-center" colspan="2">TOP 10 - BOS</th>
             <th class="text-center" colspan="2">TOP 10 - Bancos</th>
         </tr>
         <tr>
             <td class="text-center" colspan="2">
         

              @php
              $etiquetas = str_replace(",","','", $datos['nombres_bos'] );
              @endphp

              <img src="https://quickchart.io/chart?c={
  type: 'pie',
  data: {
    labels: ['{{ $etiquetas }}'],
    datasets: [{ data: [{{ $datos['cantidades_bos'] }}] }],
  },
}" width="350" height="260">

              

             </td>
             <td class="text-center" colspan="2">
             
               @php
              $etiquetas_banco = str_replace(",","','", $datos['nombres_bancos'] );
              @endphp

              <img src="https://quickchart.io/chart?c={
  type: 'pie',
  data: {
    labels: ['{{ $etiquetas_banco }}'],
    datasets: [{ data: [{{ $datos['saldos'] }}] }],
  },
}" width="350" height="260">
             </td>
           </tr>

         <tr>
             <th class="text-center" colspan="2">Ingresos vs Egresos Bancarios</th>
             <th class="text-center" colspan="2">Transacciones Financieras</th>
         </tr>
         <tr>
             <td class="text-center" colspan="2">
           
           <img src="https://quickchart.io/chart?c={
  type: 'bar',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [
      { label: 'Ingresos Bs', data: [{{ $datos['ingresos_financiero_anual'] }}] },
      { label: 'Egresos Bs', data: [{{ $datos['egresos_financiero_anual'] }}] },
    ],
  },
}" width="350" height="260">

             </td>


             <td class="text-center" colspan="2">
         
           <img src="https://quickchart.io/chart?c={
  type: 'line',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [
      {
        label: 'Ingresos Bs',
        data: [{{ $datos['ingresos_financiero_anual'] }}],
        fill: false,
        borderColor: 'blue',
      },
      {
        label: 'Egresos Bs',
        data: [{{ $datos['egresos_financiero_anual'] }}],
        fill: false,
        borderColor: 'red',
      },
    ],
  },
}" width="350" height="260">

           

             </td>
           </tr>

       </tbody>
        
      
      </table>
  
 </main>

 <footer>
          
              <div class="pie text-roght justify-right">Resumen elaborado por SIPROAPP</div>
</footer>


                                    
						                                
</body>
</html>