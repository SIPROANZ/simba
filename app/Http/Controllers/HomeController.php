<?php

namespace App\Http\Controllers;
use App\Ejecucione;
use App\Compromiso;
use App\Detallesrequisicione;
use App\Ordenpago;
use App\Pagado;
use App\Banco;
use App\Cuentasbancaria;
use App\Bo;
use App\Transferencia;
use App\Notasdecredito;
use App\Notasdedebito;
use App\Configuracione;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //Obtener la institucion pre establecida en la configuracion y el ejercicio pre establecido
        $config = Configuracione::where('nombre','institucion')->first();
        $institucion = $config->valor;
        $config = Configuracione::where('nombre','ejercicio')->first();
        $ejercicio = $config->valor;

        $total_financiera = DB::table('cuentasbancarias')->sum('montosaldo');
        $total_presupuestario = DB::table('ejecuciones')->where('institucion_id', $institucion)->where('ejercicio_id', $ejercicio)->sum('monto_inicial');
        $total_ajustado = DB::table('ejecuciones')->where('institucion_id', $institucion)->where('ejercicio_id', $ejercicio)->sum('monto_actualizado');
        $total_modificacion = $total_ajustado - $total_presupuestario;
        $total_comprometido = DB::table('ejecuciones')->where('institucion_id', $institucion)->where('ejercicio_id', $ejercicio)->sum('monto_comprometido');
        $total_causado = DB::table('ejecuciones')->where('institucion_id', $institucion)->where('ejercicio_id', $ejercicio)->sum('monto_causado');
        $total_pagado = DB::table('ejecuciones')->where('institucion_id', $institucion)->where('ejercicio_id', $ejercicio)->sum('monto_pagado');
        $total_disponible = $total_presupuestario - $total_comprometido;
        $porc_comprometido = ( $total_comprometido * 100 ) / $total_presupuestario;
        $porc_causado = ( $total_causado * 100 ) / $total_presupuestario;
        $porc_pagado = ( $total_pagado * 100 ) / $total_presupuestario;
        $porc_disponible = ( $total_disponible * 100 ) / $total_presupuestario;

        $tpcomprometido = $porc_comprometido;
        $tpcausado = $porc_causado;
        $tppagado = $porc_pagado;
        $tpdisponible = $porc_disponible;

        $total_presupuestario = number_format($total_presupuestario, 2, ",", ".");
        $comprometido = $total_comprometido;
        $causado = $total_causado;
        $pagado = $total_pagado;
        $total_comprometido = number_format($total_comprometido, 2, ",", ".");
        $total_causado = number_format($total_causado, 2, ",", ".");
        $total_pagado = number_format($total_pagado, 2, ",", ".");
        $total_disponible = number_format($total_disponible, 2, ",", ".");
        $porc_comprometido = number_format($porc_comprometido, 2, ",", ".");
        $porc_causado = number_format($porc_causado, 2, ",", ".");
        $porc_pagado = number_format($porc_pagado, 2, ",", ".");
        $porc_disponible = number_format($porc_disponible, 2, ",", ".");

        $total_ajustado = number_format($total_ajustado, 2, ",", ".");
        $total_modificacion = number_format($total_modificacion, 2, ",", ".");

        $total_financiera = number_format($total_financiera, 2, ",", ".");

        $cadena_compromiso = $this->get_cad_compromiso_anual();

        $cadena_causado = $this->get_cad_causado_anual();

        $cadena_pagado = $this->get_cad_pagado_anual();

        $ingresos_financiero_anual = $this->get_cad_ingresos_anual();

        $egresos_financiero_anual = $this->get_cad_egresos_anual();

        $bos = $this->get_cad_bos_anual();

        $nombres_bos = $bos['nombres'];
        $cantidades_bos = $bos['cantidades'];

        $bancos = $this->get_cad_bancos_anual();
        $nombres_bancos = $bancos['nombres'];
        $saldos = $bancos['saldos']; 

        $datos = [
            'total_presupuestario'=>$total_presupuestario,
            'total_comprometido'=>$total_comprometido,
            'total_causado'=>$total_causado,
            'total_pagado'=>$total_pagado,
            'total_disponible'=>$total_disponible,
            'porc_comprometido'=>$porc_comprometido,
            'porc_causado'=>$porc_causado,
            'porc_pagado'=>$porc_pagado,
            'porc_disponible'=>$porc_disponible,
            'tpcomprometido'=>$tpcomprometido,
            'tpcausado'=>$tpcausado,
            'tppagado'=>$tppagado,
            'tpdisponible'=>$tpdisponible,
            'total_ajustado'=>$total_ajustado,
            'total_modificacion'=>$total_modificacion,
            'total_financiera'=> $total_financiera,
            'comprometido'=> $comprometido,
            'causado'=> $causado,
            'pagado'=> $pagado,
            'cadena_compromiso' => $cadena_compromiso,
            'cadena_causado' => $cadena_causado,
            'cadena_pagado' => $cadena_pagado,
            'ingresos_financiero_anual' => $ingresos_financiero_anual,
            'egresos_financiero_anual' => $egresos_financiero_anual,
            'nombres_bos' => $nombres_bos,
            'cantidades_bos' => $cantidades_bos,
            'nombres_bancos' => $nombres_bancos,
            'saldos' => $saldos
        ];





        return view('home', compact('datos'));
            //->with('i', (request()->input('page', 1) - 1) * $ejecuciones->perPage());
        //return view('home');
    }

