<?php

namespace App\Http\Controllers;

use App\Familia;
use App\Segmento;
use Illuminate\Http\Request;


use App\Bo;
use App\Unidadmedida;
use PDF;


/**
 * Class FamiliaController
 * @package App\Http\Controllers
 */
class FamiliaController extends Controller
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
        //$familias = Familia::paginate();

        $familias = Familia::query()
        ->when(request('search'), function($query){
            return $query->where ('nombre', 'like', '%'.request('search').'%')
                         ->orWhereHas('segmento', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })->orderBy('nombre', 'ASC');
         },
         function ($query) {
             $query->orderBy('nombre', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('familia.index', compact('familias'))
            ->with('i', (request()->input('page', 1) - 1) * $familias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familia = new Familia();
        $segmento = Segmento::pluck('nombre', 'id');
        return view('familia.create', compact('familia', 'segmento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Familia::$rules);

        $familia = Familia::create($request->all());

        return redirect()->route('familias.index')
            ->with('success', 'Familia creada con Exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $familia = Familia::find($id);

        return view('familia.show', compact('familia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $familia = Familia::find($id);
        $segmento = Segmento::pluck('nombre', 'id');
        return view('familia.edit', compact('familia', 'segmento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Familia $familia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Familia $familia)
    {
        request()->validate(Familia::$rules);

        $familia->update($request->all());

        return redirect()->route('familias.index')
            ->with('success', 'Familia modificada con Exito.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $familia = Familia::find($id)->delete();

        return redirect()->route('familias.index')
            ->with('success', 'Familia eliminada con Exito');
    }


    public function reportes()
    {
        $segmentos = Segmento::pluck('nombre','id');

        return view('familia.reportes', compact('segmentos'));
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $descripcion = $request->descripcion;
        $segmento = $request->segmento;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        $nombre_segmento = '';
        $rs_segmento = Segmento::find($segmento);
        if($rs_segmento){
            $nombre_segmento = $rs_segmento->nombre;
        }

        $familias = Familia::descripcion($descripcion)->segmentos($segmento)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total = count($familias);
        
        $datos = [
            'segmento' => $nombre_segmento,
            'total' => $total, 
            'inicio' => $inicio,
            'fin' => $fin,   
            'descripcion' =>$descripcion,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('familia.reportepdf', ['datos'=>$datos, 'familias'=>$familias]);
        return $pdf->stream();
         
    }
}
