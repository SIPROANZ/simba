<?php

namespace App\Http\Controllers;
use App\Ejecucione;
use App\Compromiso;
use App\Beneficiario;
use App\Requisicione;
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
use App\Retencione;
use App\Ayudassociale;

use App\Analisi;
use App\Compra;

use App\Models\User;
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
       
        // $total_disponible = $total_presupuestario - $total_comprometido;
       $total_disponible = $total_ajustado - $total_comprometido;
        
       /* if($total_presupuestario != 0){
            $porc_comprometido = ( $total_comprometido * 100 ) / $total_presupuestario;
            $porc_causado = ( $total_causado * 100 ) / $total_presupuestario;
            $porc_pagado = ( $total_pagado * 100 ) / $total_presupuestario;
            $porc_disponible = ( $total_disponible * 100 ) / $total_presupuestario;
        }else{
            $porc_comprometido = 0;
            $porc_causado = 0;
            $porc_pagado = 0;
            $porc_disponible = 0;
        }*/
        if($total_presupuestario != 0){
        $porc_comprometido = ( $total_comprometido * 100 ) / $total_ajustado;
        $porc_causado = ( $total_causado * 100 ) / $total_ajustado;
        $porc_pagado = ( $total_pagado * 100 ) / $total_ajustado;
        $porc_disponible = ( $total_disponible * 100 ) / $total_ajustado;
    }else{
        $porc_comprometido = 0;
        $porc_causado = 0;
        $porc_pagado = 0;
        $porc_disponible = 0;
    }


     

        $tpcomprometido = $porc_comprometido;
        $tpcausado = $porc_causado;
        $tppagado = $porc_pagado;
        $tpdisponible = $porc_disponible;

        $total_presupuestario = number_format($total_presupuestario, 2, ",", ".");
        $comprometido = $total_comprometido;
        $causado = $total_causado;
        $pagado = $total_pagado;
        $disponible = $total_disponible;
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

        $result_compromiso = $this->get_cad_compromiso_anual();

        $cadena_compromiso = $result_compromiso['cad_rs'];
        $cadena_disponible = $result_compromiso['cadena_disponible'];
        
       // $cadena_compromiso = $this->get_cad_compromiso_anual();

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
            'disponible'=> $disponible,
            'cadena_compromiso' => $cadena_compromiso,
            'cadena_causado' => $cadena_causado,
            'cadena_pagado' => $cadena_pagado,
            'cadena_disponible' => $cadena_disponible,
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

    $config = Configuracione::where('nombre','institucion')->first();
    $institucion = $config->valor;
    $config = Configuracione::where('nombre','ejercicio')->first();
    $ejercicio = $config->valor;

    $total_ajustado = DB::table('ejecuciones')->where('institucion_id', $institucion)->where('ejercicio_id', $ejercicio)->sum('monto_actualizado');
     
    $cadena_disponible = '';


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
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", "; 
    $cad_rs .= $egreso_estimado . ", "; 

    //02
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '02')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //03
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '03')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //04
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '04')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //05
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '05')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //06
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '06')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //07
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '07')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //08
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '08')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //09
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '09')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //10
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '10')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //11
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '11')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 
    //12
    $proyectos_ingresos = Compromiso::query()
    ->where('id', '>', 0)->whereMonth('updated_at', '12')
    ->whereYear('updated_at', $year)->get();
    $egreso_estimado = $proyectos_ingresos->sum('montocompromiso');
    $total_ajustado -= $egreso_estimado;
    $cadena_disponible .= $total_ajustado . ", ";
    $cad_rs .= $egreso_estimado . ", "; 

    $cad_rs = substr($cad_rs, 0, (strlen($cad_rs) - 1));
    $cadena_disponible = substr($cadena_disponible, 0, (strlen($cadena_disponible) - 1));

    $datos = [
        'cad_rs' => $cad_rs,
        'cadena_disponible' => $cadena_disponible,
    ];
    return $datos;


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


