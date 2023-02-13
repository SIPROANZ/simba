<?php

namespace App\Http\Controllers;

use App\Modificacione;
use App\Tipomodificacione;
use App\Detallesmodificacione;
use App\Ejecucione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class ModificacioneController
 * @package App\Http\Controllers
 */
class ModificacioneController extends Controller
{
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

        //Obtener todos los detalles de las modificaciones
        $detallesmodificaciones = Detallesmodificacione::where('modificacion_id', $id)->get();
        if($detallesmodificaciones->count()>0){

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


        $modificacion->status = 'PR'; //colocar al finalizar las pruebas en PR
        $modificacion->save();

        if($aprobado == 1){
            return redirect()->route('modificaciones.index')
            ->with('success', 'Modificacion Aprobada Exitosamente. ');
        }else{
            return redirect()->route('modificaciones.index')
            ->with('success', 'No Aprobado. No se ha podido hacer el ajuste');
        }

    }else {
        return redirect()->route('modificaciones.index')
            ->with('success', 'No Aprobado. No tiene ningun detalle agregado a este credito');
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
            $ejecucion->derement('monto_aumento', $montoacredita);
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
}
