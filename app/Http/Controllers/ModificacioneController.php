<?php

namespace App\Http\Controllers;

use App\Modificacione;
use App\Tipomodificacione;
use App\Detallesmodificacione;
use App\Ejecucione;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class ModificacioneController
 * @package App\Http\Controllers
 */
class ModificacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.modificacionpresupuestaria')->only('index', 'edit', 'update', 'create', 'store', 'pdf', 'indexprocesadas', 'indexanuladas');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $modificaciones = Modificacione::where('status', 'EP')->paginate();
        $modificaciones = Modificacione::query()
       ->when(request('search'), function($query){
           return $query->where ('descripcion', 'like', '%'.request('search').'%')
                            ->where('status', 'like', 'EP')
                            ->orWhere ('ncredito', 'like', '%'.request('search').'%')
                             ->where('status', 'like', 'EP')
                        ->orWhereHas('tipomodificacione', function($q){
                         $q->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'EP');
        },
        function ($query) {
            $query->where('status', 'like', 'EP')
            ->orderBy('id', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('modificacione.index', compact('modificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $modificaciones->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
       // $modificaciones = Modificacione::where('status', 'PR')->paginate();
        $modificaciones = Modificacione::query()
        ->when(request('search'), function($query){
            return $query->where ('descripcion', 'like', '%'.request('search').'%')
                             ->where('status', 'like', 'PR')
                             ->orWhere ('ncredito', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'PR')
                         ->orWhereHas('tipomodificacione', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                          ->where('status', 'like', 'PR');
         },
         function ($query) {
             $query->where('status', 'like', 'PR')
             ->orderBy('id', 'DESC');
         })
         ->paginate(25)
       ->withQueryString();

        return view('modificacione.procesadas', compact('modificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $modificaciones->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
       // $modificaciones = Modificacione::where('status', 'AN')->paginate();

        $modificaciones = Modificacione::query()
        ->when(request('search'), function($query){
            return $query->where ('descripcion', 'like', '%'.request('search').'%')
                             ->where('status', 'like', 'AN')
                             ->orWhere ('ncredito', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'AN')
                         ->orWhereHas('tipomodificacione', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                          ->where('status', 'like', 'AN');
         },
         function ($query) {
             $query->where('status', 'like', 'AN')
             ->orderBy('id', 'DESC');
         })
         ->paginate(25)
       ->withQueryString();

        return view('modificacione.anuladas', compact('modificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $modificaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modificacione = new Modificacione();
        $tipomodificaciones = Tipomodificacione::pluck('nombre','id');

        return view('modificacione.create', compact('modificacione', 'tipomodificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Modificacione::$rules);

        //Tomar el numero de modificacion y aumentarlo a uno para registrar dicho valor
        $max_correlativo = DB::table('modificaciones')->max('numero');
        $numero_correlativo = $max_correlativo + 1;
        $request->merge(['numero'=>$numero_correlativo]);
        $request->merge(['status'=>'EP']);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);



        $modificacione = Modificacione::create($request->all());

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacion exitosa.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modificacione = Modificacione::find($id);

        return view('modificacione.show', compact('modificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modificacione = Modificacione::find($id);
        $tipomodificaciones = Tipomodificacione::pluck('nombre','id');

        return view('modificacione.edit', compact('modificacione', 'tipomodificaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modificacione $modificacione)
    {
        request()->validate(Modificacione::$rules);

        $modificacione->update($request->all());

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacion actualizada');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modificacione = Modificacione::find($id)->delete();

        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacione Eliminada');
    }

      /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregarmodificacion($id)
    {   session(['modificacion' => $id]);
        $modificacione = Modificacione::find($id);
        $detallesmodificaciones = Detallesmodificacione::where('modificacion_id', $id)->paginate();

//return view('modificacione.agregarmodificacion', compact('modificacione', 'detallesmodificaciones'));
        return view('modificacione.agregarmodificacion', compact('modificacione', 'detallesmodificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesmodificaciones->perPage());
    }

        //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $modificacion = Modificacione::find($id);
       
        $aprobado = 1;
        $procesar = 0;
        $partida ='';

        //Obtener todos los detalles de las modificaciones
        $detallesmodificaciones = Detallesmodificacione::where('modificacion_id', $id)->get();

        //Obtener el monto total de la modificacion y compararlo con la suma del detalle modificacion
        //hacerlo tanto para el monto que acredita como para el monto debita
        $total_acredita = 0;
        $total_debita = 0;
        $total_detalle_credita = 0;
        $total_detalle_debita = 0;
        $total_acredita = $modificacion->montocredita;
        $total_debita = $modificacion->montodebita;
        $total_detalle_credita = $detallesmodificaciones->sum('montoacredita');
        $total_detalle_debita = $detallesmodificaciones->sum('montodebita');


        if(bccomp($total_acredita, $total_detalle_credita, 2)!=0){
            return redirect()->route('modificaciones.index')
            ->with('success', 'No Aprobado. Ya que el monto a acreditar es diferente al monto colocado por usted cuando creo la modificacion, para intentarlo nuevamente primero entre en agregar detalles y edite para que el monto sea igual al establecido por usted.');
        }
        elseif(bccomp($total_debita, $total_detalle_debita, 2)!=0){
            return redirect()->route('modificaciones.index')
            ->with('success', 'No Aprobado. Ya que el monto a debitar es diferente al monto colocado por usted cuando creo la modificacion, para intentarlo nuevamente primero entre en agregar detalles y edite para que el monto sea igual al establecido por usted.');
       
        }else {


        if($detallesmodificaciones->count()>0){

            //comprobar la disponibilidad
            foreach($detallesmodificaciones as $rows){
                //Validar que si es null agregar cero a esa variable, ese campo puede venir null
                $montoacredita=0;
                $montodebita=0;
               
                if($rows->montodebita != NULL)
                {
                    $montodebita = $rows->montodebita;  
                }
    
                //Afectar las variables que decrementan
                $ejecucion = Ejecucione::find($rows->ejecucion_id);
                $disponibilidad = $ejecucion->monto_por_comprometer;
                if($montodebita < $disponibilidad || bccomp($montodebita, $disponibilidad, 2)==0){
                  
                }else{
                    $partida .= $ejecucion->clasificadorpresupuestario . ' - ';
                    $aprobado = 2;
                }
    
    
            }

            if($aprobado == 1){
        //Ciclo para recorrer todos los detalles e ir modificando la ejecucion presupuestaria
        foreach($detallesmodificaciones as $rows){
            //Validar que si es null agregar cero a esa variable, ese campo puede venir null
            $montoacredita=0;
            $montodebita=0;
            if($rows->montoacredita != NULL)
            {
                $montoacredita = $rows->montoacredita;  
            }
            if($rows->montodebita != NULL)
            {
                $montodebita = $rows->montodebita;  
            }

            //Obtener la ejecucion que voy a modificar
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //Afectar las variables que se incrementarian
            $ejecucion->increment('monto_aumento', $montoacredita);
            $ejecucion->increment('monto_actualizado', $montoacredita);
            $ejecucion->increment('monto_por_comprometer', $montoacredita);

            //Afectar las variables que decrementan
            $ejecucion->increment('monto_disminuye', $montodebita);
            $ejecucion->decrement('monto_actualizado', $montodebita);
            $ejecucion->decrement('monto_por_comprometer', $montodebita);
            
        }
    }


        

        if($aprobado == 1){

            $modificacion->status = 'PR'; //colocar al finalizar las pruebas en PR
            $modificacion->save();

            return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacion Aprobada Exitosamente. ');
        }else{
            return redirect()->route('modificaciones.index')
            ->with('success', 'No Aprobado. No se ha podido hacer el ajuste, puede ser que no tenga la disponibilidad suficiente en la partida ' . $partida);
        }

    }else {
        return redirect()->route('modificaciones.index')
            ->with('success', 'No Aprobado. No tiene ningun detalle agregado a este credito');
    }

        }


    }

     /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $modificacion = Modificacione::find($id);
        $modificacion->status = 'AN'; //colocar al finalizar las pruebas en PR
        $modificacion->save();


        return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacion Anulada exitosamente.');

            
    }

    /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        
        session(['modificacion' => $id]);
        $modificacione = Modificacione::find($id);
        $detallesmodificaciones = Detallesmodificacione::where('modificacion_id', $id)->paginate();


        $pdf = PDF::loadView('modificacione.pdf', ['modificacione'=>$modificacione, 'detallesmodificaciones'=>$detallesmodificaciones]);
        return $pdf->stream();

    }


            //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function reversar($id)
    {
        $modificacion = Modificacione::find($id);
        

        //Obtener todos los detalles de las modificaciones
        $detallesmodificaciones = Detallesmodificacione::where('modificacion_id', $id)->get();

        //Ciclo para recorrer todos los detalles e ir modificando la ejecucion presupuestaria
        foreach($detallesmodificaciones as $rows){
            //Validar que si es null agregar cero a esa variable, ese campo puede venir null
            $montoacredita=0;
            $montodebita=0;
            if($rows->montoacredita != NULL)
            {
                $montoacredita = $rows->montoacredita;  
            }
            if($rows->montodebita != NULL)
            {
                $montodebita = $rows->montodebita;  
            }


            //Obtener la ejecucion que voy a modificar
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            //Afectar las variables que se incrementarian
            $ejecucion->decrement('monto_aumento', $montoacredita);
            $ejecucion->decrement('monto_actualizado', $montoacredita);
            $ejecucion->decrement('monto_por_comprometer', $montoacredita);

            //Afectar las variables que decrementan
            $ejecucion->decrement('monto_disminuye', $montodebita);
            $ejecucion->increment('monto_actualizado', $montodebita);
            $ejecucion->increment('monto_por_comprometer', $montodebita);
        }

        $modificacion->status = 'EP'; //colocar al finalizar las pruebas en PR
        $modificacion->save();

            return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacion Reversada Exitosamente. ');
      

    }


    public function reportes()
    {
        $tiposmodificaciones = Tipomodificacione::pluck('nombre' , 'id'); 

        $usuarios = User::pluck('name' , 'id'); 
      
        return view('modificacione.reportes', compact('usuarios','tiposmodificaciones'));
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $tipo = $request->tipo;
        $descripcion = $request->descripcion;
        
        $nombre_tipo = '';
        $rs_tipo = Tipomodificacione::find($tipo);
        if($rs_tipo)
        {
            $nombre_tipo = $rs_tipo->nombre;
        }
        
        $estatus = $request->estatus;
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
        
        $modificaciones = Modificacione::tipos($tipo)->descripcion($descripcion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $aprobadas = Modificacione::where('status', 'AP')->tipos($tipo)->descripcion($descripcion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $procesadas = Modificacione::where('status', 'PR')->tipos($tipo)->descripcion($descripcion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $enproceso = Modificacione::where('status', 'EP')->tipos($tipo)->descripcion($descripcion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $anuladas = Modificacione::where('status', 'AN')->tipos($tipo)->descripcion($descripcion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $total = count($modificaciones);
        $credito = $modificaciones->sum('montocredita');
        $debito = $modificaciones->sum('montodebita');
       
        $datos = [
           // 'institucion' => $request->institucion_id,
           'credito' => $credito,
           'debito' => $debito,
           'descripcion' => $descripcion,
           
           'aprobadas' => $aprobadas,
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
           
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('modificacione.reportepdf', ['datos'=>$datos, 'modificaciones'=>$modificaciones]);
        return $pdf->stream();
         
    }

}
