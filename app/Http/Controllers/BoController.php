<?php

namespace App\Http\Controllers;

use App\Bo;
use App\Producto;
use App\Productoscp;
use App\Unidadmedida;
use App\Detallesrequisicione;
use App\Tipobo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;


use Illuminate\Support\Facades\Auth;

/**
 * Class BoController
 * @package App\Http\Controllers
 */
class BoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.bos')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$bos = Bo::paginate();
        $bos = Bo::query()
       ->when(request('search'), function($query){
           return $query->where ('descripcion', 'like', '%'.request('search').'%')
                        ->orWhereHas('tipobo', function($q){
                         $q->where('nombre', 'like', '%'.request('search').'%');
                         })
                          ->orWhereHas('productos', function($qa){
                            $qa->where('codigoproducto', 'like', '%'.request('search').'%')
                                ->orWhere('nombre', 'like', '%'.request('search').'%')
                                ->orderBy('nombre', 'ASC');
                        })->orderBy('descripcion', 'ASC');
        },
        function ($query) {
            $query->orderBy('descripcion', 'ASC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('bo.index', compact('bos'))
            ->with('i', (request()->input('page', 1) - 1) * $bos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bo = new Bo();

        $producto = DB::table('productos')
        ->join('productoscps', 'productos.id', '=', 'productoscps.producto_id')
        ->select('productos.nombre','productos.id')
        ->orderBy('productos.nombre', 'ASC')
        ->get();

        $productoscp = $producto->pluck('nombre', 'id');

        /* $productoscp = Productoscp::all();
        $array = json_decode(json_encode($productoscp));
        return $array[0]->producto_id->producto;
        $producto = Producto::find($productoscp->producto_id); */

        //$productoscp = Productoscp::pluck('id');
 /*        $search = Producto::where("nombre",$productoscp)->productoscp;
        return $search; */
        //$productoscp = Productoscp::pluck('id');
        $unidadmedida = Unidadmedida::pluck('nombre', 'id');
        $tipobo = Tipobo::pluck('nombre', 'id');
        return view('bo.create', compact('bo', 'productoscp', 'unidadmedida', 'tipobo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Bo::$rules);

        $bo = Bo::create($request->all());

        return redirect()->route('bos.index')
            ->with('success', 'BOS creada con Exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bo = Bo::find($id);

        return view('bo.show', compact('bo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bo = Bo::find($id);
        $productoscp = Productoscp::pluck('id');
        $unidadmedida = Unidadmedida::pluck('nombre', 'id');
        $tipobo = Tipobo::pluck('nombre', 'id');
        return view('bo.edit', compact('bo', 'productoscp', 'unidadmedida', 'tipobo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bo $bo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bo $bo)
    {
        request()->validate(Bo::$rules);

        $bo->update($request->all());

        return redirect()->route('bos.index')
            ->with('success', 'BOS modificada con Exito.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        //Validar que no este ese bos relacionado en el sistema
        if(Detallesrequisicione::where('bos_id',$id)->exists()){
           

            return redirect()->route('bos.index')
                ->with('success', 'El siguiente BOS no se puede eliminar, ya que se encuentra asignado a una requisicion.');
        }else{
            $bo = Bo::find($id)->delete();

            return redirect()->route('bos.index')
                ->with('success', 'BOS eliminada con Exito');
        }

    }


    public function reportes()
    {
       
        $tipos = Tipobo::pluck('nombre','id');
        $unidades = Unidadmedida::pluck('nombre','id');

        return view('bo.reportes', compact('tipos','unidades'));
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $descripcion = $request->descripcion;
        $tipo = $request->tipo;
        $unidad = $request->unidad;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        $nombre_tipo = '';
        $rs_tipo = Tipobo::find($tipo);
        if($rs_tipo){
            $nombre_tipo = $rs_tipo->nombre;
        }

        $nombre_unidad = '';
        $rs_unidad= Unidadmedida::find($unidad);
        if($rs_unidad){
            $nombre_unidad = $rs_unidad->nombre;
        }

        //
        
        $bos = Bo::descripcion($descripcion)->tipo($tipo)->unidad($unidad)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total = count($bos);
        $bienes = Bo::where('tipobos_id', 1)->descripcion($descripcion)->tipo($tipo)->unidad($unidad)->fechaInicio($inicio)->fechaFin($fin)->count();
        $obras = Bo::where('tipobos_id', 2)->descripcion($descripcion)->tipo($tipo)->unidad($unidad)->fechaInicio($inicio)->fechaFin($fin)->count();
        $servicios = Bo::where('tipobos_id', 3)->descripcion($descripcion)->tipo($tipo)->unidad($unidad)->fechaInicio($inicio)->fechaFin($fin)->count();


        $datos = [
            'bienes' => $bienes,
            'obras' => $obras,
            'servicios' => $servicios,
           
            'total' => $total, 
            'inicio' => $inicio,
            'fin' => $fin,   
            'descripcion' =>$descripcion,  
            'tipo' => $nombre_tipo,
            'unidad' => $nombre_unidad,
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('bo.reportepdf', ['datos'=>$datos, 'bos'=>$bos]);
        return $pdf->stream();
         
    }
}
