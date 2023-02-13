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
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;


/**
 * Class EjecucioneController
 * @package App\Http\Controllers
 */
class EjecucioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $total_presupuestario = DB::table('ejecuciones')->sum('monto_inicial');
        $total_ajustado = DB::table('ejecuciones')->sum('monto_actualizado');
        $total_modificacion = $total_ajustado - $total_presupuestario;
        $total_comprometido = DB::table('ejecuciones')->sum('monto_comprometido');
        $total_causado = DB::table('ejecuciones')->sum('monto_causado');
        $total_pagado = DB::table('ejecuciones')->sum('monto_pagado');
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


        //Methodo para buscar
       // $ejecuciones = Ejecucione::orderBy('unidadadministrativa_id', 'asc')->paginate();
     /*  $ejecuciones = Ejecucione::query()
                        ->when(request('search'), function($query){
                            return $query->where ('clasificadorpresupuestario', 'like', '%'.request('search').'%');
                            //aqui se puede colocar otro orWhere para otra consulta a la misma tabla pero en otro campo
                            //->orWhere ('monto_inicial', 'like', '%'.request('search').'%');
                        })
                        ->orWhereHas('unidadadministrativa', function($q){
                            $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                        })
                        ->paginate()
                        ->withQueryString();

*/

$ejecuciones = Ejecucione::query()
       ->when(request('search'), function($query){
           return $query->where ('clasificadorpresupuestario', 'like', '%'.request('search').'%')
                        ->where('institucion_id', 'like', '13')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%')
                         ->orderBy('unidadejecutora', 'ASC');
                         })->where('institucion_id', 'like', '13');
        },
        function ($query) {
            $query->where('institucion_id', 'like', '13')
            ->orWhereHas('unidadadministrativa', function($q){
                $q->orderBy('unidadejecutora', 'ASC');
                });
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
}