/**
 * Codigo para obtener el monto total de todos los compromisos anuales por mes en un periodo fiscal de enero a febrero
 */
private function get_cad_compromiso_anual(){
    $cad_rs = '';
    $fecha = Carbon::now();
    //$year = $fecha->year;

    $config = Configuracione::where('nombre','year')->first();
    $year = $config->valor;
    //01
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '01')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //02
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '02')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //03
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '03')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //04
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '04')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //05
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '05')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //06
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '06')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //07
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '07')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //08
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '08')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //09
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '09')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //10
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '10')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //11
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '11')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 
    //12
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '12')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $cad_rs .= $egreso_estimado . ", "; 

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    return $cad_rs;


}

/**
 * Codigo para obtener el monto total de todos los causados anuales por mes en un periodo fiscal de enero a febrero
 */
private function get_cad_causado_anual(){
    $cad_rs = '';
    $fecha = Carbon::now();
    //$year = $fecha->year;
    $config = Configuracione::where('nombre','year')->first();
    $year = $config->valor;
    //01
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '01')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //02
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '02')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //03
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '03')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //04
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '04')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //05
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '05')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //06
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '06')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //07
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '07')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //08
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '08')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //09
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '09')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //10
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '10')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //11
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '11')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 
    //12
    $proyectos_ingresos = Ordenpago::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '12')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montobase') + $proyectos_ingresos->sum('montoiva');
    $cad_rs .= $egreso_estimado . ", "; 

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    return $cad_rs;


}

private function get_cad_pagado_anual(){
    $cad_rs = '';
    $fecha = Carbon::now();
    //$year = $fecha->year;
    $config = Configuracione::where('nombre','year')->first();
    $year = $config->valor;
    //01
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '01')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //02
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '02')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //03
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '03')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //04
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '04')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //05
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '05')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //06
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '06')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //07
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '07')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //08
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '08')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //09
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '09')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //10
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '10')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //11
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '11')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 
    //12
    $proyectos_ingresos = Pagado::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '12')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montopagado');
    $cad_rs .= $egreso_estimado . ", "; 

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    return $cad_rs;

}
/**
 * Obtener en el a;o como han sido los ingresos a los bancos por mes
 */
private function get_cad_ingresos_anual(){
    $cad_rs = '';
    $fecha = Carbon::now();
    //$year = $fecha->year;
    $config = Configuracione::where('nombre','year')->first();
    $year = $config->valor;
    //01
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '01')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //02
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '02')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //03
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '03')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //04
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '04')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //05
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '05')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //06
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '06')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //07
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '07')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //08
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '08')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //09
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '09')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //10
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '10')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //11
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '11')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 
    //12
    $proyectos_ingresos = Notasdecredito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '12')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    $cad_rs .= $egreso_estimado . ", "; 

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    return $cad_rs;

}

/**
 * Obtener por mes los egresos de los bancos, en el periodo del a;o actual
 */
