<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;

use App\Ajustescompromiso;
use App\Compromiso;
use App\Detallescompromiso;
use App\Detallesajuste;
use App\Ejecucione;
use PDF;
//use App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

/**
 * Class AjustescompromisoController
 * @package App\Http\Controllers
 */
class AjustescompromisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.ajustecompromiso')->only('index', 'edit', 'update', 'pdf', 'create', 'store', 'indexanuladas', 'indexprocesadas');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $ajustescompromisos = Ajustescompromiso::where('status', 'EP')->paginate();

        $ajustescompromisos = Ajustescompromiso::query()
        ->when(request('search'), function($query){
            return $query->where ('documento', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'EP')
                              ->orWhere ('concepto', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'EP')
                              ->orWhereHas('compromiso', function($q){
                                $q->where('ncompromiso', 'like', '%'.request('search').'%');
                                })
                                ->where('status', 'like', 'EP');

         },
         function ($query) {
             $query->where('status', 'like', 'EP')
             ->orderBy('id', 'ASC');
         })
        ->paginate(20)
        ->withQueryString();
        

        return view('ajustescompromiso.index', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
        // $ajustescompromisos = Ajustescompromiso::where('status', 'PR')->paginate();
        $ajustescompromisos = Ajustescompromiso::query()
        ->when(request('search'), function($query){
            return $query->where ('documento', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'PR')
                              ->orWhere ('concepto', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'PR')
                              ->orWhereHas('compromiso', function($q){
                                $q->where('ncompromiso', 'like', '%'.request('search').'%');
                                })
                                ->where('status', 'like', 'PR');

         },
         function ($query) {
             $query->where('status', 'like', 'PR')
             ->orderBy('id', 'DESC');
         })
        ->paginate(20)
        ->withQueryString();
        

        return view('ajustescompromiso.procesadas', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
     //   $ajustescompromisos = Ajustescompromiso::where('status', 'AN')->paginate();

     $ajustescompromisos = Ajustescompromiso::query()
     ->when(request('search'), function($query){
         return $query->where ('documento', 'like', '%'.request('search').'%')
                           ->where('status', 'like', 'AN')
                           ->orWhere ('concepto', 'like', '%'.request('search').'%')
                           ->where('status', 'like', 'AN')
                           ->orWhereHas('compromiso', function($q){
                             $q->where('ncompromiso', 'like', '%'.request('search').'%');
                             })
                             ->where('status', 'like', 'AN');

      },
      function ($query) {
          $query->where('status', 'like', 'AN')
          ->orderBy('id', 'DESC');
      })
     ->paginate(20)
     ->withQueryString();
        

        return view('ajustescompromiso.anuladas', compact('ajustescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $ajustescompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregar()
    {
       // $compromisos = Compromiso::where('status', 'PR')->paginate();

        $compromisos = Compromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('ncompromiso', 'like', '%'.request('search').'%')
                       
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        });
        },
        function ($query) {
            $query->orderBy('id', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('ajustescompromiso.agregar', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    public function agregarold()
    {
       // $compromisos = Compromiso::where('status', 'PR')->paginate();

        $compromisos = Compromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('ncompromiso', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'PR')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'PR')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'PR');
        },
        function ($query) {
            $query->where('status', 'like', 'PR')
            ->orderBy('id', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('ajustescompromiso.agregar', compact('compromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $compromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ajustescompromiso = new Ajustescompromiso();
        return view('ajustescompromiso.create', compact('ajustescompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        request()->validate(Ajustescompromiso::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $ajustescompromiso = Ajustescompromiso::create($request->all());
        //Obtener el ultimo ID
        $ultimo = Ajustescompromiso::latest('id')->first();
        $ajuste_id = $ultimo->id;

        $compromiso_id = $request->compromiso_id;
        //Obtener el detalle compromiso
        $detalles_compromisos = Detallescompromiso::where('compromiso_id', $compromiso_id)->get();

        foreach($detalles_compromisos as $rows){
            
            $insertar_datos = [
                'montoajuste'=>0,
                'ajustes_id'=>$ajuste_id,
                'unidadadministrativa_id'=>$rows->unidadadministrativa_id,
                'ejecucion_id'=> $rows->ejecucion_id

            ];

            $detallesajustes = Detallesajuste::create($insertar_datos);

        }




        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustes de compromiso creado.');

            
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id);

        //return view('ajustescompromiso.show', compact('ajustescompromiso'));

        $detallesajustes = Detallesajuste::where('ajustes_id', $id)->paginate();

        //Creo mi variable de sesion para guardar el id del ajuste del compromiso
        session(['ajustecompromiso' => $id]);

        return view('ajustescompromiso.show', compact('detallesajustes', 'ajustescompromiso'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesajustes->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id);

        $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);

        return view('ajustescompromiso.edit', compact('ajustescompromiso', 'compromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ajustescompromiso $ajustescompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajustescompromiso $ajustescompromiso)
    {
        request()->validate(Ajustescompromiso::$rules);

        $ajustescompromiso->update($request->all());

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustes compromiso editado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ajustescompromiso = Ajustescompromiso::find($id)->delete();

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajustescompromiso deleted successfully');
    }


      /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarcompromiso($id)
    {
        $compromiso_id = $id;
        $compromiso = Compromiso::find($compromiso_id);
        
        $ajustescompromiso = new Ajustescompromiso();
        return view('ajustescompromiso.create', compact('ajustescompromiso' , 'compromiso'));
       
        
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
        //Variable para guardar el monto total del ajuste
        $totalajustar = 0;

        //Obtener los datos de la tabla ajustescompromisos
        $ajustescompromiso = Ajustescompromiso::find($id);

        

        //Obtener los datos del ajuste del compromiso
        $detallesajustes = Detallesajuste::where('ajustes_id', $ajustescompromiso->id)->get();



        //Antes de continuar validar que el monto del ajuste sea igual al monto del detalle ajuste
        //En caso contrario generar un error
        $to_ajuste =  $ajustescompromiso->montoajuste;
        $to_det_ajuste = $detallesajustes->sum('montoajuste');

        if(bccomp($to_ajuste, $to_det_ajuste, 2)==0)
        { 
            //Consultar que tipo de ajuste es, si es 1 q es aumento, consultar primero disponibilidad
        //Si es 2 que es disminucion proceder a hacer el ajuste.
        if($ajustescompromiso->tipo==1){
            //Chequeo si hay disponibilidad en las partidas
            foreach($detallesajustes as $rows){
                //Obtener la ejecucion 
                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                //Hacer el if
                    if($rows->montoajuste > $ejecucion->monto_por_comprometer){
                     $aprobado = 0;
                    }
                }

                //Una vez chequeado la disponibilidad se procede a modificar la ejecucion
                if($aprobado == 1){
                    $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);
                    //Ciclo para imputar
                    foreach($detallesajustes as $rows){
                        //Obtener la ejecucion 
                            $ejecucion = Ejecucione::find($rows->ejecucion_id);
                            $ejecucion->increment('monto_comprometido', $rows->montoajuste);
                            $ejecucion->decrement('monto_por_comprometer', $rows->montoajuste);
                           // $ejecucion->decrement('monto_precomprometido', $rows->montoajuste);

                            //Obtener el detalle compromiso para incrementarle el valor que viene obteniendo
                            $detallescompromisos = Detallescompromiso::where('compromiso_id',$compromiso->id)->where('ejecucion_id',$rows->ejecucion_id)->first();
                            $detallescompromisos->increment('montocompromiso', $rows->montoajuste);
                         }
                         $totalajustar = $detallesajustes->sum('montoajuste');
                         //Sumarle el valor al monto del compromiso primero obtener el compromiso
                         
                         $compromiso->increment('montocompromiso', $totalajustar);

                         //y actualizar el  valor de la tabla ajuste compromiso
                        // $ajustescompromiso->montoajuste =  $totalajustar;
                         $ajustescompromiso->status =  'PR';
                         $ajustescompromiso->save();


                         
                     }


        }else{

            $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);
            //Ciclo para imputar
            foreach($detallesajustes as $rows){
                //Obtener la ejecucion 
                    $ejecucion = Ejecucione::find($rows->ejecucion_id);
                    $ejecucion->decrement('monto_comprometido', $rows->montoajuste);
                    $ejecucion->increment('monto_por_comprometer', $rows->montoajuste);
                  //  $ejecucion->increment('monto_precomprometido', $rows->montoajuste);

                    //Obtener el detalle compromiso para incrementarle el valor que viene obteniendo
                    $detallescompromisos = Detallescompromiso::where('compromiso_id',$compromiso->id)->where('ejecucion_id',$rows->ejecucion_id)->first();
                    $detallescompromisos->decrement('montocompromiso', $rows->montoajuste);
                 }
                 $totalajustar = $detallesajustes->sum('montoajuste');
                 //restarle el valor al monto del compromiso primero obtener el compromiso
                 
                 $compromiso->decrement('montocompromiso', $totalajustar);

                 //y actualizar el  valor de la tabla ajuste compromiso
             //    $ajustescompromiso->montoajuste =  $totalajustar;
                 $ajustescompromiso->status =  'PR';
                 $ajustescompromiso->save();

        }



        if($aprobado == 1){
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Compromiso Aprobado Exitosamente. ');
        }else{
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }


        }
        else{
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'No Aprobado. El monto del Ajuste no coincide con el detalle del ajuste del compromiso');
        
        }

    }

    public function reversar($id)
    {
        $aprobado = 1;
        //Variable para guardar el monto total del ajuste
        $totalajustar = 0;

        //Obtener los datos de la tabla ajustescompromisos
        $ajustescompromiso = Ajustescompromiso::find($id);

        //Obtener los datos del ajuste del compromiso
        $detallesajustes = Detallesajuste::where('ajustes_id', $ajustescompromiso->id)->get();

        //Consultar que tipo de ajuste es, si es 1 q es aumento, consultar primero disponibilidad
        //Si es 2 que es disminucion proceder a hacer el ajuste.
        if($ajustescompromiso->tipo==1){
            //Chequeo si hay disponibilidad en las partidas
            
               
                    $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);
                    //Ciclo para imputar
                    foreach($detallesajustes as $rows){
                        //Obtener la ejecucion 
                            $ejecucion = Ejecucione::find($rows->ejecucion_id);
                            $ejecucion->decrement('monto_comprometido', $rows->montoajuste);
                            $ejecucion->increment('monto_por_comprometer', $rows->montoajuste);
                            $ejecucion->increment('monto_precomprometido', $rows->montoajuste);

                            //Obtener el detalle compromiso para incrementarle el valor que viene obteniendo
                            $detallescompromisos = Detallescompromiso::where('compromiso_id',$compromiso->id)->where('ejecucion_id',$rows->ejecucion_id)->first();
                            $detallescompromisos->decrement('montocompromiso', $rows->montoajuste);
                         }
                         $totalajustar = $detallesajustes->sum('montoajuste');
                         //Sumarle el valor al monto del compromiso primero obtener el compromiso
                         
                         $compromiso->decrement('montocompromiso', $totalajustar);

                         //y actualizar el  valor de la tabla ajuste compromiso
                       //  $ajustescompromiso->montoajuste =  $totalajustar;
                         $ajustescompromiso->status =  'EP';
                         $ajustescompromiso->save();


                         
                     


        }else{

            $compromiso = Compromiso::find($ajustescompromiso->compromiso_id);
            //Ciclo para imputar
            foreach($detallesajustes as $rows){
                //Obtener la ejecucion 
                    $ejecucion = Ejecucione::find($rows->ejecucion_id);
                    $ejecucion->increment('monto_comprometido', $rows->montoajuste);
                    $ejecucion->decrement('monto_por_comprometer', $rows->montoajuste);
                    $ejecucion->decrement('monto_precomprometido', $rows->montoajuste);

                    //Obtener el detalle compromiso para incrementarle el valor que viene obteniendo
                    $detallescompromisos = Detallescompromiso::where('compromiso_id',$compromiso->id)->where('ejecucion_id',$rows->ejecucion_id)->first();
                    $detallescompromisos->increment('montocompromiso', $rows->montoajuste);
                 }
                 $totalajustar = $detallesajustes->sum('montoajuste');
                 //restarle el valor al monto del compromiso primero obtener el compromiso
                 
                 $compromiso->increment('montocompromiso', $totalajustar);

                 //y actualizar el  valor de la tabla ajuste compromiso
               //  $ajustescompromiso->montoajuste =  $totalajustar;
                 $ajustescompromiso->status =  'EP';
                 $ajustescompromiso->save();

        }





        if($aprobado == 1){
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Compromiso Aprobado Exitosamente. ');
        }else{
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

    }

    public function pdf($id)
    {
        
        $ajustescompromiso = Ajustescompromiso::find($id);

        $detallesajustes = Detallesajuste::where('ajustes_id', $id)->get();

        $total = $detallesajustes->sum('montoajuste');

        $pdf = PDF::loadView('ajustescompromiso.pdf', ['total'=>$total, 'ajustescompromiso'=>$ajustescompromiso,'detallesajustes'=>$detallesajustes]);
        $pdf->setPaper('letter', 'portrait');
         return $pdf->stream();

        
    }

    public function reportes()
    {
       
        $usuarios = User::orderBy('name', 'ASC')->pluck('name' , 'id'); 

        $fecha_actual = Carbon::now();
      

        return view('ajustescompromiso.reportes', compact('fecha_actual','usuarios'));

            
    }

    public function reporte_pdf(Request $request)
    {
      
        $tipos = $request->tipo;
        $nombre_tipo = '';
        if($tipos == 1)
        {
            $nombre_tipo = 'AUMENTAR';
        }elseif($tipos == 2){
            $nombre_tipo = 'DISMINUIR';
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

       

        


        //
        
        $ajustescompromisos = Ajustescompromiso::tipos($tipos)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $montoajuste = $ajustescompromisos->sum('montoajuste');
        $aprobadas = Ajustescompromiso::where('status', 'AP')->tipos($tipos)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $procesadas = Ajustescompromiso::where('status', 'PR')->tipos($tipos)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $enproceso = Ajustescompromiso::where('status', 'EP')->tipos($tipos)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $anuladas = Ajustescompromiso::where('status', 'AN')->tipos($tipos)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $total = Ajustescompromiso::tipos($tipos)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
       
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
            'tipo' => $nombre_tipo,
            'montoajuste' => $montoajuste,
              
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('ajustescompromiso.reportepdf', ['datos'=>$datos, 'ajustescompromisos'=>$ajustescompromisos]);
        return $pdf->stream();
        
         
    }


    public function anular($id)
    {
        $ajustecompromiso = Ajustescompromiso::find($id);

        if($ajustecompromiso->status == 'AN')
        {
            return redirect()->route('ajustescompromisos.index')
            ->with('success', 'El Ajuste Compromiso que esta intentando Anular, ya usted lo ha anulado previamente, evite dar muchos click en el boton anular. ');

        } else { 
        
        $ajustecompromiso->status = 'AN';
        $ajustecompromiso->save();

        return redirect()->route('ajustescompromisos.index')
            ->with('success', 'Ajuste de Compromiso Anulado exitosamente.');

        }

    }

}
