<?php

namespace App\Http\Controllers;

use App\Pagado;
use App\Ordenpago;
use App\Detallepagado;
use App\Beneficiario;
use App\Tipomovimiento;
use App\Retencione;
use App\Detalleordenpago;
use App\Detalleretencione;
use App\Comprobantesretencione;
use App\Transferencia;
use App\Banco;
use App\Cuentasbancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class PagadoController
 * @package App\Http\Controllers
 */
class PagadoController extends Controller
{
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        request()->validate(Pagado::$rules);


        //Numero de PAGADOS
        $tipo_pago = $request->tipomovimiento_id;

        $max_correlativo = DB::table('pagados')->where('tipomovimiento_id', $tipo_pago)->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['correlativo'=>$numero_correlativo]);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
   
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
            $tiporetencion= $retencion->tiporetencion_id;
          
            $detalles_rete=[               
                'ordenpago_id'=> $ordenpago_id,
                'tiporetencion_id'=> $tiporetencion,              
                'montoretencion'=> $row->montoneto,
                'status'=> 'EP',

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
        $ordenpagos = Ordenpago::where('status', 'PR')->paginate();

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
        $pagado->status = 'AN';
        $pagado->save();

        //Faltaria descontar lo que se haya imputado de esta orden de pago

        
        return redirect()->route('pagados.index')
            ->with('success', 'Orden de Pago Anulada exitosamente.');


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



}
