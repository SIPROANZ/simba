<?php

namespace App\Http\Controllers;

use App\Analisi;
use App\Clasificadorpresupuestario;
use App\Compra;
use App\Comprascp;
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
use App\Factura;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use NumeroALetras\NumeroALetras;
use Carbon\Carbon;

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
       // $ordenpagos = Ordenpago::where('status', 'EP')->paginate();

        $ordenpagos = Ordenpago::query()
       ->when(request('search'), function($query){
           return $query->where ('nordenpago', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'EP')
                        ->orWhereHas('compromiso', function($q){
                         $q->where('ncompromiso', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'EP')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'EP');
        },
        function ($query) {
            $query->where('status', 'like', 'EP')
            ->orderBy('nordenpago', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

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
         //Agregar el id del usuario
         $id_usuario = $request->user()->id;
         $request->merge(['usuario_id'=>$id_usuario]);

       // $max_correlativo = DB::table('ordenpagos')->max('nordenpago');
       // $numero_correlativo = $max_correlativo + 1;
       // $request->merge(['nordenpago'=>$numero_correlativo]);

        //Validar que el numero de orden de pago ya no este registrado en el sistema
        $validar_numero_orden = Ordenpago::where('nordenpago', $request->nordenpago)->exists();

        if($validar_numero_orden!=true){

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

        } else {
            return redirect()->route('ordenpagos.index')
            ->with('success', 'Error, el numero de orden de pago que intenta registrar, ya se encuentra incluido en el sistema.');

        }
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


        if($request->nordenpago != $ordenpago->nordenpago){ 

        //Validar que el numero de orden de pago ya no este registrado en el sistema
        $validar_numero_orden = Ordenpago::where('nordenpago', $request->nordenpago)->exists();

        if($validar_numero_orden!=true){

            $ordenpago->update($request->all());

            return redirect()->route('ordenpagos.index')
                ->with('success', 'Orden pago actualizada');

        } else {
            return redirect()->route('ordenpagos.index')
            ->with('success', 'Error, el numero de orden de pago que intenta actualizar, ya se encuentra incluido en el sistema.');

        }
    }else {
            $ordenpago->update($request->all());

            return redirect()->route('ordenpagos.index')
                ->with('success', 'Orden pago actualizada');

    }




        
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

    public function pdf_old($id)
    {
       // $compromiso = Compromiso::find($id);
        $ordenpago = Ordenpago::find($id);

        $compromiso = Compromiso::find($ordenpago->compromiso_id);

        $ejercicio = "2023";

        $meta = '';

        $concepto = 'Es Null';
        $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$ordenpago->id)->get();

        $suma_retenciones = $detalleretenciones->sum('montoneto');
        $detallescompromisos = Detallescompromiso::where('compromiso_id','=',$id)->get();
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
            ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario', 'detallesprecompromisos.financiamiento', 'detallesprecompromisos.montocompromiso')
            ->get();
            
            $suma_partidas = $partidas->sum('montocompromiso');
           // $partidas = Ejecucione::find($repartidas->ejecucion_id);

        }
        elseif($compromiso->ayuda_id != NULL){
            $partidas = Detallesayuda::where('ayuda_id',$compromiso->ayuda_id)
            ->join('ejecuciones', 'ejecuciones.id', '=', 'detallesayudas.ejecucion_id')
            ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario', 'detallesayudas.financiamiento', 'detallesayudas.montocompromiso')
            ->get();

            $suma_partidas = $partidas->sum('montocompromiso');
            //$partidas = Ejecucione::find($detpartidas->ejecucion_id);

        }
        elseif($compromiso->compra_id != NULL){
          /*************
           * *************
           * *********        
           *     CHEQUEAR ESTA AREA QUE ESTE BIEN ESTOS VALORES DEBIERA 
           * 
           * 
           *  JALARLOS DESDE LA ORDEN DE COMPRA CP *************** */
          //  $partidas = DB::table('requidetclaspres')->where('requisicion_id', $compromiso->compra->analisi->requisicione->id)->select('meta_id', 'claspres')->get();
            $partidas = Comprascp::where('compra_id',$compromiso->compra_id)
            ->join('ejecuciones', 'ejecuciones.id', '=', 'comprascps.ejecucion_id')
            ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario', 'comprascps.financiamiento', 'comprascps.monto')
            ->get();



            $suma_partidas = $partidas->sum('monto');

            //  $suma_partidas = $partidas->sum('montocompromiso');
           // $suma_partidas = 0;
        }

        //$montoletras = numerosAletras($ordenpago->montoneto,'nominal',2,'CENTIMOS','BOLIVARES');
        $pdf = PDF::loadView('ordenpago.pdf', ['suma_retenciones'=>$suma_retenciones,'suma_partidas'=>$suma_partidas,'detalleretenciones'=>$detalleretenciones, 'partidas'=>$partidas, 'ordenpago'=>$ordenpago, 'compromiso'=>$compromiso, 'detallescompromisos'=>$detallescompromisos, 'datos'=>$datos, 'totalcompromiso'=>$totalcompromiso, 'concepto'=>$concepto, 'status'=> $status]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
    }

    //
    public function pdf($id)
    {
       // $compromiso = Compromiso::find($id);
       $ordenpago = Ordenpago::find($id);

       $compromiso = Compromiso::find($ordenpago->compromiso_id);

       $ejercicio = "2023";

       $meta = '';

       $concepto = 'Es Null';
       $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$ordenpago->id)->get();

       $suma_retenciones = $detalleretenciones->sum('montoneto');
       
      // $detallescompromisos = Detallescompromiso::where('compromiso_id','=', $compromiso->id)->get();
       $detallescompromisos = Detallescompromiso::where('compromiso_id', $compromiso->id)
       ->join('ejecuciones', 'ejecuciones.id', '=', 'detallescompromisos.ejecucion_id') 
       ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.cuenta', '=', 'ejecuciones.clasificadorpresupuestario')
       ->orderBy('clasificadorpresupuestarios.cuenta','ASC')
       ->get();

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
           ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario', 'detallesprecompromisos.financiamiento', 'detallesprecompromisos.montocompromiso')
           ->get();
           
           $suma_partidas = $partidas->sum('montocompromiso');
          // $partidas = Ejecucione::find($repartidas->ejecucion_id);

       }
       elseif($compromiso->ayuda_id != NULL){
           $partidas = Detallesayuda::where('ayuda_id',$compromiso->ayuda_id)
           ->join('ejecuciones', 'ejecuciones.id', '=', 'detallesayudas.ejecucion_id')
           ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario', 'detallesayudas.financiamiento', 'detallesayudas.montocompromiso')
           ->get();

           $suma_partidas = $partidas->sum('montocompromiso');
           //$partidas = Ejecucione::find($detpartidas->ejecucion_id);

       }
       elseif($compromiso->compra_id != NULL){
         /*************
          * *************
          * *********        
          *     CHEQUEAR ESTA AREA QUE ESTE BIEN ESTOS VALORES DEBIERA 
          * 
          * 
          *  JALARLOS DESDE LA ORDEN DE COMPRA CP *************** */
         //  $partidas = DB::table('requidetclaspres')->where('requisicion_id', $compromiso->compra->analisi->requisicione->id)->select('meta_id', 'claspres')->get();
           $partidas = Comprascp::where('compra_id',$compromiso->compra_id)
           ->join('ejecuciones', 'ejecuciones.id', '=', 'comprascps.ejecucion_id')
           ->select('ejecuciones.meta_id', 'ejecuciones.clasificadorpresupuestario', 'comprascps.financiamiento', 'comprascps.monto')
           ->get();



           $suma_partidas = $partidas->sum('monto');

           //  $suma_partidas = $partidas->sum('montocompromiso');
          // $suma_partidas = 0;
       }

       //$montoletras = numerosAletras($ordenpago->montoneto,'nominal',2,'CENTIMOS','BOLIVARES');
       $pdf = PDF::loadView('ordenpago.pdf', ['suma_retenciones'=>$suma_retenciones,'suma_partidas'=>$suma_partidas,'detalleretenciones'=>$detalleretenciones, 'partidas'=>$partidas, 'ordenpago'=>$ordenpago, 'compromiso'=>$compromiso, 'detallescompromisos'=>$detallescompromisos, 'datos'=>$datos, 'totalcompromiso'=>$totalcompromiso, 'concepto'=>$concepto, 'status'=> $status]);
       $pdf->setPaper('letter', 'portrait');
       return $pdf->stream();
      // return $pdf->download();

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

    //Agregar facturas a la orden de pago
        /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarfacturas($id)
    {
        $ordenpago = Ordenpago::find($id);


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['ordenpago' => $id]);

        //Consulto los datos especificos para la requisicion seleccionada
        // $detalleretenciones = Detalleretencione::where('ordenpago_id','=',$id)->paginate();
        $facturas = Factura::where('ordenpago_id','=',$id)->paginate();
         /*
        return view('ordenpago.agregarfacturas', compact('ordenpago', 'detalleretenciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detalleretenciones->perPage());
         */


        return view('ordenpago.agregarfacturas', compact('facturas', 'ordenpago'))
            ->with('i', (request()->input('page', 1) - 1) * $facturas->perPage());
    }


    public function agregarordenpago($id)
    {
        $compromiso_id = $id;
        $ordenpago = new Ordenpago();
        $compromiso = Compromiso::find($compromiso_id);

        if($compromiso->precompromiso_id != NULL){
            $ordenpago->montoexento = 0;
            $ordenpago->montoiva = 0;
            $ordenpago->montobase = $compromiso->precompromiso->montototal;
            $ordenpago->montoneto = $compromiso->precompromiso->montototal;
        }
        elseif($compromiso->ayuda_id != NULL){
            $ordenpago->montoexento = 0;
            $ordenpago->montoiva = 0;
            $ordenpago->montobase = $compromiso->ayudassociale->montototal;
            $ordenpago->montoneto = $compromiso->ayudassociale->montototal;
        }
        elseif($compromiso->compra_id != NULL){
            $ordenpago->montobase == $compromiso->compra->montobase;
            $ordenpago->montoiva == $compromiso->compra->montoiva;
            $ordenpago->montoneto == $compromiso->compra->montototal;
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
       // $ordenpago->status = 'PR';
      //  $ordenpago->save();
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

        $ordenpago->status = 'PR';
        $ordenpago->save();
        $compromiso->status = 'AP';
        $compromiso->save();

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
       // $ordenpagos = Ordenpago::where('status', 'PR')->paginate();
        $ordenpagos = Ordenpago::query()
       ->when(request('search'), function($query){
           return $query->where ('nordenpago', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'PR')
                        ->orWhereHas('compromiso', function($q){
                         $q->where('ncompromiso', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'PR')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'PR');
        },
        function ($query) {
            $query->where('status', 'like', 'PR')
            ->orderBy('nordenpago', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('ordenpago.procesados', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());
    }

    public function indexaprobadas()
    {
        //$ordenpagos = Ordenpago::where('status', 'AP')->paginate();
        $ordenpagos = Ordenpago::query()
       ->when(request('search'), function($query){
           return $query->where ('nordenpago', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AP')
                        ->orWhereHas('compromiso', function($q){
                         $q->where('ncompromiso', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'AP')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'AP');
        },
        function ($query) {
            $query->where('status', 'like', 'AP')
            ->orderBy('nordenpago', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

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
        // $ordenpagos = Ordenpago::where('status', 'AN')->paginate();
        $ordenpagos = Ordenpago::query()
       ->when(request('search'), function($query){
           return $query->where ('nordenpago', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AN')
                        ->orWhereHas('compromiso', function($q){
                         $q->where('ncompromiso', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'AN')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'AN');
        },
        function ($query) {
            $query->where('status', 'like', 'AN')
            ->orderBy('nordenpago', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

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
        $fecha = Carbon::now();
        $ordenpago->fechaanulacion = $fecha;
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

        //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function reversar($id)
    {
        $aprobado = 1;

        $ordenpago = Ordenpago::find($id);
        
        //Obtener la compra y tambien actualizar su estado
       $compromiso = Compromiso::find($ordenpago->compromiso_id);
       
       // Obtener el detalle de compromiso para aplicar en la ejecucion
       // $detallescompromiso = Detallescompromiso::where('compromiso_id','=',$compromiso->id)->get();

        $detalleordenpago = Detalleordenpago::where('ordenpago_id', $id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detalleordenpago as $rows){
         /*   $datos_guardar = [
                'ordenpago_id' => $id,
                'unidadadministrativa_id' => $rows->unidadadministrativa_id,
                'ejecucion_id' => $rows->ejecucion_id,
                'monto' => $rows->montocompromiso,
            ];
            $detalleordenpago = Detalleordenpago::create($datos_guardar); */
                            //Obtener la ejecucion
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //dd($rows);
            //Hacer el if
            // if($rows->montocompromiso <= $ejecucion->monto_por_causar){
                $ejecucion->decrement('monto_causado', $rows->monto);
                $ejecucion->increment('monto_por_causar', $rows->monto);
                $ejecucion->decrement('monto_por_pagar', $rows->monto);
                //$ejecucion->save();
/*             }else{
                $aprobado = 0;
            } */
        }

        $ordenpago->status = 'EP';
        $ordenpago->save();
        $detalleordenpago = Detalleordenpago::where('ordenpago_id', $id)->delete();

        if($aprobado == 1){
            return redirect()->route('ordenpagos.procesados')
            ->with('success', 'Orden de Pago Reversada Exitosamente. ');
        }else{
            return redirect()->route('ordenpagos.index')
            ->with('success', 'No Reversada.');
        }

    }

    public function reversar_old($id)
    {
        $aprobado = 1;

        $ordenpago = Ordenpago::find($id);
        
        //Obtener la compra y tambien actualizar su estado
       $compromiso = Compromiso::find($ordenpago->compromiso_id);
       /*  $compromiso->status = 'AP';
        $compromiso->save(); */

        //Obtener el detalle de compromiso para aplicar en la ejecucion
        $detallescompromiso = Detallescompromiso::where('compromiso_id','=',$compromiso->id)->get();

        $detalleordenpago = Detalleordenpago::where('ordenpago_id', $id)->delete();

        //Ciclo para guardar detalle de orden de pago
        foreach($detallescompromiso as $rows){
         /*   $datos_guardar = [
                'ordenpago_id' => $id,
                'unidadadministrativa_id' => $rows->unidadadministrativa_id,
                'ejecucion_id' => $rows->ejecucion_id,
                'monto' => $rows->montocompromiso,
            ];
            $detalleordenpago = Detalleordenpago::create($datos_guardar); */
                            //Obtener la ejecucion
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //dd($rows);
            //Hacer el if
            // if($rows->montocompromiso <= $ejecucion->monto_por_causar){
                $ejecucion->decrement('monto_causado', $rows->montocompromiso);
                $ejecucion->increment('monto_por_causar', $rows->montocompromiso);
                $ejecucion->decrement('monto_por_pagar', $rows->montocompromiso);
                //$ejecucion->save();
/*             }else{
                $aprobado = 0;
            } */
        }

        $ordenpago->status = 'EP';
        $ordenpago->save();

        if($aprobado == 1){
            return redirect()->route('ordenpagos.procesados')
            ->with('success', 'Orden de Pago Reversada Exitosamente. ');
        }else{
            return redirect()->route('ordenpagos.index')
            ->with('success', 'No Reversada.');
        }

    }
}
