<?php

namespace App\Http\Controllers;

use App\Detallesayuda;
use App\Ayudassociale;
use App\Unidadadministrativa;
use App\Ejecucione;
use App\Financiamiento;
use Illuminate\Http\Request;

/**
 * Class DetallesayudaController
 * @package App\Http\Controllers
 */
class DetallesayudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesayudas = Detallesayuda::paginate();

        return view('detallesayuda.index', compact('detallesayudas'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesayudas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesayuda = new Detallesayuda();
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $ejecuciones = Ejecucione::pluck('clasificadorpresupuestario', 'id');

        $unidades = Unidadadministrativa::all();
        $financiamientos = Financiamiento::all();

        return view('detallesayuda.create', compact('financiamientos','unidades', 'detallesayuda', 'unidadadministrativas', 'ejecuciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesayuda::$rules);

         //Obtener el id de la requisicion
         $ayuda_id = session('ayudas');
         //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
         $request->merge(['ayuda_id'  => $ayuda_id]);

        $detallesayuda = Detallesayuda::create($request->all());

        //Obtener la suma de todos los detalles ayuda paara sumarlo en la tabla principal detalles ayuda
        $ayuda = Ayudassociale::find($ayuda_id);

        $detallesayuda = Detallesayuda::where('ayuda_id', $ayuda_id)->get();
        $suma = $detallesayuda->sum('montocompromiso');
        $ayuda->montototal = $suma;
        $ayuda->save();


          /*
        return redirect()->route('detallesayudas.index')
            ->with('success', 'Detallesayuda created successfully.');
               */
            if(session()->has('ayudas')){
                return redirect()->route('ayudassociales.agregar',$ayuda_id)
                ->with('success', 'Registro agregado satisfactoriamente.');
            }else{
                return redirect()->route('ayudassociales.index')
                ->with('success', 'Registro Actualizado Exitosamente.');
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
        $detallesayuda = Detallesayuda::find($id);

        return view('detallesayuda.show', compact('detallesayuda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesayuda = Detallesayuda::find($id);
        $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $ejecuciones = Ejecucione::pluck('clasificadorpresupuestario', 'id');

        $unidades = Unidadadministrativa::all();
        $financiamientos = Financiamiento::all();

        return view('detallesayuda.edit', compact('financiamientos', 'unidades', 'detallesayuda', 'unidadadministrativas', 'ejecuciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesayuda $detallesayuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesayuda $detallesayuda)
    {
        request()->validate(Detallesayuda::$rules);
        
        $ayuda_id = session('ayudas');
         //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
         $request->merge(['ayuda_id'  => $ayuda_id]);

        $detallesayuda->update($request->all());
           /*
        return redirect()->route('detallesayudas.index')
            ->with('success', 'Detallesayuda updated successfully');
             */

        //Obtener la suma de todos los detalles ayuda paara sumarlo en la tabla principal detalles ayuda
        $ayuda = Ayudassociale::find($ayuda_id);

        $detallesayuda = Detallesayuda::where('ayuda_id', $ayuda_id)->get();
        $suma = $detallesayuda->sum('montocompromiso');
        $ayuda->montototal = $suma;
        $ayuda->save();
            
         //Para recuperar el id de la requisicion solo si existe route('requisiciones.agregar',$requisicione->id)
         if(session()->has('ayudas')){
            return redirect()->route('ayudassociales.agregar',$ayuda_id)
            ->with('success', 'Ayuda Editada satisfactoriamente.');
        }else{
            return redirect()->route('ayudassociales.index')
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
       // $detallesayuda = Detallesayuda::find($id)->delete();


       $detallesayuda = Detallesayuda::find($id);
       $ayuda_id = $detallesayuda->ayuda_id;
       $monto_decremento =  $detallesayuda->montocompromiso;

       //Buscar el precompromiso para luego decremententar el monto del detalle
       $ayuda = Ayudassociale::find($ayuda_id);
       $ayuda->decrement('montototal', $monto_decremento);

       //y Ahora si procedo a eliminar el detalle precompromiso una vez restado el monto del compromiso
       $detallesayuda->delete();


       /* return redirect()->route('detallesayudas.index')
            ->with('success', 'Detallesayuda deleted successfully');
*/      $ayuda_id = session('ayudas');
            if(session()->has('ayudas')){
                return redirect()->route('ayudassociales.agregar',$ayuda_id)
                ->with('success', 'Registro agregado satisfactoriamente.');
            }else{
                return redirect()->route('ayudassociales.index')
                ->with('success', 'Registro Actualizado Exitosamente.');
            }
    }

      //para llenar un select dinamico
      public function ejecucion(Request $request){
        if(isset($request->texto)){
            $ejecuc = Ejecucione::where('unidadadministrativa_id', $request->texto)
            ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.cuenta', '=','ejecuciones.clasificadorpresupuestario')
            ->select('clasificadorpresupuestarios.denominacion', 'ejecuciones.clasificadorpresupuestario', 'ejecuciones.id')
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
