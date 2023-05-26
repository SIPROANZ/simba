<?php

namespace App\Http\Controllers;

use App\Clase;
use App\Familia;
use Illuminate\Http\Request;
use PDF;

/**
 * Class ClaseController
 * @package App\Http\Controllers
 */
class ClaseController extends Controller
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
        //$clases = Clase::paginate();

        $clases = Clase::query()
        ->when(request('search'), function($query){
            return $query->where ('nombre', 'like', '%'.request('search').'%')
                         ->orWhereHas('familia', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })->orderBy('nombre', 'ASC');
         },
         function ($query) {
             $query->orderBy('nombre', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('clase.index', compact('clases'))
            ->with('i', (request()->input('page', 1) - 1) * $clases->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clase = new Clase();
      $familia = Familia::pluck('nombre', 'id'); 
      return view('clase.create', compact('clase' , 'familia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Clase::$rules);

        $clase = Clase::create($request->all());

        return redirect()->route('clases.index')
            ->with('success', 'Clase creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clase = Clase::find($id);

        return view('clase.show', compact('clase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clase = Clase::find($id);
        $familia = Familia::pluck('nombre', 'id'); 

        return view('clase.edit', compact('clase', 'familia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Clase $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        request()->validate(Clase::$rules);

        $clase->update($request->all());

        return redirect()->route('clases.index')
            ->with('success', 'Clase actualizada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clase = Clase::find($id)->delete();

        return redirect()->route('clases.index')
            ->with('success', 'Clase eliminada con éxito');
    }

    public function reportes()
    {
        $familias = Familia::pluck('nombre','id');

        return view('clase.reportes', compact('familias'));
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $descripcion = $request->descripcion;
        $familia = $request->familia;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        $nombre_familia = '';
        $rs_familia = Familia::find($familia);
        if($rs_familia){
            $nombre_familia = $rs_familia->nombre;
        }

        $clases = Clase::descripcion($descripcion)->familias($familia)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total = count($clases);
        
        $datos = [
            'familia' => $nombre_familia,
            'total' => $total, 
            'inicio' => $inicio,
            'fin' => $fin,   
            'descripcion' =>$descripcion,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('clase.reportepdf', ['datos'=>$datos, 'clases'=>$clases]);
        return $pdf->stream();
         
    }
}
