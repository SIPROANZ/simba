<?php

namespace App\Http\Controllers;

use App\Analisi;
use App\Clasificadorpresupuestario;
use App\Compra;
use App\Compromiso;
use App\Detalleordenpago;
use App\Detalleretencione;
use App\Detallesanalisi;
use App\Detallescompromiso;
use App\Detallesprecompromiso;
use App\Detallesayuda;
use App\Ejecucione;
use App\Ordenpago;
use App\Requisicione;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class OrdenpagoController
 * @package App\Http\Controllers
 */
class OrdenpagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenpagos = Ordenpago::where('status', 'EP')->paginate();

        return view('ordenpago.index', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    public function indexcompromisos()
    {
       // $compras = Compra::paginate();
        $compromisos = Compromiso::where('status', 'PR')->paginate();


        return view('ordenpago.compromisos', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenpago = new Ordenpago();
        return view('ordenpago.create', compact('ordenpago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ordenpago::$rules);

        $max_correlativo = DB::table('ordenpagos')->max('nordenpago');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['nordenpago'=>$numero_correlativo]);
        $request->merge(['status'=>'EP']);
        $nordenpago = Ordenpago::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Ordenpago::latest('id')->first();
        $nordenpago_id = $ultimo->id;

        $compromiso = Compromiso::find($nordenpago->compromiso_id);
        //dd($compromiso);
        $compromiso->status = 'AP';
        $compromiso->save();

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Orden de Pago creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordenpago = Ordenpago::find($id);
        $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$id)->paginate();

        return view('ordenpago.show', compact('ordenpago','detalleretenciones'))->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordenpago = Ordenpago::find($id);
        $compromiso = Compromiso::find($ordenpago->compromiso_id);

        return view('ordenpago.edit', compact('ordenpago','compromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ordenpago $ordenpago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordenpago $ordenpago)
    {
        request()->validate(Ordenpago::$rules);

        $ordenpago->update($request->all());

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Ordenpago updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ordenpago = Ordenpago::find($id)->delete();

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Ordenpago deleted successfully');
    }

    public function pdf($id)
    {
       // $compromiso = Compromiso::find($id);
        $ordenpago = Ordenpago::find($id);

        $compromiso = Compromiso::find($ordenpago->compromiso_id);

        $ejercicio = "2023";

        $meta = '';

        $concepto = 'Es Null';

        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->paginate();
        $totalcompromiso = $detallescompromisos->sum('montocompromiso');

        $datos = array();
            $ejercicio ='';

           /* $rs_ejecucion = Ejecucione::find($compromiso->detallescompromisos->ejecucion_id);
            $meta =  $rs_ejecucion->meta_id;
            $ejercicio_id =$rs_ejecucion->ejercicio_id;
            $rs_ejercicio = Ejercicio::find($ejercicio_id);
            $nombre_ejercicio = $rs_ejercicio->ejercicioejecucion;*/

        if($compromiso->precompromiso_id != NULL){
            $concepto = $compromiso->precompromiso->concepto;
            
           // $ejercicio = $compromiso->precompromiso->detallesprecompromiso->ejecucione->ejercicio->ejercicioejecucion;
        }
        elseif($compromiso->ayuda_id != NULL){
            $concepto = $compromiso->ayudassociale->concepto;
          //  $ejercicio = $compromiso->ayudassociale->detallesayuda->ejecucione->ejercicio->ejercicioejecucion;
        }
        elseif($compromiso->compra_id != NULL){

            $compra_id = $compromiso->compra_id;
            $rs_compra = Compra::find($compra_id);
            $analisis_id = $rs_compra->analisis_id;
            $rs_analisis = Analisi::find($analisis_id);
            $requisicion_id = $rs_analisis->requisicion_id;
            $rs_requisicion = Requisicione::find($requisicion_id);
            $concepto = $rs_requisicion->concepto;
         //   $ejercicio = $compromiso->compra->comprascps->ejecucione->ejercicio->ejercicioejecucion;

        }
        foreach($detallescompromisos as $rows){
            //Obtener la denominacion a partir de la cuenta
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            $cuenta = Clasificadorpresupuestario::where('cuenta', $ejecucion->clasificadorpresupuestario)->first();
            $datos = Arr::add($datos, $rows->ejecucion_id, $cuenta->denominacion);

        }

        $status=null;

        if($ordenpago->status=='AP'){
            $status='APROBADO';
        }
        elseif($ordenpago->status=='PR'){
            $status='PROCESADO';
        }
        elseif($ordenpago->status=='EP'){
            $status='EN PROCESO';
        }
        elseif($ordenpago->status=='AN'){
            $status='ANULADO';
        }
        elseif($ordenpago->status=='RV '){
            $status='RESERVADO';
        }



        if($compromiso->precompromiso_id != NULL){
            $partidas = Detallesprecompromiso::where('precompromiso_id',$compromiso->precompromiso_id)
            ->join('ejecuciones', 'ejecuciones.id', '=', 'detallesprecompromisos.ejecucion_id') 
            ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario')
            ->get();
           // $partidas = Ejecucione::find($repartidas->ejecucion_id);

        }
        elseif($compromiso->ayuda_id != NULL){
            $partidas = Detallesayuda::where('ayuda_id',$compromiso->ayuda_id)->get();
           // $partidas = Ejecucione::find($repartidas->ejecucion_id);
        
        }
        elseif($compromiso->compra_id != NULL){

            $partidas = DB::table('requidetclaspres')->where('requisicion_id', $compromiso->compra->analisi->requisicione->id)->select('meta_id', 'claspres')->get();

        }

        
        $pdf = PDF::loadView('ordenpago.pdf', ['partidas'=>$partidas, 'ordenpago'=>$ordenpago, 'compromiso'=>$compromiso, 'detallescompromisos'=>$detallescompromisos, 'datos'=>$datos, 'totalcompromiso'=>$totalcompromiso, 'concepto'=>$concepto, 'status'=> $status]);
        return $pdf->stream();
    }

        /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $ordenpago = Ordenpago::find($id);


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['ordenpago' => $id]);

        //Consulto los datos especificos para la requisicion seleccionada
        $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$id)->paginate();

        return view('ordenpago.agregar', compact('ordenpago', 'detalleretenciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detalleretenciones->perPage());
    }

    public function agregarordenpago($id)
    {
        $compromiso_id = $id;
        $ordenpago = new Ordenpago();
        $compromiso = Compromiso::find($compromiso_id);

        if($compromiso->precompromiso_id != NULL){
           // $ordenpago->montoexento = 0;
           // $ordenpago->save();
        }
        elseif($compromiso->ayuda_id != NULL){
           // $ordenpago->montoexento = 0;
           // $ordenpago->save();
        }
        elseif($compromiso->compra_id != NULL){

            $detalles_analisis = Detallesanalisi::where('analisis_id', $compromiso->compra->analisi->id)->get();

        foreach($detalles_analisis as $row){
            if ($row->iva == 0) {
                $ordenpago->montoexento += $row->subtotal;
            } else {

            }
        }

        }

        return view('ordenpago.agregarordenpago', compact('compromiso', 'ordenpago'));
    }


    //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $aprobado = 1;

        $ordenpago = Ordenpago::find($id);
        $ordenpago->status = 'PR';
        $ordenpago->save();
        //Obtener la compra y tambien actualizar su estado
        $compromiso = Compromiso::find($ordenpago->compromiso_id);
        $compromiso->status = 'AP';
        $compromiso->save();

        //Obtener el detalle de compromiso para aplicar en la ejecucion
        $detallescompromiso = Detallescompromiso::where('compromiso_id','=',$compromiso->id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detallescompromiso as $rows){
            $datos_guardar = [
                'ordenpago_id' => $id,
                'unidadadministrativa_id' => $rows->unidadadministrativa_id,
                'ejecucion_id' => $rows->ejecucion_id,
                'monto' => $rows->montocompromiso,
            ];
            $detalleordenpago = Detalleordenpago::create($datos_guardar);
                            //Obtener la ejecucion
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //dd($rows);
            //Hacer el if
            // if($rows->montocompromiso <= $ejecucion->monto_por_causar){
                $ejecucion->increment('monto_causado', $rows->montocompromiso);
                $ejecucion->decrement('monto_por_causar', $rows->montocompromiso);
                $ejecucion->increment('monto_por_pagar', $rows->montocompromiso);
                //$ejecucion->save();
/*             }else{
                $aprobado = 0;
            } */
        }

        if($aprobado == 1){
            return redirect()->route('ordenpagos.procesados')
            ->with('success', 'Orden de Pago Aprobada Exitosamente. ');
        }else{
            return redirect()->route('ordenpagos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

    }

        /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        $ordenpagos = Ordenpago::where('status', 'PR')->paginate();

        return view('ordenpago.procesados', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    public function indexaprobadas()
    {
        $ordenpagos = Ordenpago::where('status', 'AP')->paginate();

        return view('ordenpago.aprobados', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        $ordenpagos = Ordenpago::where('status', 'AN')->paginate();

        return view('ordenpago.anulados', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {

        $ordenpago = Ordenpago::find($id);
        $ordenpago->status = 'AN';
        $ordenpago->save();

        //Obtener el detalle de compromiso para reversar la ejecucion
        $detallescompromiso = Detallescompromiso::where('compromiso_id','=',$ordenpago->compromiso_id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detallescompromiso as $rows){
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            $ejecucion->decrement('monto_causado', $rows->montocompromiso);
            $ejecucion->increment('monto_por_causar', $rows->montocompromiso);
            $ejecucion->decrement('monto_por_pagar', $rows->montocompromiso);
            $ejecucion->save();
        }

        $detallesordepago = Detalleordenpago::where('ordenpago_id','=',$ordenpago->id)->delete();

        return redirect()->route('ordenpagos.index')
            ->with('success', 'Orden de Pago Anulada exitosamente.');


    }
}
