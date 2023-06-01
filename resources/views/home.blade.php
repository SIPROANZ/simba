@extends('adminlte::page', ['iFrameEnabled' => false])


@section('title', 'Escritorio')

@section('content_header')
    <h1>Panel Estadisticos </h1>
@stop

@section('content')
<!-- Cajas estadisticas de la ejecucion presupuestaria -->
<!-- Total Presupuestario -->
<br>
<div class="container-fluid">
        <div class="row">
        <div class="col-sm-3">
<div class="info-box">
  <span class="info-box-icon bg-info"><i class="fas fa-money-bill-alt"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Inicial</span>
    <span class="info-box-number">{{ $datos['total_presupuestario'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: 100%"></div>
    </div>
    <span class="progress-description">
    </span>
  </div>
  </div>
  </div>

  <div class="col-sm-3">
<div class="info-box">
  <span class="info-box-icon bg-info"><i class="fas fa-money-bill-alt"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Modificado</span>
    <span class="info-box-number">{{ $datos['total_modificacion'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: 100%"></div>
    </div>
    <span class="progress-description">
    </span>
  </div>
  </div>
  </div>

  <div class="col-sm-3">
<div class="info-box">
  <span class="info-box-icon bg-warning"><i class="fas fa-money-bill-alt"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Ajustado</span>
    <span class="info-box-number">{{ $datos['total_ajustado'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-info" style="width: 100%"></div>
    </div>
    <span class="progress-description">
    </span>
  </div>
  </div>
  </div>

  <div class="col-sm-3">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Financiera</span>
        <span class="info-box-number">{{ $datos['total_financiera'] }}</span>
        <div class="progress">
          <div class="progress-bar bg-success" style="width: 100%"></div>
        </div>
        <span class="progress-description">
        </span>
      </div>
      </div>
      </div>


</div>
</div>

<div class="row">
            <div class="col-sm-3">
            <div class="info-box bg-success">
  <span class="info-box-icon"><i class="far fa-handshake"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Comprometido</span>
    <span class="info-box-number">{{ $datos['total_comprometido'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-dark" style="width: {{$datos['tpcomprometido']}}%"></div>
    </div>
    <span class="progress-description">
    {{ $datos['porc_comprometido'] }}% Comprometido
    </span>
  </div>
</div>
            </div>  

            <div class="col-sm-3">
            <div class="info-box bg-gradient-warning">
  <span class="info-box-icon"><i class="	fas fa-calendar-check"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Causado</span>
    <span class="info-box-number">{{ $datos['total_causado'] }}</span>
    <div class="progress">
      <div class="progress-bar bg-dark" style="width: {{$datos['tpcausado']}}%"></div>
    </div>
    <span class="progress-description">
    {{ $datos['porc_causado'] }}% Causado
    </span>
  </div>
</div>
            </div>  

            <div class="col-sm-3">
            <div class="info-box bg-gradient-info">
                  <span class="info-box-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Pagado</span>
                    <span class="info-box-number">{{ $datos['total_pagado'] }}</span>
                    <div class="progress">
                      <div class="progress-bar bg-dark" style="width: {{$datos['tppagado']}}%"></div>
                    </div>
                    <span class="progress-description">
                    {{ $datos['porc_pagado'] }}% Pagado
                    </span>
              </div>
            </div>
          </div>  

          <!-- Para colocar pagado -->
          <div class="col-sm-3">
            <div class="info-box bg-gradient-danger">
                  <span class="info-box-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Disponibilidad</span>
                    <span class="info-box-number">{{ $datos['total_disponible'] }}</span>
                    <div class="progress">
                      <div class="progress-bar bg-dark" style="width: {{$datos['tpdisponible']}}%"></div>
                    </div>
                    <span class="progress-description">
                    {{ $datos['porc_disponible'] }}% Disponibilidad
                    </span>
              </div>
            </div>
          </div>  



</div>


<!-- Inicio de Graficas -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Comprometido vs Causado vs Pagado
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
          <!-- Cadena para guardar los valores en el html que luego leera el script -->
          <input type="hidden" id="ingresos_egresos" value="<?PHP echo "" . $datos['comprometido'] . "," . $datos['causado'] . "," .$datos['pagado']. "," .$datos['disponible']; ?>">
         
          <!-- Inicio Otro Pie Ingresos Vs Egresos -->
          <div class="chart">
            <canvas id="myChartPie" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- Fin de Otro Pie  Ingresos vs Egresos --> 
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Top 10 - BOS</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
         

          <!-- Cadena para guardar los valores en el html que luego leera el script -->
          <input type="hidden" id="etiquetas_corporaciones" value="<?PHP echo $datos['nombres_bos']; ?>">
         
          <input type="hidden" id="ingresos_corporaciones" value="<?PHP echo $datos['cantidades_bos']; ?>">
         
          <!-- Inicio Otro Pie Ingresos Vs Egresos -->
          <div class="chart">
            <canvas id="myChartIngresoCorporacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- Fin de Otro Pie  Ingresos vs Egresos --> 
          

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- PIE CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Ingresos vs Egresos Bancarios</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">


            <!-- Inicio Ingreso y Egreso x Corporacion -->

            <input type="hidden" id="ingresos_corporacion" value="<?PHP echo $datos['ingresos_financiero_anual']; ?>">
            <input type="hidden" id="egresos_corporacion" value="<?PHP echo $datos['egresos_financiero_anual']; ?>">
            <input type="hidden" id="etiquetas_meses" value="<?PHP echo "Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre"; ?>">
            <!-- Inicio Otro Pie Ingresos Vs Egresos -->
            <div class="chart">
              <canvas id="myChartCorporacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>

            <!-- Fin de Ingreso y Egreso Corporacion -->
          
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="card card-info ">
          <div class="card-header">
          <h3 class="card-title">Compromiso \ Causado  \ Pagado \ Disponible</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
              <!-- Cadena para guardar los valores en el html que luego leera el script -->
          <input type="hidden" id="ingresos_anual" value="<?PHP echo "" . $datos['cadena_compromiso']; ?>">
          <input type="hidden" id="egresos_anual" value="<?PHP echo "" . $datos['cadena_causado']; ?>">
          <input type="hidden" id="pagado_anual" value="<?PHP echo "" . $datos['cadena_pagado']; ?>">
          <input type="hidden" id="cadena_disponible" value="<?PHP echo "" . $datos['cadena_disponible']; ?>">
          <!-- Inicio Otro Pie Ingresos Vs Egresos -->
          <div class="chart">
            <canvas id="myChartLine" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- Fin de Otro Pie  Ingresos vs Egresos --> 
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Top 10 - Bancos</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            
         <input type="hidden" id="etiquetas_bancos" value="<?PHP  echo "" . $datos['nombres_bancos']; ?>">
         
          <input type="hidden" id="egresos_corporaciones" value="<?PHP echo $datos['saldos']; ?>">
         
          
          <div class="chart">
            <canvas id="myChartEgresoCorporacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- STACKED BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Transacciones Financieras</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
           <!-- Ingreso Proyectos Anual -->
               <!-- Cadena para guardar los valores en el html que luego leera el script -->
          <input type="hidden" id="costos_ingresos" value="<?PHP echo $datos['ingresos_financiero_anual']; ?>">
          <input type="hidden" id="costos_egresos" value="<?PHP echo $datos['egresos_financiero_anual']; ?>">
          <input type="hidden" id="etiquetas_years" value="<?PHP echo "Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre"; ?>">
          
          <!-- Inicio Otro Pie Ingresos Vs Egresos -->
          <div class="chart">
            <canvas id="myHistoricoProyectos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>


          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- Fin de Graficas -->



      

      
      

    
@stop

 @section('css')

 <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">

@stop
    
    
@section('js')

<script src="{{ asset('js/submit.js') }}"></script>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- FLOT CHARTS -->
<script src="{{ asset('plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('plugins/flot/plugins/jquery.flot.pie.js')}}"></script>

<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>


<script src="{{-- asset('dist/js/demo.js') --}}"></script>

<script src="{{-- asset('dist/js/pages/dashboard2.js') --}}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Inicio de Codigo Script -->
<script>
  const ctx = document.getElementById('myChartPie');

  //Cadena con los valores obtenidos del html
  var ingresos_egresos = document.getElementById("ingresos_egresos").value;
      var arrayingresos_egresos =  ingresos_egresos.split(",");

  new Chart(ctx, {
    type: 'pie',
  data: {
  labels: ['Comprometido', 'Causado', 'Pagado','Disponible'],
  datasets: [
    {
      label: 'Total Bs',
      data: arrayingresos_egresos,
      backgroundColor: [
                "#16B94A",
                "#FBB609",
                "#20A9C9",
                "#DF3030",
            ]
     // backgroundColor: Object.values(Utils.CHART_COLORS),
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Ejecucion presupuestaria'
      }
    }
  }
  });
</script>

<!-- Fin de escrip para ingresos y egresos un PIE -->

<!-- Inicio de Grafica Lineal -->
<script>
  const ctx_line = document.getElementById('myChartLine');

  var ingresos = document.getElementById("ingresos_anual").value;
      var arrayingresos =  ingresos.split(",");

      var egresos = document.getElementById("egresos_anual").value;
      var arrayegresos =  egresos.split(",");

      var pagado = document.getElementById("pagado_anual").value;
      var arraypagado =  pagado.split(",");

      var disponible = document.getElementById("cadena_disponible").value;
      var arraydisponible =  disponible.split(",");

  new Chart(ctx_line, {
    type: 'line',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'Compromisos Bs',
        data: arrayingresos,
        backgroundColor: [
                "#16B94A",
            ],
            borderColor: "#16B94A",
        borderWidth: 1
      },
      {
        label: 'Causado Bs',
        data: arrayegresos,
        backgroundColor: [
                "#FBB609",
            ],
            borderColor: "#FBB609",
        borderWidth: 1
      },
      {
        label: 'Pagado Bs',
        data: arraypagado,
        backgroundColor: [
                "#20A9C9",
            ],
            borderColor: "#20A9C9",
        borderWidth: 1
      },
      {
        label: 'Disponible Bs',
        data: arraydisponible,
        backgroundColor: [
                "#DF3030",
            ],
            borderColor: "#DF3030", 
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- Fin de Grafica Inicial -->



<script>
  $(function () {
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data        = [],
        totalPoints = 100

    function getRandomData() {

      if (data.length > 0) {
        data = data.slice(1)
      }

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }

      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    }

    var interactive_plot = $.plot('#interactive', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

      interactive_plot.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
      interactive_plot.draw()
      if (realtime === 'on') {
        setTimeout(update, updateInterval)
      }
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
      update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtime = 'on'
      }
      else {
        realtime = 'off'
      }
      update()
    })
    /*
     * END INTERACTIVE CHART
     */


    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [],
        cos = []
    for (var i = 0; i < 14; i += 0.5) {
      sin.push([i, Math.sin(i)])
      cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */

    /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
      [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
      [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
    $.plot('#area-chart', [areaData], {
      grid  : {
        borderWidth: 0
      },
      series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#00c0ef',
        lines : {
          fill: true //Converts the line chart to area chart
        },
      },
      yaxis : {
        show: false
      },
      xaxis : {
        show: false
      }
    })

    /* END AREA CHART */

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [[1,'January'], [2,'February'], [3,'March'], [4,'April'], [5,'May'], [6,'June']]
      }
    })
    /* END BAR CHART */

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      {
        label: 'Series2',
        data : 30,
        color: '#3c8dbc'
      },
      {
        label: 'Series3',
        data : 20,
        color: '#0073b7'
      },
      {
        label: 'Series4',
        data : 50,
        color: '#00c0ef'
      }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>

<!-- Ingresos corporaciones pie -->
<script>
  const ctx_corp = document.getElementById('myChartIngresoCorporacion');

  //Cadena con los valores obtenidos del html
      var ingresos_cad = document.getElementById("ingresos_corporaciones").value;
      var arrayingresos_cad =  ingresos_cad.split(",");
      var etiquetas_corpo = document.getElementById("etiquetas_corporaciones").value;
      var array_etiquetas =  etiquetas_corpo.split(",");

  new Chart(ctx_corp, {
    type: 'pie',
  data: {
  labels: array_etiquetas,
  datasets: [
    {
      label: 'Total',
      data:  arrayingresos_cad, // [12,25,14,3],
     // backgroundColor: Object.values(Utils.CHART_COLORS),
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      
    }
  }
  });
</script>
<!-- Fin Pie Ingresos Corporaciones -->


<!-- Egreso por corporaciones -->
<script>
  const ctx_corp_egre = document.getElementById('myChartEgresoCorporacion');

  //Cadena con los valores obtenidos del html
  var egresos_cad = document.getElementById("egresos_corporaciones").value;
      var arrayegresos_cad =  egresos_cad.split(",");
      var etiquetas_corpo = document.getElementById("etiquetas_bancos").value;
      var array_etiquetas =  etiquetas_corpo.split(",");

  new Chart(ctx_corp_egre, {
    type: 'pie',
  data: {
  labels: array_etiquetas,
  datasets: [
    {
      label: 'Total Bs',
      data:  arrayegresos_cad, // [12,25,14,3],
     // backgroundColor: Object.values(Utils.CHART_COLORS),
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      
    }
  }
  });
</script>
<!-- Fin de egreso por corporaciones  -->

<!-- Ingreso vs Egresos anuales por proyecto corporaciones -->
<script>
  const ctx_corporacion = document.getElementById('myChartCorporacion');

      var ingres = document.getElementById("ingresos_corporacion").value;
      var arrayingre =  ingres.split(",");

      var egres = document.getElementById("egresos_corporacion").value;
      var arrayegre =  egres.split(",");

      var etiquetas_corpo = document.getElementById("etiquetas_meses").value;
      var array_etiquetas =  etiquetas_corpo.split(",");

  new Chart(ctx_corporacion, {
    type: 'bar',
    data: {
      labels: array_etiquetas,
      datasets: [{
        label: 'Ingresos Bs',
        data: arrayingre,
        borderWidth: 1
      },
      {
        label: 'Egresos Bs',
        data: arrayegre,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- Fin de Ingreso vs egresos anuales por proyecto corporaciones -->
 

<!-- Proyectos estimados anuales un total de doce -->
<!-- Inicio de Grafica Lineal -->
<script>
  const ctx_proyecto_anual = document.getElementById('myHistoricoProyectos');

  var ingresos = document.getElementById("costos_ingresos").value;
      var arrayingresos =  ingresos.split(",");

      var egresos = document.getElementById("costos_egresos").value;
      var arrayegresos =  egresos.split(",");

      var years_etq = document.getElementById("etiquetas_years").value;
      var array_years_etq =  years_etq.split(",");

  new Chart(ctx_proyecto_anual, {
    type: 'line',
    data: {
      labels: array_years_etq,
      datasets: [{
        label: 'Ingresos Bs',
        data: arrayingresos,
        borderWidth: 1
      },
      {
        label: 'Egresos Bs',
        data: arrayegresos,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- Fin de Grafica Inicial -->
<!-- Fin de Codigo Script -->



@stop