private function get_cad_egresos_anual(){
    $cad_rs = '';
    $fecha = Carbon::now();
    //$year = $fecha->year;
    $config = Configuracione::where('nombre','year')->first();
    $year = $config->valor;
    //01
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '01')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '01')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 

    //02
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '02')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
   //$cad_rs .= $egreso_estimado . ", "; 

   $transferencia_egreso = Transferencia::query()
   ->where('id', '>', 0)->whereMonth('created_at', '02')
   ->whereYear('created_at', $year)->get();
   $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
    
   $total =  $egreso_estimado + $egreso_por_transferencia;

   $cad_rs .= $total . ", "; 
    //03
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '03')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '03')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //04
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '04')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '04')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //05
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '05')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '05')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //06
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '06')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '06')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //07
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '07')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '07')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //08
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '08')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '08')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", ";  
    //09
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '09')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '09')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //10
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '10')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '10')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //11
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '11')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
    //$cad_rs .= $egreso_estimado . ", "; 

    $transferencia_egreso = Transferencia::query()
    ->where('id', '>', 0)->whereMonth('created_at', '11')
    ->whereYear('created_at', $year)->get();
    $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
     
    $total =  $egreso_estimado + $egreso_por_transferencia;

    $cad_rs .= $total . ", "; 
    //12
    $proyectos_ingresos = Notasdedebito::query()
    ->where('id', '>', 0)->whereMonth('fecha', '12')
    ->whereYear('fecha', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('monto');
   //$cad_rs .= $egreso_estimado . ", "; 

   $transferencia_egreso = Transferencia::query()
   ->where('id', '>', 0)->whereMonth('created_at', '12')
   ->whereYear('created_at', $year)->get();
   $egreso_por_transferencia = $transferencia_egreso->sum('montotransferencia');
    
   $total =  $egreso_estimado + $egreso_por_transferencia;

   $cad_rs .= $total . ", "; 

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    return $cad_rs;

}


/**
 * Obtener en el a;o como han sido los ingresos a los bancos por mes
 */
private function get_cad_bos_anual(){
    $cad_rs = '';
    $cad_bos = '';
    $cad_cantidad = '';
   // $fecha = Carbon::now();
   // $year = $fecha->year;

    $config = Configuracione::where('nombre','year')->first();
    $year = $config->valor;
    

    $top_bos = Detallesrequisicione::whereYear('created_at', $year)->orderBy('cantidad', "DESC")->limit(10)->get();

    foreach ($top_bos as $value) {

        $validacion_repetidos = strpos($cad_bos,$value->bos_id);
        if($validacion_repetidos === false){
        $cad_bos .= $value->bos_id . ',';
        # code...
        //Obtener el nombre del ID
        $nombre = Bo::find($value->bos_id);
        $nombre_bos = substr($nombre->descripcion,0,20);
        $cad_rs .=  $nombre_bos . ','; 

        //Obtener las cantidades dependiendo si tienen mas cantidades solicitadas en las requisiciones
        $cantidad_bos = Detallesrequisicione::where('bos_id', $value->bos_id)->whereYear('created_at', $year)->get();
        $rs_cantidad = $cantidad_bos->sum('cantidad');
        $cad_cantidad .= $rs_cantidad . ',';
        }

    }

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    $cad_cantidad = substr($cad_cantidad, 0, (strlen($cad_cantidad) - 1));

    $datos =[
        'nombres' => $cad_rs,
        'cantidades' => $cad_cantidad
        
    ];

    return $datos;

}

/**
 * Top 10 de los bancos donde hay efectivo
 */
private function get_cad_bancos_anual(){
    $cad_rs = '';
    $cad_cantidad = '';
   
    $top_banco = Cuentasbancaria::where('montosaldo','>', 0)->orderBy('montosaldo', "DESC")->limit(10)->get();

    foreach ($top_banco as $value) {

        //Obtener el Nombre del Banco
        $banco = Banco::find($value->banco_id);
        $nombre_banco = substr($banco->denominacion,0,13);
        $cad_rs .= $nombre_banco . '-' . substr($value->cuenta,(strlen($value->cuenta) - 4),4) . ',';
        $cad_cantidad .= $value->montosaldo . ',';

    }

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));

    $cad_cantidad = substr($cad_cantidad, 0, (strlen($cad_cantidad) - 1));

    $datos =[
        'nombres' => $cad_rs,
        'saldos' => $cad_cantidad
    ];

    return $datos;

}



}
