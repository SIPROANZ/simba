<?php

namespace App\Http\Controllers;

use App\Transferencia;
use App\Banco;
use App\Pagado;
use App\Ordenpago;
use App\Cuentasbancaria;
use App\Beneficiario;
use App\Detallepagado;
use App\Ejecucione;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;


use App\Models\User;

/**
 * Class TransferenciaController
 * @package App\Http\Controllers
 */
class TransferenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.pagados')->only('index', 'edit', 'update', 'create', 'store', 'pdf');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $transferencias = Transferencia::paginate();
        $transferencias = Transferencia::query()
        ->when(request('search'), function($query){
            return $query->where ('egreso', 'like', '%'.request('search').'%')
                           ->orWhereHas('beneficiario', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })->orderBy('egreso', 'DESC');
         },
         function ($query) {
             $query->orderBy('egreso', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('transferencia.index', compact('transferencias'))
            ->with('i', (request()->input('page', 1) - 1) * $transferencias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transferencia = new Transferencia();
        return view('transferencia.create', compact('transferencia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_old(Request $request)
    { 
        request()->validate(Transferencia::$rules);

        $max_correlativo = DB::table('transferencias')->max('egreso');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['egreso'=>$numero_correlativo]);



        return redirect()->route('pagados.procesados')
        ->with('success', 'Error: El monto a transferir: '. number_format($request->montotransferencia, 2,',','.')  );
 

        
        //Antes de hacer la transferencia validar que haya plata en la cuenta de la cual se va a debitar
        $cuenta_bancaria = Cuentasbancaria::find($request->cuentasbancaria_id);
        $pagado = Pagado::find($request->pagado_id);

        //Obtengo el monto de la orden y el monto que va pagado
        $monto_orden_pago = $pagado->montoordenpago;
        $monto_pagado = $pagado->montopagado;
        $total_a_pagar = $monto_orden_pago - $monto_pagado;

        $saldo = $cuenta_bancaria->montosaldo;
        $monto_transferencia = $request->montotransferencia;

        $validar_transferencia = Transferencia::where('cuentasbancaria_id', $request->cuentasbancaria_id)->where('referenciabancaria',$request->referenciabancaria)->exists();
       
      

        if($monto_transferencia <= $saldo){ //que la cuenta tenga saldo

            if($monto_transferencia <= $total_a_pagar){ //que el monto de la trasnferencia no sea mayor a lo que se debe pagar

                if($validar_transferencia != TRUE){ //Validar que el numero de referencia no se repita

                    if(bccomp($monto_transferencia, $total_a_pagar, 2)==0){
                        //Cuando sea igual al monto a pagar entonces se paga completo los detalles y se
                        //modifica la ejecucion presupuestaria completa

                    //Cuando el monto sea igual al total a pagar, pagarlo y cambiar el estatus a AP
                    $transferencia = Transferencia::create($request->all());

                    //Inicio de codigo aumento pagado
                    //Aumentar el monto en pagado que viene de la transferencia
                    $pagados = Pagado::find($request->pagado_id);
                    $pagados->increment('montopagado', $request->montotransferencia);

                    //Descontar el saldo de la cuenta bancaria el monto transferido
                    $cuenta_bancaria->decrement('montosaldo',$request->montotransferencia);

                    //
                    $detalles_pagado = Detallepagado::where('pagado_id', $request->pagado_id)->get();

                    foreach($detalles_pagado as $rows){

                        $montopagado = $rows->montopagado;
                        $montoabonado = $rows->montoabonado;
                        $monto_diferencia = $montopagado - $montoabonado;

                        if($monto_diferencia!=0){ 

                                //Agregar el monto de la transferencia al abano de detalle pagado
                                $det_pagado = Detallepagado::find($rows->id);
                                $det_pagado->increment('montoabonado', $monto_diferencia);
                                //Modificar la ejecucion y colocar pagado en la ejecucion correspondiente
                                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                                $ejecucion->increment('monto_pagado', $monto_diferencia);
                                $ejecucion->decrement('monto_por_pagar', $monto_diferencia);
                                
                        }


                    }

                    $pagados->status = 'AP';
                    $pagados->save();


                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Transferencia realizada satisfactoriamente.' . ' montos diferencia: ' . $monto_diferencia .'  Monto transferencia ' . $monto_transferencia . ' total a pagar: ' . $total_a_pagar);
 
                    } else { //Sino son igual se van abonando por partes
                    $transferencia = Transferencia::create($request->all());

                    //Inicio de codigo aumento pagado
                    //Aumentar el monto en pagado que viene de la transferencia
                    $pagados =Pagado::find($request->pagado_id);
                    $pagados->increment('montopagado', $request->montotransferencia);

                    //Descontar el saldo de la cuenta bancaria el monto transferido
                    $cuenta_bancaria->decrement('montosaldo',$request->montotransferencia);

                    //Obtener el detalle pagado
                    $monto_transferencia = $request->montotransferencia;
                    $detalles_pagado = Detallepagado::where('pagado_id', $request->pagado_id)->get();

                    foreach($detalles_pagado as $rows){
                        $montopagado = $rows->montopagado;
                        $montoabonado = $rows->montoabonado;
                        $monto_diferencia = $montopagado - $montoabonado;

                        if($monto_diferencia!=0){ 
                            if($monto_transferencia>=$monto_diferencia){
                                //Agregar el monto de la transferencia al abano de detalle pagado
                                $det_pagado = Detallepagado::find($rows->id);
                                $det_pagado->increment('montoabonado', $monto_diferencia);
                                //modificar la ejecucion correspondiente
                                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                                $ejecucion->increment('monto_pagado', $monto_diferencia);
                                $ejecucion->decrement('monto_por_pagar', $monto_diferencia);

                                $monto_transferencia -= $monto_diferencia;

                            }else{
                                $det_pagado = Detallepagado::find($rows->id);
                                $det_pagado->increment('montoabonado', $monto_transferencia);
                                //Modificar la ejecucion correspondiente
                                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                                $ejecucion->increment('monto_pagado', $monto_transferencia);
                                $ejecucion->decrement('monto_por_pagar', $monto_transferencia);

                                $monto_transferencia -= $monto_transferencia;

                            }
                        }

                    }

                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Transferencia realizada satisfactoriamente.'  . 'Montos diferencia: ' . $monto_diferencia .'  Monto transferencia ' . $monto_transferencia . ' total a pagar: ' . $total_a_pagar);
                    }
                    
                }else{
                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Error: El numero de referencia bancaria ya esta registrada en el sistema: ' . $request->referenciabancaria);
               
                }

            }else{
                return redirect()->route('pagados.procesados')
                ->with('success', 'Error: El monto a transferir: '. number_format($monto_transferencia, 2,',','.')  .' supera el monto total a pagar: ' . number_format($total_a_pagar, 2,',','.') );
           
            }

        } else {
            return redirect()->route('pagados.procesados')
            ->with('success', 'Error: El monto a transferir: '. number_format($monto_transferencia, 2,',','.') .' supera el saldo de la cuenta bancaria: ' . number_format($saldo, 2,',','.') );
        }


       

    }


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        request()->validate(Transferencia::$rules);

        $max_correlativo = DB::table('transferencias')->max('egreso');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['egreso'=>$numero_correlativo]);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        
        //Antes de hacer la transferencia validar que haya plata en la cuenta de la cual se va a debitar
        $cuenta_bancaria = Cuentasbancaria::find($request->cuentasbancaria_id);
        $pagado = Pagado::find($request->pagado_id);

        //Obtengo el monto de la orden y el monto que va pagado
        $monto_orden_pago = $pagado->montoordenpago;
        $monto_pagado = $pagado->montopagado;
        $total_a_pagar = $monto_orden_pago - $monto_pagado;

        $saldo = $cuenta_bancaria->montosaldo;
        $monto_transferencia = $request->montotransferencia;

        $validar_transferencia = Transferencia::where('cuentasbancaria_id', $request->cuentasbancaria_id)->where('referenciabancaria',$request->referenciabancaria)->exists();
       
        //MOstrar los valores

        if($monto_transferencia < $saldo || bccomp($monto_transferencia, $saldo, 2)==0){ //que la cuenta tenga saldo

            if($monto_transferencia < $total_a_pagar || bccomp($monto_transferencia, $total_a_pagar, 2)==0){ //que el monto de la trasnferencia no sea mayor a lo que se debe pagar

                if($validar_transferencia != TRUE){ //Validar que el numero de referencia no se repita

                    if(bccomp($monto_transferencia, $total_a_pagar, 2)==0){
                        //Cuando sea igual al monto a pagar entonces se paga completo los detalles y se
                        //modifica la ejecucion presupuestaria completa

                    //Cuando el monto sea igual al total a pagar, pagarlo y cambiar el estatus a AP
                    $transferencia = Transferencia::create($request->all());

                    //Inicio de codigo aumento pagado
                    //Aumentar el monto en pagado que viene de la transferencia
                    $pagados = Pagado::find($request->pagado_id);
                    $pagados->increment('montopagado', $request->montotransferencia);

                    //Descontar el saldo de la cuenta bancaria el monto transferido
                    $cuenta_bancaria->decrement('montosaldo',$request->montotransferencia);

                    //
                    $detalles_pagado = Detallepagado::where('pagado_id', $request->pagado_id)->get();

                    foreach($detalles_pagado as $rows){

                        $montopagado = $rows->montopagado;
                        $montoabonado = $rows->montoabonado;
                        $monto_diferencia = $montopagado - $montoabonado;

                        if($monto_diferencia!=0){ 

                                //Agregar el monto de la transferencia al abano de detalle pagado
                                $det_pagado = Detallepagado::find($rows->id);
                                $det_pagado->increment('montoabonado', $monto_diferencia);
                                //Modificar la ejecucion y colocar pagado en la ejecucion correspondiente
                                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                                $ejecucion->increment('monto_pagado', $monto_diferencia);
                                $ejecucion->decrement('monto_por_pagar', $monto_diferencia);
                                
                        }


                    }

                    $pagados->status = 'AP';
                    $pagados->save();

/*
                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Transferencia realizada satisfactoriamente.' . ' montos diferencia: ' . $monto_diferencia .'  Monto transferencia ' . $monto_transferencia . ' total a pagar: ' . $total_a_pagar);
 */

                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Transferencia realizada satisfactoriamente.' . ' Numero De Egreso: ' .  $numero_correlativo);
 
                    } else { //Sino son igual se van abonando por partes
                    $transferencia = Transferencia::create($request->all());

                    //Inicio de codigo aumento pagado
                    //Aumentar el monto en pagado que viene de la transferencia
                    $pagados =Pagado::find($request->pagado_id);
                    $pagados->increment('montopagado', $request->montotransferencia);

                    //Descontar el saldo de la cuenta bancaria el monto transferido
                    $cuenta_bancaria->decrement('montosaldo',$request->montotransferencia);

                    //Obtener el detalle pagado
                    $monto_transferencia = $request->montotransferencia;
                    $detalles_pagado = Detallepagado::where('pagado_id', $request->pagado_id)->get();

                    foreach($detalles_pagado as $rows){
                        $montopagado = $rows->montopagado;
                        $montoabonado = $rows->montoabonado;
                        $monto_diferencia = $montopagado - $montoabonado;

                        if($monto_diferencia!=0){ 
                            if($monto_transferencia>$monto_diferencia || bccomp($monto_transferencia, $monto_diferencia, 2)==0){
                                //Agregar el monto de la transferencia al abano de detalle pagado
                                $det_pagado = Detallepagado::find($rows->id);
                                $det_pagado->increment('montoabonado', $monto_diferencia);
                                //modificar la ejecucion correspondiente
                                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                                $ejecucion->increment('monto_pagado', $monto_diferencia);
                                $ejecucion->decrement('monto_por_pagar', $monto_diferencia);

                                $monto_transferencia -= $monto_diferencia;

                            }else{
                                $det_pagado = Detallepagado::find($rows->id);
                                $det_pagado->increment('montoabonado', $monto_transferencia);
                                //Modificar la ejecucion correspondiente
                                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                                $ejecucion->increment('monto_pagado', $monto_transferencia);
                                $ejecucion->decrement('monto_por_pagar', $monto_transferencia);

                                $monto_transferencia -= $monto_transferencia;

                            }
                        }

                    }



/*
                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Transferencia realizada satisfactoriamente.'  . 'Montos diferencia: ' . $monto_diferencia .'  Monto transferencia ' . $monto_transferencia . ' total a pagar: ' . $total_a_pagar);
                    */
                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Transferencia realizada satisfactoriamente.' . ' Numero De Egreso: ' .  $numero_correlativo);
                
                }
                    
                    

                }else{
                    return redirect()->route('pagados.procesados')
                    ->with('success', 'Error: El numero de referencia bancaria ya esta registrada en el sistema: ' . $request->referenciabancaria);
               
                }

              

            }else{
                return redirect()->route('pagados.procesados')
                ->with('success', 'Error: El monto a transferir: '. number_format($monto_transferencia, 2,',','.')  .' supera el monto total a pagar: ' . number_format($total_a_pagar, 2,',','.') );
           
            }

        } else {
            return redirect()->route('pagados.procesados')
            ->with('success', 'Error: El monto a transferir: '. number_format($monto_transferencia, 2,',','.') .' supera el saldo de la cuenta bancaria: ' . number_format($saldo, 2,',','.') );
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
        $transferencia = Transferencia::find($id);

        return view('transferencia.show', compact('transferencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transferencia = Transferencia::find($id);

        return view('transferencia.edit', compact('transferencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Transferencia $transferencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transferencia $transferencia)
    {
        request()->validate(Transferencia::$rules);

        $transferencia->update($request->all());

        return redirect()->route('transferencias.index')
            ->with('success', 'Transferencia updated successfully');
    }

    /**
     * Se utilizara para reversar la opcion de la transferencia que fue creada
     */
    public function destroy($id)
    {
        //$transferencia = Transferencia::find($id)->delete();
        $transferencia = Transferencia::find($id);
        //Obtener el numero de pagado
        

        return redirect()->route('transferencias.index')
            ->with('success', 'Transferencia deleted successfully');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyold($id)
    {
        $transferencia = Transferencia::find($id)->delete();

        return redirect()->route('transferencias.index')
            ->with('success', 'Transferencia deleted successfully');
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar()
    {
        $transferencia = Transferencia::where('status', 'PR')->paginate();

        
        return view('transferencia.agregar', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $transferencias->perPage());
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregartransferencia($id)
    {
        $pagado_id = $id;
        $transferencia = new Transferencia();

       $pagados = Pagado::find($pagado_id);
       $cuentasbancarias = Cuentasbancaria::pluck('cuenta', 'id');

       return view('pagado.agregartransferencia', compact('transferencia','pagados','cuentasbancarias'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function miagregar()
    {
        $pagados = Pagado::where('status', 'PR')->paginate();

        return view('transferencia.miagregar', compact('pagados'))
            ->with('i', (request()->input('page', 1) - 1) * $pagados->perPage());
    }

         /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function seleccionarpagado($id)
    {
        $pagado_id = $id;
        $pagados = Pagado::find($id);

        $cuentasbancarias =Cuentasbancaria::pluck('cuenta', 'id');
        $bancos =Banco::pluck('denominacion', 'id');
        $ordenpagos =Ordenpago::pluck('montoneto', 'id');
        
        $transferencia = new Transferencia();
        return view('transferencia.create', compact('transferencia','pagados', 'cuentasbancarias', 'bancos', 'ordenpagos'));
    }

    public function pdf($id)
     {
        // $compromiso = Compromiso::find($id);
        // $pagado = Pagado::find($id);
        $transferencias = Transferencia::find($id);
        $total_transferencia = $transferencias->montotransferencia;
        //Cambiar el total de numeros a letras
        $formatter = new NumeroALetras();
        $total_letras = $formatter->toMoney($total_transferencia , 2, 'BOLIVARES', 'CTS');

        $pdf = PDF::loadView('transferencia.pdf', ['total_letras'=> $total_letras, 'transferencias'=> $transferencias, 'total_transferencia'=> $total_transferencia]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();
 
     }

     public function reversar($id)
     {
        // transferencia
        $transferencias = Transferencia::find($id);
        // 
        $fecha = Carbon::now();
        // Obtener el nombre del usuario que esta reversando la transferencia
        $nombre_usuario = Auth::user()->name;

        $pagado_id = $transferencias->pagado_id;

        $concepto_reverso = 'Se ha reversado la transferencia por un Monto De: ' . $transferencias->montotransferencia . ' Accion realizada por: ' . $nombre_usuario . ' ID Pagado: ' .$pagado_id . ' Numero de Referencia: ' . $transferencias->referenciabancaria;

        //El monto de la transferencia debe ser cero, y la referencia bancaria tambien debe ser cero

        //Disminuir de Pagado el monto pagado que corresponde al monto de la transferencia que se esta reversando
        $pagado = Pagado::find($pagado_id);
        $pagado->decrement('montopagado',$transferencias->montotransferencia);

        //Aumentar el monto en la cuenta bancaria
        

        //Disminuir de la tabla detalle pagado el monto de la transferencia
       //Obtener el detalle pagado
       $monto_transferencia = $transferencias->montotransferencia;
       $detalles_pagado = Detallepagado::where('pagado_id', $pagado->id)->get();

       foreach($detalles_pagado as $rows){
           
           $montoabonado = $rows->montoabonado;

          // return redirect()->route('transferencias.index')->with('success', 'Mensaje: Entro en el foreach Monto Abonado: ' . $montoabonado . ' Monto de la transferencia: ' . $monto_transferencia);
   
           
               if($monto_transferencia>=$montoabonado){
                   //Agregar el monto de la transferencia al abano de detalle pagado
                   $det_pagado = Detallepagado::find($rows->id);
                   $det_pagado->decrement('montoabonado', $montoabonado);
                   //modificar la ejecucion correspondiente
                   $ejecucion = Ejecucione::find($rows->ejecucion_id);
                   $ejecucion->decrement('monto_pagado', $montoabonado);
                   $ejecucion->increment('monto_por_pagar', $montoabonado);

                   $monto_transferencia -= $montoabonado;

               }else{
                   $det_pagado = Detallepagado::find($rows->id);
                   $det_pagado->decrement('montoabonado', $monto_transferencia);
                   //Modificar la ejecucion correspondiente
                   $ejecucion = Ejecucione::find($rows->ejecucion_id);
                   $ejecucion->decrement('monto_pagado', $monto_transferencia);
                   $ejecucion->increment('monto_por_pagar', $monto_transferencia);

                   $monto_transferencia -= $monto_transferencia;

               }
           

       }

       $pagado->status = 'PR';
       $pagado->save();

       $cuenta_bancaria = Cuentasbancaria::find($transferencias->cuentasbancaria_id);
       $cuenta_bancaria->increment('montosaldo',$transferencias->montotransferencia);
       //Editar el pagado
       $datos_editar = [
        'montotransferencia' => 0,
        'fechaanulacion' => $fecha,
        'referenciabancaria' => '0',
        'conceptoanulacion'=>$concepto_reverso,
       ];

       $transferencias->update($datos_editar);

        return redirect()->route('transferencias.index')->with('success', 'Mensaje: ' . $concepto_reverso);
   
     }


     public function reportes()
     {
        
         $bancos = Banco::pluck('denominacion' , 'id');
 
         $cuentas = Cuentasbancaria::pluck('cuenta', 'id');
 
         $usuarios = User::pluck('name' , 'id'); 
 
         $fecha_actual = Carbon::now();
       
 
         return view('transferencia.reportes', compact('cuentas','bancos','fecha_actual','usuarios'));
 
             
     }
 
     public function reporte_pdf(Request $request)
     {   
         //Buscar por rif
         $rif = $request->rif;
         //Obtener Beneficiario
         $beneficiario_id = false;
         $nombre_beneficiario = '';
         $rs_beneficiario = Beneficiario::where('rif', $rif)->first();
         if($rs_beneficiario){
             $beneficiario_id = $rs_beneficiario->id;
             $nombre_beneficiario = $rs_beneficiario->nombre;
         }
 
         //Buscar por 
         $banco = $request->banco;
         $cuenta = $request->cuenta;
         
         
         $usuario = $request->usuario_id;
         $inicio = $request->fecha_inicio;
         $fin = $request->fecha_fin;
         
         $nombre_usuario = '';
         $rs_usuario = User::find($usuario);
         if($rs_usuario){
             $nombre_usuario = $rs_usuario->name;
         }
 
         $nombre_banco = '';
         $rs_banco= Banco::find($banco);
         if($rs_banco){
             $nombre_banco = $rs_banco->denominacion;
         }
 
         $nombre_cuenta = '';
         $rs_cuenta= Cuentasbancaria::find($cuenta);
         if($rs_cuenta){
             $nombre_cuenta = $rs_cuenta->cuenta;
         }
 
         
 
 
         //
         
         $transferencias = Transferencia::bancos($banco)->cuentas($cuenta)->beneficiarios($beneficiario_id)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        
         $total_transferencias = $transferencias->sum('montotransferencia');
         $total_ordenpago = $transferencias->sum('montoorden');
         $total_pagado = 0;
         foreach($transferencias as $transferencia){
            $total_pagado += $transferencia->pagado->montopagado;
         } 
 
         $datos = [
             'inicio' => $inicio,
             'fin' => $fin,  
             'usuario' =>$nombre_usuario,  
             'nombre_banco' => $nombre_banco,
             'nombre_cuenta' => $nombre_cuenta,
             'nombre_beneficiario' => $nombre_beneficiario,
             'total_transferencias' => $total_transferencias,
             'total_ordenpago' => $total_ordenpago,
             'total_pagado' => $total_pagado
             ]; 
 
         $pdf = PDF::setPaper('letter', 'landscape')->loadView('transferencia.reportepdf', ['datos'=>$datos, 'transferencias'=>$transferencias]);
         return $pdf->stream();
          
     }

}