public function rutas($id)
{
    $ruta = explode('-',$id);
    $ruta_id = $ruta[1];
    $tipo = $ruta[0];

    //Area para el precompromiso (requisicion, ayuda y precompromiso)
    $estado ="";
    $correlativo=0;
    $nombre_tipo = "";
    $creado ="";
    $modificado="";
    $elaborado ="";
    $id = 0;
    $concepto = "";
    $beneficiario = "";
    $monto_total = "";

    //Compromiso
    $analisis = "";
    $ordenCompra = "";
    $correlativoCompra = "";
    $compromiso = "";

    $estado_compromiso = "";
    $correlativo_compromiso = "";
    $creado_compromiso = "";
    $modificado_compromiso = "";
    $elaborado_compromiso = "";
    $monto_compromiso = "";
    $beneficiario_compromiso = "";

    //causado
    $causado = "";

    $estado_causado = "";
    $correlativo_causado = "";
    $creado_causado = "";
    $modificado_causado = "";
    $elaborado_causado = "";
    $monto_causado = "";
    $beneficiario_causado = "";

    //PAGADO
    $pagado = "";

    $estado_pagado = "";
    $correlativo_pagado = "";
    $creado_pagado = "";
    $modificado_pagado = "";
    $elaborado_pagado = "";
    $monto_pagado = "";
    $monto_restante = "";
    $beneficiario_pagado = "";


    //Validar si es una requisicion
    if($tipo == "REQ"){
        $nombre_tipo = "Requisicion";
        //Obtener los datos de la requisicion
        $rs_requisicion = Requisicione::find($ruta_id );

        if($rs_requisicion){ 
        $id = $ruta_id;
        $estado = $rs_requisicion->estatus;
        if($estado== 'AP'){
            $estado ="APROBADO";
        }elseif ($estado== 'EP') {
            $estado ="EN PROCESO";
        }
        elseif ($estado== 'PR') {
            $estado ="PROCESADO";
        }elseif ($estado== 'AN') {
            $estado ="ANULADO";
        }

        $correlativo=$rs_requisicion->correlativo;


        $creado =$rs_requisicion->created_at;
        $modificado=$rs_requisicion->updated_at;

    $concepto = substr($rs_requisicion->concepto, 0, 300);



    $rs_user = User::find($rs_requisicion->usuario_id);
    if($rs_user){
        $elaborado =$rs_user->name;
    }
    
     //Obtener si existe un analisis que tenga relacionada este ID de la requisicion
     $rs_analisis = Analisi::where('requisicion_id', $id)->first();

     if($rs_analisis){
           $analisis = '<strong>ID ANALISIS: </strong>' . $rs_analisis->id;

            //Como si existe el analisis ahora hay que verificar que exista la orden de compra
            $rs_compra = Compra::where('analisis_id', $rs_analisis->id)->first();
            if($rs_compra){
                $ordenCompra = '<strong>ID COMPRAS: </strong>' . $rs_compra->id;
                $correlativoCompra = '<strong>NUMERO ORDEN COMPRA: </strong>' . $rs_compra->numordencompra;

                //Si existe la compra verificar que exista el compromiso
                $rs_compromiso = Compromiso::where('compra_id', $rs_compra->id)->first();
                if($rs_compromiso){
                    $compromiso = $rs_compromiso->id;

                    $estado_compromiso = $rs_compromiso->status;
                    if($estado_compromiso== 'AP'){
                        $estado_compromiso ="APROBADO";
                    }elseif ($estado_compromiso== 'EP') {
                        $estado_compromiso ="EN PROCESO";
                    }
                    elseif ($estado_compromiso== 'PR') {
                        $estado_compromiso ="PROCESADO";
                    }elseif ($estado_compromiso== 'AN') {
                        $estado_compromiso ="ANULADO";
                    }
                    $correlativo_compromiso = $rs_compromiso->ncompromiso;
                    $creado_compromiso = $rs_compromiso->created_at;
                    $modificado_compromiso = $rs_compromiso->updated_at;

                    $rs_user = User::find($rs_compromiso->usuario_id);
                    if($rs_user){
                        $elaborado_compromiso =$rs_user->name;
                    }

                    $rs_beneficiario = Beneficiario::find($rs_compromiso->beneficiario_id);
                        if($rs_beneficiario){
                            $beneficiario_compromiso =$rs_beneficiario->nombre;
                        }
                   
                    $monto_compromiso = number_format($rs_compromiso->montocompromiso, 2, ',', '.');

                    //si existe el compromiso verificar que exista el causado
                    $rs_causado = Ordenpago::where('compromiso_id', $rs_compromiso->id)->first();
                    if($rs_causado){
                        $causado = $rs_causado->id;

                        $estado_causado = $rs_causado->status;
                        if($estado_causado== 'AP'){
                            $estado_causado ="APROBADO";
                        }elseif ($estado_causado== 'EP') {
                            $estado_causado ="EN PROCESO";
                        }
                        elseif ($estado_causado== 'PR') {
                            $estado_causado ="PROCESADO";
                        }elseif ($estado_causado== 'AN') {
                            $estado_causado ="ANULADO";
                        }
                        $correlativo_causado = $rs_causado->nordenpago;
                        $creado_causado = $rs_causado->created_at;
                        $modificado_causado = $rs_causado->updated_at;
    
                        $rs_user = User::find($rs_causado->usuario_id);
                        if($rs_user){
                            $elaborado_causado =$rs_user->name;
                        }
                        $rs_beneficiario = Beneficiario::find($rs_causado->beneficiario_id);
                        if($rs_beneficiario){
                            $beneficiario_causado =$rs_beneficiario->nombre;
                        }

                        //PENDIENTE PARA VISUALIZAR ESTE MONTO QUE TIENE QUE SER EL MISMO QUE EL COMPROMISO
                        $monto_causado = number_format($rs_causado->montoneto, 2, ',', '.');

                        //Si existe el causado verificar que exista el pagado
                        $rs_pagado = Pagado::where('ordenpago_id',$rs_causado->id)->first();
                        if($rs_pagado){
                            $pagado = $rs_pagado->id;

                            $estado_pagado = $rs_pagado->status;
                        if($estado_pagado== 'AP'){
                            $estado_pagado ="APROBADO";
                        }elseif ($estado_pagado== 'EP') {
                            $estado_pagado ="EN PROCESO";
                        }
                        elseif ($estado_pagado== 'PR') {
                            $estado_pagado ="PROCESADO";
                        }elseif ($estado_pagado== 'AN') {
                            $estado_pagado ="ANULADO";
                        }
                        $correlativo_pagado = $rs_pagado->correlativo;
                        $creado_pagado = $rs_pagado->created_at;
                        $modificado_pagado = $rs_pagado->updated_at;
    
                        $rs_user = User::find($rs_pagado->usuario_id);
                        if($rs_user){
                            $elaborado_pagado =$rs_user->name;
                        }

                        $rs_beneficiario = Beneficiario::find($rs_pagado->beneficiario_id);
                        if($rs_beneficiario){
                            $beneficiario_pagado =$rs_beneficiario->nombre;
                        }
                       
                        $monto_pagado = number_format($rs_pagado->montopagado, 2, ',', '.');
                        $monto_restante = number_format(($rs_pagado->montoordenpago - $rs_pagado->montopagado), 2, ',', '.');



                        }
                    }

                }
            }


     }

     }

    }
    elseif($tipo == "AYU"){
        $nombre_tipo = "Ayuda Social";

        $rs_ayuda = Ayudassociale::find($ruta_id);
        if($rs_ayuda){

            $id = $ruta_id;
            $estado = $rs_ayuda->status;
            if($estado== 'AP'){
                $estado ="APROBADO";
            }elseif ($estado== 'EP') {
                $estado ="EN PROCESO";
            }
            elseif ($estado== 'PR') {
                $estado ="PROCESADO";
            }elseif ($estado== 'AN') {
                $estado ="ANULADO";
            }
    
            $correlativo=$rs_ayuda->id;
    
    
            $creado =$rs_ayuda->created_at;
            $modificado=$rs_ayuda->updated_at;
            $monto_total = '<strong>MONTO AYUDA: </strong>' . number_format($rs_ayuda->montototal, 2, ',', '.');
    
        $concepto = substr($rs_ayuda->concepto, 0, 300);
    
    
    
        $rs_user = User::find($rs_ayuda->usuario_id);
        if($rs_user){
            $elaborado =$rs_user->name;
        }

                        $rs_beneficiario = Beneficiario::find($rs_ayuda->beneficiario_id);
                        if($rs_beneficiario){
                            $beneficiario = '<strong>BENEFICIARIO: </strong>' .  $rs_beneficiario->nombre;
                        }
        
//Si existe la ayuda verificar que exista el compromiso
$rs_compromiso = Compromiso::where('ayuda_id', $rs_ayuda->id)->first();
if($rs_compromiso){
    $compromiso = $rs_compromiso->id;

    $estado_compromiso = $rs_compromiso->status;
    if($estado_compromiso== 'AP'){
        $estado_compromiso ="APROBADO";
    }elseif ($estado_compromiso== 'EP') {
        $estado_compromiso ="EN PROCESO";
    }
    elseif ($estado_compromiso== 'PR') {
        $estado_compromiso ="PROCESADO";
    }elseif ($estado_compromiso== 'AN') {
        $estado_compromiso ="ANULADO";
    }
    $correlativo_compromiso = $rs_compromiso->ncompromiso;
    $creado_compromiso = $rs_compromiso->created_at;
    $modificado_compromiso = $rs_compromiso->updated_at;

    $rs_user = User::find($rs_compromiso->usuario_id);
    if($rs_user){
        $elaborado_compromiso =$rs_user->name;
    }

    $rs_beneficiario = Beneficiario::find($rs_compromiso->beneficiario_id);
        if($rs_beneficiario){
            $beneficiario_compromiso =$rs_beneficiario->nombre;
        }
   
    $monto_compromiso = number_format($rs_compromiso->montocompromiso, 2, ',', '.');
        //inicio causado
//si existe el compromiso verificar que exista el causado
$rs_causado = Ordenpago::where('compromiso_id', $rs_compromiso->id)->first();
if($rs_causado){
    $causado = $rs_causado->id;

    $estado_causado = $rs_causado->status;
    if($estado_causado== 'AP'){
        $estado_causado ="APROBADO";
    }elseif ($estado_causado== 'EP') {
        $estado_causado ="EN PROCESO";
    }
    elseif ($estado_causado== 'PR') {
        $estado_causado ="PROCESADO";
    }elseif ($estado_causado== 'AN') {
        $estado_causado ="ANULADO";
    }
    $correlativo_causado = $rs_causado->nordenpago;
    $creado_causado = $rs_causado->created_at;
    $modificado_causado = $rs_causado->updated_at;

    $rs_user = User::find($rs_causado->usuario_id);
    if($rs_user){
        $elaborado_causado =$rs_user->name;
    }
    $rs_beneficiario = Beneficiario::find($rs_causado->beneficiario_id);
    if($rs_beneficiario){
        $beneficiario_causado =$rs_beneficiario->nombre;
    }

    //PENDIENTE PARA VISUALIZAR ESTE MONTO QUE TIENE QUE SER EL MISMO QUE EL COMPROMISO
    $monto_causado = number_format($rs_causado->montoneto, 2, ',', '.');

    //Si existe el causado verificar que exista el pagado
    $rs_pagado = Pagado::where('ordenpago_id',$rs_causado->id)->first();
    if($rs_pagado){
        $pagado = $rs_pagado->id;

        $estado_pagado = $rs_pagado->status;
    if($estado_pagado== 'AP'){
        $estado_pagado ="APROBADO";
    }elseif ($estado_pagado== 'EP') {
        $estado_pagado ="EN PROCESO";
    }
    elseif ($estado_pagado== 'PR') {
        $estado_pagado ="PROCESADO";
    }elseif ($estado_pagado== 'AN') {
        $estado_pagado ="ANULADO";
    }
    $correlativo_pagado = $rs_pagado->correlativo;
    $creado_pagado = $rs_pagado->created_at;
    $modificado_pagado = $rs_pagado->updated_at;

    $rs_user = User::find($rs_pagado->usuario_id);
    if($rs_user){
        $elaborado_pagado =$rs_user->name;
    }

    $rs_beneficiario = Beneficiario::find($rs_pagado->beneficiario_id);
    if($rs_beneficiario){
        $beneficiario_pagado =$rs_beneficiario->nombre;
    }
   
    $monto_pagado = number_format($rs_pagado->montopagado, 2, ',', '.');
    $monto_restante = number_format(($rs_pagado->montoordenpago - $rs_pagado->montopagado), 2, ',', '.');



    }
}
        //fin pagado

        } //fin compromiso ayuda
    }

} //Fin ayuda
//inicio de compra
elseif($tipo == "COMP"){

    //Obtener el id de la compra y luego el del analisis para asi obtener por ultimo la requisicion
    $rs_compra = Compra::find($ruta_id);
    //Id compras y el numero de compras
    if($rs_compra){//iniicio validacion de compra
        
        $ordenCompra = '<strong>ID COMPRAS: </strong>' . $rs_compra->id;
        $correlativoCompra = '<strong>NUMERO ORDEN COMPRA: </strong>' . $rs_compra->numordencompra;

        //Inicio de compromiso y causado y pagado
        //Si existe la compra verificar que exista el compromiso
        $rs_compromiso = Compromiso::where('compra_id', $rs_compra->id)->first();
        if($rs_compromiso){
            $compromiso = $rs_compromiso->id;

            $estado_compromiso = $rs_compromiso->status;
            if($estado_compromiso== 'AP'){
                $estado_compromiso ="APROBADO";
            }elseif ($estado_compromiso== 'EP') {
                $estado_compromiso ="EN PROCESO";
            }
            elseif ($estado_compromiso== 'PR') {
                $estado_compromiso ="PROCESADO";
            }elseif ($estado_compromiso== 'AN') {
                $estado_compromiso ="ANULADO";
            }
            $correlativo_compromiso = $rs_compromiso->ncompromiso;
            $creado_compromiso = $rs_compromiso->created_at;
            $modificado_compromiso = $rs_compromiso->updated_at;

            $rs_user = User::find($rs_compromiso->usuario_id);
            if($rs_user){
                $elaborado_compromiso =$rs_user->name;
            }

            $rs_beneficiario = Beneficiario::find($rs_compromiso->beneficiario_id);
                if($rs_beneficiario){
                    $beneficiario_compromiso =$rs_beneficiario->nombre;
                }
           
            $monto_compromiso = number_format($rs_compromiso->montocompromiso, 2, ',', '.');

            //si existe el compromiso verificar que exista el causado
            $rs_causado = Ordenpago::where('compromiso_id', $rs_compromiso->id)->first();
            if($rs_causado){
                $causado = $rs_causado->id;

                $estado_causado = $rs_causado->status;
                if($estado_causado== 'AP'){
                    $estado_causado ="APROBADO";
                }elseif ($estado_causado== 'EP') {
                    $estado_causado ="EN PROCESO";
                }
                elseif ($estado_causado== 'PR') {
                    $estado_causado ="PROCESADO";
                }elseif ($estado_causado== 'AN') {
                    $estado_causado ="ANULADO";
                }
                $correlativo_causado = $rs_causado->nordenpago;
                $creado_causado = $rs_causado->created_at;
                $modificado_causado = $rs_causado->updated_at;

                $rs_user = User::find($rs_causado->usuario_id);
                if($rs_user){
                    $elaborado_causado =$rs_user->name;
                }
                $rs_beneficiario = Beneficiario::find($rs_causado->beneficiario_id);
                if($rs_beneficiario){
                    $beneficiario_causado =$rs_beneficiario->nombre;
                }

                //PENDIENTE PARA VISUALIZAR ESTE MONTO QUE TIENE QUE SER EL MISMO QUE EL COMPROMISO
                $monto_causado = number_format($rs_causado->montoneto, 2, ',', '.');

                //Si existe el causado verificar que exista el pagado
                $rs_pagado = Pagado::where('ordenpago_id',$rs_causado->id)->first();
                if($rs_pagado){
                    $pagado = $rs_pagado->id;

                    $estado_pagado = $rs_pagado->status;
                if($estado_pagado== 'AP'){
                    $estado_pagado ="APROBADO";
                }elseif ($estado_pagado== 'EP') {
                    $estado_pagado ="EN PROCESO";
                }
                elseif ($estado_pagado== 'PR') {
                    $estado_pagado ="PROCESADO";
                }elseif ($estado_pagado== 'AN') {
                    $estado_pagado ="ANULADO";
                }
                $correlativo_pagado = $rs_pagado->correlativo;
                $creado_pagado = $rs_pagado->created_at;
                $modificado_pagado = $rs_pagado->updated_at;

                $rs_user = User::find($rs_pagado->usuario_id);
                if($rs_user){
                    $elaborado_pagado =$rs_user->name;
                }

                $rs_beneficiario = Beneficiario::find($rs_pagado->beneficiario_id);
                if($rs_beneficiario){
                    $beneficiario_pagado =$rs_beneficiario->nombre;
                }
               
                $monto_pagado = number_format($rs_pagado->montopagado, 2, ',', '.');
                $monto_restante = number_format(($rs_pagado->montoordenpago - $rs_pagado->montopagado), 2, ',', '.');



                }
            }

            //Obtener el id analisis
            $rs_analisis = Analisi::find($rs_compra->analisis_id);
            if($rs_analisis){
                $analisis = '<strong>ID ANALISIS: </strong>' . $rs_analisis->id;
                //Obtener los datos de la requisicion porque ya tenemos el del analisis
                  //Obtener los datos de la requisicion
        $rs_requisicion = Requisicione::find($rs_analisis->requisicion_id);

        if($rs_requisicion){ 
            $nombre_tipo = "Requisicion de Compra";
        $id = $ruta_id;
        $estado = $rs_requisicion->estatus;
        if($estado== 'AP'){
            $estado ="APROBADO";
        }elseif ($estado== 'EP') {
            $estado ="EN PROCESO";
        }
        elseif ($estado== 'PR') {
            $estado ="PROCESADO";
        }elseif ($estado== 'AN') {
            $estado ="ANULADO";
        }

        $correlativo=$rs_requisicion->correlativo;


        $creado =$rs_requisicion->created_at;
        $modificado=$rs_requisicion->updated_at;

    $concepto = substr($rs_requisicion->concepto, 0, 300);



    $rs_user = User::find($rs_requisicion->usuario_id);
    if($rs_user){
        $elaborado =$rs_user->name;
    }
     }
                //Fin de  datos de la requisicion

            }

        }
        //fin de inicio compromiso, causado y pagado





    } //Fin de validacion Compra
    
  } //fin de else compra
  //Inicio de servicio
  elseif($tipo == "SERV"){

    //Obtener el id de la compra y luego el del analisis para asi obtener por ultimo la requisicion
    $rs_compra = Compra::find($ruta_id);
    //Id compras y el numero de compras
    if($rs_compra){//iniicio validacion de compra
        
        $ordenCompra = '<strong>ID SERVICIO: </strong>' . $rs_compra->id;
        $correlativoCompra = '<strong>NUMERO ORDEN SERVICIO: </strong>' . $rs_compra->numordencompra;

        //Inicio de compromiso y causado y pagado
        //Si existe la compra verificar que exista el compromiso
        $rs_compromiso = Compromiso::where('compra_id', $rs_compra->id)->first();
        if($rs_compromiso){
            $compromiso = $rs_compromiso->id;

            $estado_compromiso = $rs_compromiso->status;
            if($estado_compromiso== 'AP'){
                $estado_compromiso ="APROBADO";
            }elseif ($estado_compromiso== 'EP') {
                $estado_compromiso ="EN PROCESO";
            }
            elseif ($estado_compromiso== 'PR') {
                $estado_compromiso ="PROCESADO";
            }elseif ($estado_compromiso== 'AN') {
                $estado_compromiso ="ANULADO";
            }
            $correlativo_compromiso = $rs_compromiso->ncompromiso;
            $creado_compromiso = $rs_compromiso->created_at;
            $modificado_compromiso = $rs_compromiso->updated_at;

            $rs_user = User::find($rs_compromiso->usuario_id);
            if($rs_user){
                $elaborado_compromiso =$rs_user->name;
            }

            $rs_beneficiario = Beneficiario::find($rs_compromiso->beneficiario_id);
                if($rs_beneficiario){
                    $beneficiario_compromiso =$rs_beneficiario->nombre;
                }
           
            $monto_compromiso = number_format($rs_compromiso->montocompromiso, 2, ',', '.');

            //si existe el compromiso verificar que exista el causado
            $rs_causado = Ordenpago::where('compromiso_id', $rs_compromiso->id)->first();
            if($rs_causado){
                $causado = $rs_causado->id;

                $estado_causado = $rs_causado->status;
                if($estado_causado== 'AP'){
                    $estado_causado ="APROBADO";
                }elseif ($estado_causado== 'EP') {
                    $estado_causado ="EN PROCESO";
                }
                elseif ($estado_causado== 'PR') {
                    $estado_causado ="PROCESADO";
                }elseif ($estado_causado== 'AN') {
                    $estado_causado ="ANULADO";
                }
                $correlativo_causado = $rs_causado->nordenpago;
                $creado_causado = $rs_causado->created_at;
                $modificado_causado = $rs_causado->updated_at;

                $rs_user = User::find($rs_causado->usuario_id);
                if($rs_user){
                    $elaborado_causado =$rs_user->name;
                }
                $rs_beneficiario = Beneficiario::find($rs_causado->beneficiario_id);
                if($rs_beneficiario){
                    $beneficiario_causado =$rs_beneficiario->nombre;
                }

                //PENDIENTE PARA VISUALIZAR ESTE MONTO QUE TIENE QUE SER EL MISMO QUE EL COMPROMISO
                $monto_causado = number_format($rs_causado->montoneto, 2, ',', '.');

                //Si existe el causado verificar que exista el pagado
                $rs_pagado = Pagado::where('ordenpago_id',$rs_causado->id)->first();
                if($rs_pagado){
                    $pagado = $rs_pagado->id;

                    $estado_pagado = $rs_pagado->status;
                if($estado_pagado== 'AP'){
                    $estado_pagado ="APROBADO";
                }elseif ($estado_pagado== 'EP') {
                    $estado_pagado ="EN PROCESO";
                }
                elseif ($estado_pagado== 'PR') {
                    $estado_pagado ="PROCESADO";
                }elseif ($estado_pagado== 'AN') {
                    $estado_pagado ="ANULADO";
                }
                $correlativo_pagado = $rs_pagado->correlativo;
                $creado_pagado = $rs_pagado->created_at;
                $modificado_pagado = $rs_pagado->updated_at;

                $rs_user = User::find($rs_pagado->usuario_id);
                if($rs_user){
                    $elaborado_pagado =$rs_user->name;
                }

                $rs_beneficiario = Beneficiario::find($rs_pagado->beneficiario_id);
                if($rs_beneficiario){
                    $beneficiario_pagado =$rs_beneficiario->nombre;
                }
               
                $monto_pagado = number_format($rs_pagado->montopagado, 2, ',', '.');
                $monto_restante = number_format(($rs_pagado->montoordenpago - $rs_pagado->montopagado), 2, ',', '.');



                }
            }

            //Obtener el id analisis
            $rs_analisis = Analisi::find($rs_compra->analisis_id);
            if($rs_analisis){
                $analisis = '<strong>ID ANALISIS: </strong>' . $rs_analisis->id;
                //Obtener los datos de la requisicion porque ya tenemos el del analisis
                  //Obtener los datos de la requisicion
        $rs_requisicion = Requisicione::find($rs_analisis->requisicion_id);

        if($rs_requisicion){ 
            $nombre_tipo = "Requisicion de Servicio";
        $id = $ruta_id;
        $estado = $rs_requisicion->estatus;
        if($estado== 'AP'){
            $estado ="APROBADO";
        }elseif ($estado== 'EP') {
            $estado ="EN PROCESO";
        }
        elseif ($estado== 'PR') {
            $estado ="PROCESADO";
        }elseif ($estado== 'AN') {
            $estado ="ANULADO";
        }

        $correlativo=$rs_requisicion->correlativo;


        $creado =$rs_requisicion->created_at;
        $modificado=$rs_requisicion->updated_at;

    $concepto = substr($rs_requisicion->concepto, 0, 300);



    $rs_user = User::find($rs_requisicion->usuario_id);
    if($rs_user){
        $elaborado =$rs_user->name;
    }
     }
                //Fin de  datos de la requisicion

            }

        }
        //fin de inicio compromiso, causado y pagado

    } //Fin de validacion Compra
    
  } 
//Fin de else servicio
    
    $datos = [
        'tipo' => $nombre_tipo,
        'id' => $id,
        'estado' => $estado,
        'correlativo' => $correlativo,
        'creado' => $creado,
        'modificado' => $modificado,
        'elaborado' => $elaborado,
        'concepto' => $concepto,
        'analisis' => $analisis,
        'ordenCompra' => $ordenCompra,
        'correlativoCompra' => $correlativoCompra,
        'beneficiario' => $beneficiario,
        'monto_total' => $monto_total,

        'compromiso' => $compromiso,
        'estado_compromiso' => $estado_compromiso,
        'correlativo_compromiso' => $correlativo_compromiso,
        'creado_compromiso' => $creado_compromiso,
        'modificado_compromiso' => $modificado_compromiso,
        'elaborado_compromiso' => $elaborado_compromiso,
        'monto_compromiso' => $monto_compromiso,
        'beneficiario_compromiso' => $beneficiario_compromiso,

        'causado' => $causado,
        'estado_causado' => $estado_causado,
        'correlativo_causado' => $correlativo_causado,
        'creado_causado' => $creado_causado,
        'modificado_causado' => $modificado_causado,
        'elaborado_causado' => $elaborado_causado,
        'monto_causado' => $monto_causado,
        'beneficiario_causado' => $beneficiario_causado,

        'pagado' => $pagado,
        'estado_pagado' => $estado_pagado,
        'correlativo_pagado' => $correlativo_pagado,
        'creado_pagado' => $creado_pagado,
        'modificado_pagado' => $modificado_pagado,
        'elaborado_pagado' => $elaborado_pagado,
        'monto_pagado' => $monto_pagado,
        'monto_restante' => $monto_restante,
        'beneficiario_pagado' => $beneficiario_pagado,

    ];

    return view('rutas', compact('ruta_id', 'tipo', 'datos'));
}

}