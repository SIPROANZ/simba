<?php

namespace App\Http\Controllers;

use App\Pagado;
use App\Ordenpago;
use App\Ejecucione;
use App\Detallepagado;
use App\Beneficiario;
use App\Tipomovimiento;
use App\Retencione;
use App\Detalleordenpago;
use App\Detalleretencione;
use App\Comprobantesretencione;
use App\Transferencia;
use App\Cuentasbancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\User;

/**
 * Class PagadoController
 * @package App\Http\Controllers
 */
class PagadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.pagados')->only('index', 'edit', 'update', 'create', 'store', 'pdf', 'indexprocesadas', 'indexanuladas', 'idexaprobadas');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pagados = Pagado::where('status', 'EP')->paginate();

        $pagados = Pagado::query()
       ->when(request('search'), function($query){
           return $query->where ('correlativo', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'EP')
                        ->orWhereHas('ordenpago', function($q){
                         $q->where('nordenpago', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'EP')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'EP');
        },
        function ($query) {
            $query->where('status', 'like', 'EP')
            ->orderBy('correlativo', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

        return view('pagado.index', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
    }

    /**
     * Display pagados procesadas
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        //$pagados = Pagado::where('status', 'PR')->paginate();
         $pagados = Pagado::query()
        ->when(request('search'), function($query){
            return $query->where ('correlativo', 'like', '%'.request('search').'%')
                         ->where('status', 'like', 'PR')
                         ->orWhereHas('ordenpago', function($q){
                          $q->where('nordenpago', 'like', '%'.request('search').'%');
                          })->where('status', 'like', 'PR')
                           ->orWhereHas('beneficiario', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'PR');
         },
         function ($query) {
             $query->where('status', 'like', 'PR')
             ->orderBy('correlativo', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('pagado.procesados', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
     }

     /**
     * Display pagados procesadas
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
       //  $pagados = Pagado::where('status', 'AP')->paginate();

       $pagados = Pagado::query()
       ->when(request('search'), function($query){
           return $query->where ('correlativo', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AP')
                        ->orWhereHas('ordenpago', function($q){
                         $q->where('nordenpago', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'AP')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'AP');
        },
        function ($query) {
            $query->where('status', 'like', 'AP')
            ->orderBy('correlativo', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

        return view('pagado.aprobadas', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
     }
    
     /**
     * Display pagados procesadas
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
       // $pagados = Pagado::where('status', 'AN')->paginate();

        $pagados = Pagado::query()
        ->when(request('search'), function($query){
            return $query->where ('correlativo', 'like', '%'.request('search').'%')
                         ->where('status', 'like', 'AN')
                         ->orWhereHas('ordenpago', function($q){
                          $q->where('nordenpago', 'like', '%'.request('search').'%');
                          })->where('status', 'like', 'AN')
                           ->orWhereHas('beneficiario', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'AN');
         },
         function ($query) {
             $query->where('status', 'like', 'AN')
             ->orderBy('correlativo', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('pagado.anulados', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagado = new Pagado();

        $tipomovimientos = Tipomovimiento::pluck('descripcion', 'id');

        return view('pagado.create', compact('pagado','tipomovimientos'));
    }

    public function nuevo_comprobante($tipo_ret, $fecha)
    {
        $mensaje='';

        // Obtener el year, moth in moment
        // $fecha_actual = Carbon::now();
        $fecha_actual = $fecha;
        $mes_actual = $fecha_actual->month;
        $mes_actual = intval($mes_actual);
        if($mes_actual<10){
            $mes_actual = '0'.$mes_actual;
        }else{
            $mes_actual = strval($mes_actual);  
        }
        $ano_actual = $fecha_actual->year;

        $codigo_comprobante = '';
        $ano_base = '';
        $mes_base = '';
        $correlativo = '';
        $correlativo = '';
        $str_correlativo = '';
        $nuevo_codigo = '';

        $tipo_retencion = $tipo_ret;

        $buscar_comprobate = Comprobantesretencione::where('tiporetencion_id',$tipo_retencion)
        ->whereYear('created_at', $ano_actual)->whereMonth('created_at', $mes_actual)->exists();

        if($buscar_comprobate)
        {

            $buscar_comprobate = Comprobantesretencione::where('tiporetencion_id',$tipo_retencion)
            ->whereYear('created_at', $ano_actual)->whereMonth('created_at', $mes_actual)->orderBy('id', 'DESC')->first();

        $codigo_comprobante = $buscar_comprobate->ncomprobante;
        $ano_base = substr($codigo_comprobante,0,4);
        $mes_base = substr($codigo_comprobante,4,2);
        $correlativo = substr($codigo_comprobante,6);
        $correlativo = intval($correlativo);
        $str_correlativo = '';
        $nuevo_codigo = '';

        

        //Validar y crear el nuevo codigo correlativo
        if($mes_base==$mes_actual && $ano_base == $ano_actual){
            //Si son iguales solo incrementar el correlativo
            $nuevo_correlativo = $correlativo + 1;
            if($nuevo_correlativo<10){
                $str_correlativo = '0000000'.$nuevo_correlativo;
            }elseif($nuevo_correlativo>=10 && $nuevo_correlativo<100){
                $str_correlativo = '000000'.$nuevo_correlativo;
            }
            elseif($nuevo_correlativo>=100 && $nuevo_correlativo<1000){
                $str_correlativo = '00000'.$nuevo_correlativo;
            }
            elseif($nuevo_correlativo>=1000 && $nuevo_correlativo<10000){
                $str_correlativo = '0000'.$nuevo_correlativo;
            }
            elseif($nuevo_correlativo>=10000 && $nuevo_correlativo<100000){
                $str_correlativo = '000'.$nuevo_correlativo;
            }
            elseif($nuevo_correlativo>=100000 && $nuevo_correlativo<1000000){
                $str_correlativo = '00'.$nuevo_correlativo;
            }
            elseif($nuevo_correlativo>=1000000 && $nuevo_correlativo<10000000){
                $str_correlativo = '0'.$nuevo_correlativo;
            }
            elseif($nuevo_correlativo>=10000000){
                $str_correlativo = $nuevo_correlativo;
            }
            
            $nuevo_codigo = $ano_actual . $mes_actual . $str_correlativo ;
        }else{
            //Sin son diferentes iniciar el correlativo en uno, tomando la fecha a;o y mes actual
            $nuevo_codigo = $ano_actual . $mes_actual . '00000001' ;
        }

     
    }else{
        $nuevo_codigo = $ano_actual . $mes_actual . '00000001';
    }

     /*   $mensaje .= 'mes: ' . $mes_actual . ' ano: ' . $ano_actual . ' mes base: ' . $mes_base . ' ano base: ' . $ano_base . 
        ' Correlativo en entero: ' . $correlativo . ' Codigo Comprobante Actual: ' . $codigo_comprobante . 
        ' Nuevo Codigo Comprobante: ' . $nuevo_codigo . ' Correlativo en String: ' . $str_correlativo;
*/
        
   //return $mensaje;
   return $nuevo_codigo;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        request()->validate(Pagado::$rules);

        //Numero de PAGADOS
        $tipo_pago = $request->tipomovimiento_id;

        $max_correlativo = DB::table('pagados')->where('tipomovimiento_id', $tipo_pago)->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['correlativo'=>$numero_correlativo]);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        $request->merge(['montopagado'=>0]);

        $fecha_pagado = $request->created_at;
   
        $pagado = Pagado::create($request->all());

        $ultimo = Pagado::latest('id')->first();
        $pagado_id = $ultimo->id;

        $ordenpago_id = $request->ordenpago_id;
        $detalle_ordenpago = Detalleordenpago::where('ordenpago_id', $ordenpago_id)->get();

        foreach($detalle_ordenpago as $row){
          
            $detalles_pagados=[
                'pagado_id'=> $pagado_id,
                'ordenpago_id'=> $ordenpago_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
                'montopagado'=> $row->monto,
                'montoabonado'=> 0
            ];

            $detallepagado = Detallepagado::create($detalles_pagados);

        }

        $detalle_retenciones = Detalleretencione::where('ordenpago_id', $ordenpago_id)->get();

        foreach($detalle_retenciones as $row){

            $retencion = Retencione::find($row->retencion_id);
            $tiporetencion = $retencion->tiporetencion_id;
            $det_retencion = $row->id;

            //busco el nuevo numero de comprobante
            $ncomprobante = $this->nuevo_comprobante($tiporetencion, new Carbon($fecha_pagado));
          
            $detalles_rete=[               
                'ordenpago_id' => $ordenpago_id,
                'tiporetencion_id' => $tiporetencion, 
                'detretencion_id' => $det_retencion,           
                'montoretencion' => $row->montoneto,
                'ncomprobante' => $ncomprobante,
                'created_at' => $fecha_pagado,
                'status' => 'EP',

            ];

            $detallecomprobantes = Comprobantesretencione::create($detalles_rete);

        }

        //Obtener la orden de pago para cambiar su estatus a aprobado
        $ordenpago = Ordenpago::find($ordenpago_id);
        $ordenpago->status = 'AP';
        $ordenpago->save();

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado creado exitosamente.');
    }

    public function store_old(Request $request)
    {

        //dd($request);
        request()->validate(Pagado::$rules);

        //Numero de PAGADOS
        $tipo_pago = $request->tipomovimiento_id;

        $max_correlativo = DB::table('pagados')->where('tipomovimiento_id', $tipo_pago)->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['correlativo'=>$numero_correlativo]);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        $request->merge(['montopagado'=>0]);

        $fecha_pagado = $request->created_at;
   
        $pagado = Pagado::create($request->all());

        $ultimo = Pagado::latest('id')->first();
        $pagado_id = $ultimo->id;

        $ordenpago_id = $request->ordenpago_id;
        $detalle_ordenpago = Detalleordenpago::where('ordenpago_id', $ordenpago_id)->get();

        foreach($detalle_ordenpago as $row){
          
            $detalles_pagados=[
                'pagado_id'=> $pagado_id,
                'ordenpago_id'=> $ordenpago_id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
                'montopagado'=> $row->monto,
                'montoabonado'=> 0
            ];

            
            $detallepagado = Detallepagado::create($detalles_pagados);

        }

        $detalle_retenciones = Detalleretencione::where('ordenpago_id', $ordenpago_id)->get();

        foreach($detalle_retenciones as $row){

            $retencion = Retencione::find($row->retencion_id);
            $tiporetencion = $retencion->tiporetencion_id;
            $det_retencion = $row->id;

            //busco el nuevo numero de comprobante
            $ncomprobante = $this->nuevo_comprobante($tiporetencion, new Carbon($fecha_pagado));
          
            $detalles_rete=[               
                'ordenpago_id' => $ordenpago_id,
                'tiporetencion_id' => $tiporetencion, 
                'detretencion_id' => $det_retencion,           
                'montoretencion' => $row->montoneto,
                'ncomprobante' => $ncomprobante,
                'created_at' => $fecha_pagado,
                'status' => 'EP',

            ];

            $detallecomprobantes = Comprobantesretencione::create($detalles_rete);

        }

        //Obtener la orden de pago para cambiar su estatus a aprobado
        $ordenpago = Ordenpago::find($ordenpago_id);
        $ordenpago->status = 'AP';
        $ordenpago->save();

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagado = Pagado::find($id);
        $detallepagados = Detallepagado::where('pagado_id', $id)->paginate();

        return view('pagado.show', compact('detallepagados','pagado'))
        ->with('i', (request()->input('page', 1) - 1) * $detallepagados->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagado = Pagado::find($id);
        $ordenpagos = Ordenpago::find($pagado->ordenpago_id);
      
        $tipomovimientos = Tipomovimiento::pluck('descripcion', 'id');
        return view('pagado.edit', compact('pagado', 'ordenpagos','tipomovimientos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pagado $pagado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagado $pagado)
    {
        request()->validate(Pagado::$rules);

        $pagado->update($request->all());

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado editado satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pagado = Pagado::find($id)->delete();

        return redirect()->route('pagados.index')
            ->with('success', 'Pagado deleted successfully');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar()
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


        return view('pagado.agregar', compact('ordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenpagos->perPage());

    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarorden($id)
    {
     
      // $pagado = new Pagado();
       $ordenpago_id = $id;
        $pagado = new Pagado();

       $ordenpagos = Ordenpago::find($ordenpago_id);
       $tipomovimientos = Tipomovimiento::pluck('descripcion', 'id');

       return view('pagado.agregarorden', compact('pagado','ordenpagos','tipomovimientos'));

    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregartransferencia($id)
    {
     
        $transferencia = new Transferencia();
      // $pagado = new Pagado();
        $pagado_id = $id;
        $pagados = Pagado::find($pagado_id);
       // $cuentasbancarias = Cuentasbancaria::pluck('cuenta', 'id');


       $cuentasbancarias = Cuentasbancaria::join('bancos', 'bancos.id', '=','cuentasbancarias.banco_id')
            ->select(DB::raw("CONCAT(bancos.denominacion,' ',cuentasbancarias.cuenta,' Saldo: ',cuentasbancarias.montosaldo) AS name"),'cuentasbancarias.id')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'cuentasbancarias.id');

        /*
        $cuentasbancarias = Cuentasbancaria::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->pluck('name', 'id'); */

        return view('transferencia.create', compact('pagados', 'transferencia', 'cuentasbancarias'));

    }


    //Metodo para aprobar un pagado
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada el pagado
     * @throws \Exception
     */
    public function aprobarold($id)
    {
        $aprobado = 1;

        $pagado = Pagado::find($id);
        $pagado->status = 'PR';
        $pagado->save();
        //pagado
        $ordenpago = Ordenpago::find($pagado->ordenpago_id);
        $ordenpago->status = 'AP';
        $ordenpago->save();

        //Obtener el detalle de orden de pago para aplicar en la ejecucion
        $detalleordenpago = Detalleordenpago::where('ordenpago_id','=',$ordenpago->id)->get();

        //Ciclo para guardar detalle de orden de pago
        foreach($detalleordenpago as $row){
            $datos_guardar = [
                'pagado_id'=> $id,
                'ordenpago_id'=> $id,
                'unidadadministrativa_id'=> $row->unidadadministrativa_id,
                'ejecucion_id'=> $row->ejecucion_id,
                'montopagado'=> $row->monto,
            ];
            $detallepagado = Detallepagado::create($datos_guardar);
                            //Obtener la ejecucion
        //    $ejecucion = Ejecucione::find($rows->ejecucion_id);
            
        //        $ejecucion->save();
       
        }

        if($aprobado == 1){
            return redirect()->route('pagados.procesados')
            ->with('success', 'Pago Aprobada Exitosamente. ');
        }else{
            return redirect()->route('pagados.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

    }

    
    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UN PAGADO
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $pagado = Pagado::find($id);

        //Faltaria descontar lo que se haya imputado de esta orden de pago
        //Obtener detalle de pagado 
        $detalles_pagados = Detallepagado::where('pagado_id',$id)->get();

        foreach($detalles_pagados as $rows){
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            $ejecucion->decrement('monto_pagado', $rows->montoabonado);
            $ejecucion->increment('monto_por_pagar', $rows->montoabonado);
        }

        $pagado->status = 'AN';
        $pagado->save();

        //Activar nuevamente la orden de pago
        $ordenpago = Ordenpago::find($pagado->ordenpago_id);
        $ordenpago->status = 'PR';
        $ordenpago->save();

        //Eliminar los comprobantes de retenciones
        $comprobantes = Comprobantesretencione::where('ordenpago_id',$ordenpago->id)->get();
        $comprobantes->delete();

        return redirect()->route('pagados.index')
            ->with('success', 'Orden de Pago Anulada Exitosamente.');

    }
    /**
     * Metodo Para reversar solamente la orden de pago
     */
    public function reversar($id)
    {

        $pagado = Pagado::find($id);

        //Activar nuevamente la orden de pago
        $ordenpago = Ordenpago::find($pagado->ordenpago_id);
        $ordenpago->status = 'PR';
        $ordenpago->save();

        return redirect()->route('pagados.index')
            ->with('success', 'Orden de Pago Reversada satisfactoriamente.');

    }

    /**
     * Metodo Para reversar solamente la orden de pago
     */
    public function actualizar($id)
    {

        $pagado = Pagado::find($id);
        $ordenpago = Ordenpago::find($pagado->ordenpago_id);

        //Validar que la orden de pago su estatus este en PR en caso contrario no hacer nada
        if($ordenpago->status == "PR")
        {
        //Actualizar el monto del pagado con el monto neto de la orden de pago
        $pagado->montoordenpago = $ordenpago->montoneto;
        $pagado->save();

        //Obtener el detalle del pagado, y actualizarlo con el detalle de la orden de pago.
        $rs_detalle_pagado = Detallepagado::where('pagado_id', $id)->get();

        foreach ($rs_detalle_pagado as $value) {
            
            //Obtener los valores del detalle orden de pago y este valor actualizara el monto en el detalle pagado
            $rs_det_ordenpago = Detalleordenpago::where('ordenpago_id', $value->ordenpago_id)->where('ejecucion_id', $value->ejecucion_id)->first();
            $value->montopagado = $rs_det_ordenpago->monto;
            $value->save();

        }

        return redirect()->route('pagados.index')
            ->with('success', 'Actualizado Correctamente');
        } else {
            return redirect()->route('pagados.index')
            ->with('success', 'Error al intentar actualizar, el pagado, debido a que la orden de pago no esta con estatus procesado. ID PAGADO: ' . $pagado->id);
        }

        

    }

    //Metodo para aprobar un pagado
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada el pagado
     * @throws \Exception
     */
    public function aprobar($id)
    {
       
        $pagado = Pagado::find($id);
        $pagado->status = 'PR';
        $pagado->save();

        return redirect()->route('pagados.procesados')
            ->with('success', 'Pago Procesado Exitosamente, ya puede incluirle transferencias. ');
      

    }


    //Imprimir un comprobante del pagado muy diferente al de egreso de la transferencia
     //
     public function pdf($id)
     {
        // $compromiso = Compromiso::find($id);
        $pagado = Pagado::find($id);
        $transferencias = Transferencia::where('pagado_id', $id)->get();
        $total_transferencia = $transferencias->sum('montotransferencia');
 
        
 
        //$montoletras = numerosAletras($ordenpago->montoneto,'nominal',2,'CENTIMOS','BOLIVARES');
        $pdf = PDF::loadView('pagado.pdf', ['pagado'=>$pagado, 'transferencias'=> $transferencias, 'total_transferencia'=> $total_transferencia]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
        //return $pdf->download();
 
     }


     public function reportes()
     {
        
        $usuarios = User::orderBy('name', 'ASC')->pluck('name' , 'id'); 
 
         $fecha_actual = Carbon::now();
       
 
         return view('pagado.reportes', compact('fecha_actual','usuarios'));
     }
 
     public function reporte_pdf(Request $request)
     {
         //Buscar por institucion
         $rif = $request->rif;
 
         //Obtener Beneficiario
         $beneficiario_id = false;
         $nombre_beneficiario = '';
         $rs_beneficiario = Beneficiario::where('rif', $rif)->first();
         if($rs_beneficiario){
             $beneficiario_id = $rs_beneficiario->id;
             $nombre_beneficiario = $rs_beneficiario->nombre;
         }
         
         $estatus = $request->status;
         $nombre_estatus = '';
         if($estatus == 'EP')
         {
             $nombre_estatus = 'EN PROCESO';
         }elseif($estatus == 'AP'){
             $nombre_estatus = 'APROBADO';
         }elseif($estatus == 'PR'){
             $nombre_estatus = 'PROCESADO';
         }elseif($estatus == 'AN'){
             $nombre_estatus = 'ANULADO';
         }
         $usuario = $request->usuario_id;
         $inicio = $request->fecha_inicio;
         $fin = $request->fecha_fin;
         
         $nombre_usuario = '';
         $rs_usuario = User::find($usuario);
         if($rs_usuario){
             $nombre_usuario = $rs_usuario->name;
         }
 
         $pagados = Pagado::beneficiarios($beneficiario_id)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
         $pagado = $pagados->sum('montopagado');
         $ordenpago = $pagados->sum('montoordenpago');
         $porpagar = $ordenpago  - $pagado;
         $aprobadas = Pagado::where('status', 'AP')->beneficiarios($beneficiario_id)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
         $procesadas = Pagado::where('status', 'PR')->beneficiarios($beneficiario_id)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
         $enproceso = Pagado::where('status', 'EP')->beneficiarios($beneficiario_id)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
         $anuladas = Pagado::where('status', 'AN')->beneficiarios($beneficiario_id)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
         $total = Pagado::beneficiarios($beneficiario_id)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        
         $datos = [
             
             'aprobadas' => $aprobadas,
             'procesadas' => $procesadas,
             'enproceso' => $enproceso,
             'anuladas' => $anuladas,
             'total' => $total, 
             
             
             'inicio' => $inicio,
             'fin' => $fin,  
             'usuario' =>$nombre_usuario,  
             'estatus' =>$nombre_estatus,  
             'beneficiario' => $nombre_beneficiario,
             'pagado' => $pagado,
             'ordenpago' => $ordenpago,
             'porpagar' => $porpagar,
             ]; 
 
         $pdf = PDF::setPaper('letter', 'landscape')->loadView('pagado.reportepdf', ['datos'=>$datos, 'pagados'=>$pagados]);
         return $pdf->stream();
         
          
     }



}
