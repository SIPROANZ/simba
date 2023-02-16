<?php

namespace App\Http\Controllers;

use App\Detallesprecompromiso;
use App\Precompromiso;
use App\Unidadadministrativa;
use App\Ejecucione;
use App\Financiamiento;
use Illuminate\Http\Request;

/**
 * Class DetallesprecompromisoController
 * @package App\Http\Controllers
 */
class DetallesprecompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesprecompromisos = Detallesprecompromiso::paginate();

        return view('detallesprecompromiso.index', compact('detallesprecompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesprecompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesprecompromiso = new Detallesprecompromiso();
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $precompromisos = Precompromiso::pluck('concepto', 'id');
        $ejecuciones = Ejecucione::pluck('clasificadorpresupuestario', 'id');
        $unidades = Unidadadministrativa::all();
        $financiamientos = Financiamiento::all();

        return view('detallesprecompromiso.create', compact('financiamientos', 'unidades', 'detallesprecompromiso', 'unidadadministrativas', 'precompromisos', 'ejecuciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesprecompromiso::$rules);
        
        //Obtener el id de la requisicion
        $precompromiso_id = session('precompromisos');


        //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
        $request->merge(['precompromiso_id'  => $precompromiso_id]);


        //Validar que el id del precompromiso no tenga una relacion con el id de ejecucion en ese caso ya esta registrado la relacion
        $validar_repetido = Detallesprecompromiso::where('precompromiso_id', $request->precompromiso_id)
                                                    ->where('ejecucion_id', $request->ejecucion_id)
                                                    ->where('financiamiento', $request->financiamiento)
                                                    ->first();
        $mensaje="";
        if($validar_repetido!=NULL)
        {
            $mensaje="El registro que esta intentando agregar ya se encuentra registrado en el precompromiso";
            return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Error: ' . $mensaje);
        }else{

            //Validar que el monto a agregar mas la suma de los agregados no sea mayor al monto del precompromiso
            $monto_formulario = $request->montocompromiso;
            $detallesprecompromiso = Detallesprecompromiso::where('precompromiso_id', $precompromiso_id)->get();
            $suma = $detallesprecompromiso->sum('montocompromiso');
            $total_precompromiso = $suma + $monto_formulario;

            //Validar que el monto no sea mayor al monto que se quiere precomprometer
            $precompromiso = Precompromiso::find($precompromiso_id);

            if($total_precompromiso > $precompromiso->montototal)
            {
                //Error esta queriendo precomprometer mas de la cuenta
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Error el monto que intenta precomprometer '. $total_precompromiso .' es mayor al monto establecido '.$precompromiso->montototal.', o ya ha superado el limite. ' . $mensaje);
            } else {
                //Se procede a precomprometer
                $detallesprecompromiso = Detallesprecompromiso::create($request->all());

                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro agregado con exito. ' . $mensaje);
            }



        }

        

      /*  return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso created successfully.');

*/
            

/*
            if(session()->has('precompromisos')){
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro agregado. ' . $mensaje);
            }else{
                return redirect()->route('precompromisos.index')
                ->with('success', 'Registro Agregado Exitosamente. ' . $mensaje);
            } */
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesprecompromiso = Detallesprecompromiso::find($id);

        return view('detallesprecompromiso.show', compact('detallesprecompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesprecompromiso = Detallesprecompromiso::find($id);
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $precompromisos = Precompromiso::pluck('concepto', 'id');
        $ejecuciones = Ejecucione::pluck ('clasificadorpresupuestario', 'id');
        $unidades = Unidadadministrativa::all();
        $financiamientos = Financiamiento::all();

        return view('detallesprecompromiso.edit', compact('financiamientos','unidades','detallesprecompromiso', 'unidadadministrativas', 'precompromisos', 'ejecuciones' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesprecompromiso $detallesprecompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesprecompromiso $detallesprecompromiso)
    {
        request()->validate(Detallesprecompromiso::$rules);
        //Obtener el id de la requisicion
        $precompromiso_id = session('precompromisos');
        //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
        $request->merge(['precompromiso_id'  => $precompromiso_id]);
        $detallesprecompromiso->update($request->all());
             /*
        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso updated successfully');
              */
           
              //Agregar el total a la tabla principal
            $precompromiso = Precompromiso::find($precompromiso_id);

            $detallesprecompromiso = Detallesprecompromiso::where('precompromiso_id', $precompromiso_id)->get();
            $suma = $detallesprecompromiso->sum('montocompromiso');
            $precompromiso->montototal = $suma;
            $precompromiso->save();
              
            if(session()->has('precompromisos')){
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro agregado satisfactoriamente.');
            }else{
                return redirect()->route('precompromisos.index')
                ->with('success', 'Registro Actualizado Exitosamente.');
            }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
       // $detallesprecompromiso = Detallesprecompromiso::find($id)->delete();
       $detallesprecompromiso = Detallesprecompromiso::find($id);
       $precompromiso_id = $detallesprecompromiso->precompromiso_id;
       $monto_decremento =  $detallesprecompromiso->montocompromiso;

       //Buscar el precompromiso para luego decremententar el monto del detalle
       $precompromiso = Precompromiso::find($precompromiso_id);
       $precompromiso->decrement('montototal', $monto_decremento);

       //y Ahora si procedo a eliminar el detalle precompromiso una vez restado el monto del compromiso
       $detallesprecompromiso->delete();




           /*
        return redirect()->route('detallesprecompromisos.index')
            ->with('success', 'Detallesprecompromiso deleted successfully');
            */
            $precompromiso_id = session('precompromisos');
            if(session()->has('precompromisos')){
                return redirect()->route('precompromisos.agregar',$precompromiso_id)
                ->with('success', 'Registro eliminado satisfactoriamente.');
            }else{
                return redirect()->route('precompromisos.index')
                ->with('success', 'Registro Eliminado Exitosamente.');
            }
    }

    //para llenar un select dinamico
    public function ejecucionpre(Request $request){
        if(isset($request->texto)){
            $ejecuc = Ejecucione::where('unidadadministrativa_id', $request->texto)
            ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.cuenta', '=','ejecuciones.clasificadorpresupuestario')
            ->select('clasificadorpresupuestarios.denominacion', 'ejecuciones.clasificadorpresupuestario', 'ejecuciones.id')
            ->orderBy('ejecuciones.clasificadorpresupuestario', 'ASC')
            ->get();
            return response()->json(
                [
                    'lista' => $ejecuc,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }
}
