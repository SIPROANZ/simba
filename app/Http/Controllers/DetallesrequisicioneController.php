<?php

namespace App\Http\Controllers;

use App\Detallesrequisicione;
use App\Requisicione;
use App\Bo;
use App\Requidetclaspre;
use App\Clasificadorpresupuestario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DetallesrequisicioneController
 * @package App\Http\Controllers
 */
class DetallesrequisicioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesrequisiciones = Detallesrequisicione::paginate();

        return view('detallesrequisicione.index', compact('detallesrequisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesrequisiciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesrequisicione = new Detallesrequisicione();

        $bos = Bo::pluck('descripcion', 'id');

        $requisiciones = Requisicione::pluck('concepto', 'id');

        $requisicion_id = session('requisicion');
        $requisicion = Requisicione::find($requisicion_id);
        $unidadadministrativa_id = $requisicion->unidadadministrativa_id;

        //Obtener el id de la unidad adminsitrativa

        //Agregar BOS qeu dependa de la unidad administrativa que esta solicitando la requisicion
        $detallesbos = DB::table('bos')
        ->join('productoscps', 'bos.producto_id', '=', 'productoscps.producto_id') 
        ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.id', '=', 'productoscps.clasificadorp_id')
        ->join('ejecuciones', 'ejecuciones.clasificadorpresupuestario', '=', 'clasificadorpresupuestarios.cuenta')
        ->where('ejecuciones.unidadadministrativa_id',$unidadadministrativa_id)
        ->select('bos.descripcion', 'bos.id')
        ->orderBy('bos.descripcion', 'ASC')
        ->pluck('bos.descripcion', 'bos.id'); 
           //Fin de agregar bos

        return view('detallesrequisicione.create', compact('detallesrequisicione', 'bos', 'requisiciones', 'detallesbos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesrequisicione::$rules);

        //Obtener el id de la requisicion
        $requisicion = session('requisicion');
        //$request->requisicion_id=$requisicion; //cambiar el valor a la variable, para q se haga en el servidor y no en el cliente
        $request->merge(['requisicion_id'  => $requisicion]);

        $detallesrequisicione = Detallesrequisicione::create($request->all());

        //Obtener el ID de la unidad administrativa a partir de la requisicion
        $unidad_administrativa_id = 0;
        $unidad = Requisicione::find($requisicion);
        $unidad_administrativa_id = $unidad->unidadadministrativa_id;
        $ejercicio_id = $unidad->ejercicio_id;
        $bos_id = $request->bos_id;
        //Obtener el id del producto mediante el modelo bos y el id del bos que viene en el request
        $producto_id = 0;
        $producto = Bo::find($bos_id);
        $producto_id = $producto->producto_id;
        //A partir del producto id obtener el id del clasificador presupuestario
        $clasificador_presupuestario = "";
        $cuenta = DB::table('productoscps')->where('producto_id', $producto_id)->first(); //first() obtiene uno solo
        $clasificador_id = $cuenta->clasificadorp_id;                                                       //get() obtiene todos los resultados
        //Antes obtuve el ID del clasificador ahora obtengo la cuenta o el clasificador presupuestario que esta 
        //asociado a este producto
        $rs_clasificador = Clasificadorpresupuestario::find($clasificador_id);
        $clasificador_presupuestario = $rs_clasificador->cuenta;

        //Buscar ejecucion a partir del id de la unidad administrativa y del clasificador presupuestario
        //que esta asociado al producto, e irlo agregando, y antes de agregar verificar que no exista en
        //dicha tabla para dicha requisicion de no existir se agrega en caso contrario no se hace nada.
        $ejecucion_id = 0;

        $ejecucion = DB::table('ejecuciones')->where('ejercicio_id', $ejercicio_id)->where('unidadadministrativa_id', $unidad_administrativa_id)->where('clasificadorpresupuestario', $clasificador_presupuestario)->first();

        $ejecucion_id = $ejecucion->id;
/*
        return redirect()->route('requisiciones.index')
            ->with('success', 'Registro Agregado Exitosamente. Ejecucion id: ' . $ejecucion_id);
*/
        $poa_id = $ejecucion->poa_id;
        $meta_id = $ejecucion->meta_id;
        $financiamiento_id = $ejecucion->financiamiento_id;
        $disponible = $ejecucion->monto_por_comprometer;

         

        //Consultar si esta registrado en la base de datos y crear un array con todos los datos obtenidos
        $req_clasificador = DB::table('requidetclaspres')->where('requisicion_id', $requisicion)->where('claspres', $clasificador_presupuestario)->get();
        
        $clasificador_array = array();
        $contador = 0;
        foreach($req_clasificador as $rows){
            $clasificador_array[]=$rows->claspres;
            $contador +=1;
        }

       //Cuando es cero es por q es el primer registro de la partida para esa requisicion
        if($contador==0){
            $array_requidetclaspre = [
                'requisicion_id'=>$requisicion,
                'poa_id'=>$poa_id,
                'meta_id'=>$meta_id,
                'financiamiento_id'=>$financiamiento_id,
                'disponible'=>$disponible, 
                'claspres' =>$clasificador_presupuestario,
                'ejecucion_id'=>$ejecucion_id
                ];
             
                 $requidetclaspre = Requidetclaspre::create($array_requidetclaspre);
        } else {  
        //validar que la cuenta no este en el array clasificador presupuestario
        if(in_array($clasificador_presupuestario, $clasificador_array)){
            //no hacer nada
         }else {
             //hacer el registro
             // $partidas[] = $clasificador;
              //Crear el array para agregar los valores en la tabla requidetclaspres
        $array_requidetclaspre = [
            'requisicion_id'=>$requisicion,
            'poa_id'=>$poa_id,
            'meta_id'=>$meta_id,
            'financiamiento_id'=>$financiamiento_id,
            'disponible'=>$disponible, 
            'claspres'=>$clasificador_presupuestario,
            'ejecucion_id'=>$ejecucion_id
         ];
         
             $requidetclaspre = Requidetclaspre::create($array_requidetclaspre); 
         }

        }

        //Para recuperar el id de la requisicion solo si existe route('requisiciones.agregar',$requisicione->id)
        if(session()->has('requisicion')){
            return redirect()->route('requisiciones.agregar',$requisicion)
            ->with('success', 'Registro Agregado Exitosamente. Desea agregar un nuevo item.');
        }else{
            return redirect()->route('requisiciones.index')
            ->with('success', 'Registro Agregado Exitosamente.');
        }

        /*
        return redirect()->route('detallesrequisiciones.index')
            ->with('success', 'Detallesrequisicione created successfully.'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesrequisicione = Detallesrequisicione::find($id);

        return view('detallesrequisicione.show', compact('detallesrequisicione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesrequisicione = Detallesrequisicione::find($id);

        $bos = Bo::pluck('descripcion', 'id');

        $requisiciones = Requisicione::pluck('concepto', 'id');

        $requisicion_id = session('requisicion');
        $requisicion = Requisicione::find($requisicion_id);
        $unidadadministrativa_id = $requisicion->unidadadministrativa_id;

         //Agregar BOS qeu dependa de la unidad administrativa que esta solicitando la requisicion
         $detallesbos = DB::table('bos')
         ->join('productoscps', 'bos.producto_id', '=', 'productoscps.producto_id') 
         ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.id', '=', 'productoscps.clasificadorp_id')
         ->join('ejecuciones', 'ejecuciones.clasificadorpresupuestario', '=', 'clasificadorpresupuestarios.cuenta')
         ->where('ejecuciones.unidadadministrativa_id',$unidadadministrativa_id)
         ->select('bos.descripcion', 'bos.id')
         ->orderBy('bos.descripcion', 'ASC')
         ->pluck('bos.descripcion', 'bos.id'); 
            //Fin de agregar bos

        return view('detallesrequisicione.edit', compact('unidadadministrativa_id', 'detallesrequisicione' , 'bos', 'requisiciones', 'detallesbos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesrequisicione $detallesrequisicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesrequisicione $detallesrequisicione)
    {
        request()->validate(Detallesrequisicione::$rules);

        $detallesrequisicione->update($request->all());

        //Obtener el id de la requisicion
         $requisicion = session('requisicion');
         //Para recuperar el id de la requisicion solo si existe route('requisiciones.agregar',$requisicione->id)
         if(session()->has('requisicion')){
            return redirect()->route('requisiciones.agregar',$requisicion)
            ->with('success', 'BOS Agregado Exitosamente. Desea agregar un nuevo item');
        }else{
            return redirect()->route('requisiciones.index')
            ->with('success', 'BOS Agregado Exitosamente.');
        }
      /*  return redirect()->route('detallesrequisiciones.index')
            ->with('success', 'Detallesrequisicione updated successfully');*/
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesrequisicione = Detallesrequisicione::find($id)->delete();
        
        //Obtener el id de la requisicion
        $requisicion = session('requisicion');
        if(session()->has('requisicion')){
            return redirect()->route('requisiciones.agregar',$requisicion)
            ->with('success', 'BOS Eliminado Exitosamente. Desea agregar un nuevo item');
        }else{
            return redirect()->route('requisiciones.index')
            ->with('success', 'BOS Eliminado Exitosamente.');
        }
       /* return redirect()->route('detallesrequisiciones.index')
            ->with('success', 'Detallesrequisicione deleted successfully');*/
    }
}
