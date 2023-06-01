<?php

namespace App\Http\Controllers;

use App\Ejecucione;
use App\Ejercicio;
use App\Unidadadministrativa;
use App\Meta;
use App\Financiamiento;
use App\Poa;
use App\Detallescompromiso;
use App\Detalleordenpago;
use App\Detallepagado;
use App\Detallesmodificacione;
use App\Institucione;
use App\Configuracione;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

use App\Clasificadorpresupuestario;
use App\Models\User;



/**
 * Class EjecucioneController
 * @package App\Http\Controllers
 */
class EjecucioneController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.ejecuciones')->only('index', 'edit', 'update', 'create', 'store', 'pdf');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $config = Configuracione::where('nombre','institucion')->first();
        $institucion = $config->valor;
        

        $total_presupuestario = DB::table('ejecuciones')->sum('monto_inicial');
        $total_ajustado = DB::table('ejecuciones')->sum('monto_actualizado');
        $total_modificacion = $total_ajustado - $total_presupuestario;
        $total_comprometido = DB::table('ejecuciones')->sum('monto_comprometido');
        $total_causado = DB::table('ejecuciones')->sum('monto_causado');
        $total_pagado = DB::table('ejecuciones')->sum('monto_pagado');
        $total_disponible = $total_presupuestario - $total_comprometido;



        if($total_presupuestario != 0){
            $porc_comprometido = ( $total_comprometido * 100 ) / $total_presupuestario;
            $porc_causado = ( $total_causado * 100 ) / $total_presupuestario;
            $porc_pagado = ( $total_pagado * 100 ) / $total_presupuestario;
            $porc_disponible = ( $total_disponible * 100 ) / $total_presupuestario;
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
            'total_modificacion'=>$total_modificacion
        ];


       

       $ejecuciones = Ejecucione::query()
       ->when(request('search'), function($query){
        $config = Configuracione::where('nombre','institucion')->first();
        $institucion = $config->valor;
        $config = Configuracione::where('nombre','ejercicio')->first();
        $ejercicio = $config->valor;
        
           return $query->where ('clasificadorpresupuestario', 'like', '%'.request('search').'%')
                        ->where('institucion_id', 'like', $institucion)
                        ->where('ejercicio_id', 'like', $ejercicio)
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%')
                         ->orderBy('unidadejecutora', 'ASC');
                         })->where('institucion_id', 'like', $institucion)
                         ->where('ejercicio_id', 'like', $ejercicio);
        },
        function ($query) {
            $config = Configuracione::where('nombre','institucion')->first();
            $institucion = $config->valor;
            $config = Configuracione::where('nombre','ejercicio')->first();
            $ejercicio = $config->valor;
            
            $query->where('institucion_id', 'like', $institucion)
            ->where('ejercicio_id', 'like', $ejercicio)
            ->orWhereHas('unidadadministrativa', function($q){
                $q->orderBy('unidadejecutora', 'ASC');
                })->where('institucion_id', 'like', $institucion)
                ->where('ejercicio_id', 'like', $ejercicio) ;
        })
        
       ->paginate(25)
       ->withQueryString();




        return view('ejecucione.index', compact('ejecuciones', 'datos'))
            ->with('i', (request()->input('page', 1) - 1) * $ejecuciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ejecucione = new Ejecucione();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $unidadadministrativa = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
        $institucion = Institucione::pluck('institucion' , 'id');
        $meta = Meta::pluck('meta' , 'id'); 
        $financiamiento = Financiamiento::pluck('nombre', 'id'); 
        $poa = Poa::pluck('proyecto', 'id');

        return view('ejecucione.create', compact('institucion','ejecucione' , 'ejercicio' , 'unidadadministrativa' , 'meta' , 'financiamiento' , 'poa'));
    }

    public function create_formular()
    {
        $ejecucione = new Ejecucione();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $unidadadministrativa = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
        $institucion = Institucione::pluck('institucion' , 'id');
        $meta = Meta::pluck('meta' , 'id'); 
        $financiamiento = Financiamiento::pluck('nombre', 'id'); 
        $poa = Poa::pluck('proyecto', 'id');

        return view('ejecucione.create_formular', compact('institucion','ejecucione' , 'ejercicio' , 'unidadadministrativa' , 'meta' , 'financiamiento' , 'poa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ejecucione::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $ejecucione = Ejecucione::create($request->all());

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución creada con éxito');
    }

    public function store_formular(Request $request)
    {
        request()->validate(Ejecucione::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $ejecucione = Ejecucione::create($request->all());

        return redirect()->route('ejecuciones.formular')
            ->with('success', 'Ejecución creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejecucione = Ejecucione::find($id);

        $detallescompromisos = Detallescompromiso::where('ejecucion_id', $id)->paginate();
        $detalleordenpagos = Detalleordenpago::where('ejecucion_id', $id)->paginate();
        $detallepagados = Detallepagado::where('ejecucion_id', $id)->paginate();
        $detallesmodificaciones = Detallesmodificacione::where('ejecucion_id', $id)->paginate();

        return view('ejecucione.show', compact('detallescompromisos', 'ejecucione', 'detalleordenpagos', 'detallepagados', 'detallesmodificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallescompromisos->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ejecucione = Ejecucione::find($id);
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $unidadadministrativa=Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
        $institucion = Institucione::pluck('institucion' , 'id');
        $meta = Meta::pluck('meta' , 'id'); 
        $financiamiento = Financiamiento::pluck('nombre', 'id'); 
        $poa = Poa::pluck('proyecto', 'id');

        return view('ejecucione.edit', compact('institucion','ejecucione' , 'ejercicio' , 'unidadadministrativa' , 'meta' , 'financiamiento' , 'poa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ejecucione $ejecucione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejecucione $ejecucione)
    {
        request()->validate(Ejecucione::$rules);

        $ejecucione->update($request->all());

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución actualizada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ejecucione = Ejecucione::find($id)->delete();

        return redirect()->route('ejecuciones.index')
            ->with('success', 'Ejecución eliminada con éxito');
    }

    /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
      
        $ejecuciones = Ejecucione::orderBy('unidadadministrativa_id', 'asc')->get();


        $pdf = PDF::loadView('ejecucione.pdf', ['ejecuciones'=>$ejecuciones]);
        return $pdf->stream();
 
    }

    public function formular()
    {

        $config = Configuracione::where('nombre','institucion_formular')->first();
        $institucion = $config->valor;
        

        $total_presupuestario = DB::table('ejecuciones')->sum('monto_inicial');
        $total_ajustado = DB::table('ejecuciones')->sum('monto_actualizado');
        $total_modificacion = $total_ajustado - $total_presupuestario;
        $total_comprometido = DB::table('ejecuciones')->sum('monto_comprometido');
        $total_causado = DB::table('ejecuciones')->sum('monto_causado');
        $total_pagado = DB::table('ejecuciones')->sum('monto_pagado');
        $total_disponible = $total_presupuestario - $total_comprometido;
     
        if($total_presupuestario != 0){
        $porc_comprometido = ( $total_comprometido * 100 ) / $total_presupuestario;
        $porc_causado = ( $total_causado * 100 ) / $total_presupuestario;
        $porc_pagado = ( $total_pagado * 100 ) / $total_presupuestario;
        $porc_disponible = ( $total_disponible * 100 ) / $total_presupuestario;
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
            'total_modificacion'=>$total_modificacion
        ];


       

       $ejecuciones = Ejecucione::query()
       ->when(request('search'), function($query){
        $config = Configuracione::where('nombre','institucion_formular')->first();
        $institucion = $config->valor;
        $config = Configuracione::where('nombre','ejercicio_formular')->first();
        $ejercicio = $config->valor;
        
           return $query->where ('clasificadorpresupuestario', 'like', '%'.request('search').'%')
                        ->where('institucion_id', 'like', $institucion)
                        ->where('ejercicio_id', 'like', $ejercicio)
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%')
                         ->orderBy('unidadejecutora', 'ASC');
                         })->where('institucion_id', 'like', $institucion)
                         ->where('ejercicio_id', 'like', $ejercicio);
        },
        function ($query) {
            $config = Configuracione::where('nombre','institucion_formular')->first();
            $institucion = $config->valor;
            $config = Configuracione::where('nombre','ejercicio_formular')->first();
            $ejercicio = $config->valor;
            
            $query->where('institucion_id', 'like', $institucion)
            ->where('ejercicio_id', 'like', $ejercicio)
            ->orWhereHas('unidadadministrativa', function($q){
                $q->orderBy('unidadejecutora', 'ASC');
                })->where('institucion_id', 'like', $institucion)
                ->where('ejercicio_id', 'like', $ejercicio) ;
        })
        
       ->paginate(25)
       ->withQueryString();


        return view('ejecucione.index_formular', compact('ejecuciones', 'datos'))
            ->with('i', (request()->input('page', 1) - 1) * $ejecuciones->perPage());
    }



    public function reportes()
    {
       
        $ejercicios = Ejercicio::pluck('nombreejercicio','id');
        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 

        $instituciones = Institucione::orderBy('institucion', 'ASC')->pluck('institucion','id');
       

        $usuarios = User::pluck('name', 'id'); 

        $clasificadores = Clasificadorpresupuestario::orderBy('cuenta', 'ASC')->pluck('cuenta', 'cuenta'); 
      

        return view('ejecucione.reportes', compact('instituciones','usuarios','unidades','ejercicios', 'clasificadores'));

            
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $unidadAdministrativa = $request->unidadadministrativa_id;
        $institucion = $request->institucion_id;
        $ejercicio = $request->ejercicio_id;
        
        $usuario = $request->usuario_id;

        $clasificador = $request->clasificador;
        
        $nombre_usuario = '';
        $rs_usuario = User::find($usuario);
        if($rs_usuario){
            $nombre_usuario = $rs_usuario->name;
        }

        $nombre_unidad = '';
        $rs_unidad= Unidadadministrativa::find($unidadAdministrativa);
        if($rs_unidad){
            $nombre_unidad = $rs_unidad->unidadejecutora;
        }

        $nombre_institucion = '';
        $rs_institucion= Institucione::find($institucion);
        if($rs_institucion){
            $nombre_institucion = $rs_institucion->institucion;
        }

        $nombre_ejercicio = '';
        $rs_ejercicio = Ejercicio::find($ejercicio);
        if($rs_ejercicio){
            $nombre_ejercicio = $rs_ejercicio->ejercicioejecucion;
        }

        //
        $ejecuciones = Ejecucione::instituciones($institucion)->ejercicios($ejercicio)->clasificadores($clasificador)->unidad($unidadAdministrativa)->usuarios($usuario)->get();
        $monto_inicial = $ejecuciones->sum('monto_inicial');
        $monto_ajustado = $ejecuciones->sum('monto_actualizado');
        $monto_modificacion = $monto_ajustado - $monto_inicial;
        $compromiso = $ejecuciones->sum('monto_comprometido');
        $causado = $ejecuciones->sum('monto_causado');
        $pagado = $ejecuciones->sum('monto_pagado');
        $disponibilidad = $ejecuciones->sum('monto_por_comprometer');
        $datos = [
            'usuario' =>$nombre_usuario,  
            'unidad' => $nombre_unidad,
            'ejercicio' => $nombre_ejercicio,
            'clasificador' => $clasificador,
            'inicial' => $monto_inicial,
            'ajustado' => $monto_ajustado,
            'modificado' => $monto_modificacion,
            'compromiso' => $compromiso,
            'causado' => $causado,
            'pagado' => $pagado,
            'disponibilidad' => $disponibilidad,
            'institucion' => $nombre_institucion,
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('ejecucione.reportepdf', ['datos'=>$datos, 'ejecuciones'=>$ejecuciones]);
        return $pdf->stream();
         
    }
}
