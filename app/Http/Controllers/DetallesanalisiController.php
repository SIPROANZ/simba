<?php

namespace App\Http\Controllers;

use App\Detallesanalisi;
use App\Proveedore;
use App\Analisi;
use App\Detallesrequisicione;
use App\Bo;
use App\Beneficiario;
use Illuminate\Http\Request;

/**
 * Class DetallesanalisiController
 * @package App\Http\Controllers
 */
class DetallesanalisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesanalisis = Detallesanalisi::paginate();

        return view('detallesanalisi.index', compact('detallesanalisis'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesanalisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesanalisi = new Detallesanalisi();
       // $proveedores = Proveedore::pluck('nombre','id');
        $proveedores = Beneficiario::pluck('nombre','id');
        $analisis = Analisi::pluck('numeracion','id');
        $bos = Bo::pluck('descripcion', 'id');
        return view('detallesanalisi.create', compact('detallesanalisi', 'proveedores','analisis', 'bos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createwithbos($id)
    {
        $id_rs = $id; // ['id_detalle_requisicion' => $id];

        //Obtener el id del bos y la cantidad
        $det_requisicion = Detallesrequisicione::find($id_rs);
        $rs_bos_cantidad = $det_requisicion->cantidad;
        //obtener el nombre del bos
        $rs_bos_id = $det_requisicion->bos_id;
        $rs_bos = Bo::find($rs_bos_id);
        $rs_nombre_bos = $rs_bos->descripcion;


        $detallesanalisi = new Detallesanalisi();
        $proveedores = Beneficiario::pluck('nombre','id');
        $analisis = Analisi::pluck('numeracion','id');
        $bos = Bo::pluck('descripcion', 'id');
        return view('detallesanalisi.createwithbos', compact('detallesanalisi', 'proveedores','analisis', 'bos', 'rs_bos_cantidad', 'rs_bos_id', 'rs_nombre_bos'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storedos(Request $request)
    {
        request()->validate(Detallesanalisi::$rules);

        $proveedor_id = $request->proveedor_id;

        $bos_id = $request->bos_id;
        //Obtener el id de la requisicion
        $analisis_id = session('analisis_var');
        $request->merge(['analisis_id'  => $analisis_id]);

        //Obtenemos los valores del formulario cantidad y precio y calculamos el resto de los valores
        $cantidad = $request->cantidad;
        $precio = $request->precio;

        $subtotal = $cantidad * $precio;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;
        $aprobado = $request->aprobado;

        $datos_guardar = [
            'beneficiario_id' => $proveedor_id,
            'analisis_id' => $analisis_id,
            'bos_id' => $bos_id,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'aprobado' => $aprobado,

        ];


        $detallesanalisi = Detallesanalisi::create($datos_guardar);


        if(session()->has('analisis_var')){
            return redirect()->route('analisis.agregar',$analisis_id)
            ->with('success', 'Detalle Agregado Exitosamente. Desea agregar un nuevo item.');
        }else{
            return redirect()->route('analisis.index')
            ->with('success', 'No existe la variable analisis_id.');
        }

        /*return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi created successfully.');*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesanalisi::$rules);

        //Obtener el id de la requisicion
        $analisis_id = session('analisis_var');
        $request->merge(['analisis_id'  => $analisis_id]);

        //Obtenemos los valores del formulario cantidad y precio y calculamos el resto de los valores
        $cantidad = $request->cantidad;
        $precio = $request->precio;

        $subtotal = $cantidad * $precio;
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        //Ahora estos nuevo valores los agrego con merge a la variable request
        $request->merge(['subtotal'  => $subtotal]);
        $request->merge(['iva'  => $iva]);
        $request->merge(['total'  => $total]);


        $detallesanalisi = Detallesanalisi::create($request->all());


        if(session()->has('analisis_var')){
            return redirect()->route('analisis.agregar',$analisis_id)
            ->with('success', 'Detalle Agregado Exitosamente. Desea agregar un nuevo item.');
        }else{
            return redirect()->route('analisis.index')
            ->with('success', 'No existe la variable analisis_id.');
        }

        /*return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi created successfully.');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesanalisi = Detallesanalisi::find($id);

        return view('detallesanalisi.show', compact('detallesanalisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesanalisi = Detallesanalisi::find($id);
        
        $proveedores = Beneficiario::pluck('nombre','id');
        $analisis = Analisi::pluck('numeracion','id');
        $bos = Bo::pluck('descripcion', 'id');

        return view('detallesanalisi.edit', compact('detallesanalisi', 'proveedores','analisis', 'bos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesanalisi $detallesanalisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesanalisi $detallesanalisi)
    {
        request()->validate(Detallesanalisi::$rules);
 
        $request->merge(['beneficiario_id'  => $request->proveedor_id]);
        $request->merge(['proveedor_id'  => NULL]);

        $detallesanalisi->update($request->all());


        //Obtener el id de la requisicion
        $analisis_id = session('analisis_var');
        //Para recuperar el id de la requisicion solo si existe route('requisiciones.agregar',$requisicione->id)
        if(session()->has('analisis')){
           return redirect()->route('analisis.agregar',$analisis_id)
           ->with('success', 'Detalles Actualizado Exitosamente.');
       }else{
           return redirect()->route('analisis.index')
           ->with('success', 'No se consiguio la variable de sesion analisis.');
       }
            /*
        return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi updated successfully');
            */
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesanalisi = Detallesanalisi::find($id)->delete();

        


        //Obtener el id de la requisicion
        $analisis_id = session('analisis_var');
        if(session()->has('requisicion')){
            return redirect()->route('analisis.agregar',$analisis_id)
            ->with('success', 'Detalle Eliminado Exitosamente.');
        }else{
            return redirect()->route('analisis.index')
            ->with('success', 'Detalle Eliminado Exitosamente.');
        }
        /*
        return redirect()->route('detallesanalisis.index')
            ->with('success', 'Detallesanalisi deleted successfully'); 
            */
    }
}
