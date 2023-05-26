<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;

use PDF;

/**
 * Class EstadoController
 * @package App\Http\Controllers
 */
class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.instituciones')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$estados = Estado::paginate();

        $estados = Estado::query()
        ->when(request('search'), function($query) {
            return $query->where ('nombre', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('estado.index', compact('estados'))
            ->with('i', (request()->input('page', 1) - 1) * $estados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estado = new Estado();
        return view('estado.create', compact('estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Estado::$rules);

        $estado = Estado::create($request->all());

        return redirect()->route('estados.index')
            ->with('success', 'Estado creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estado = Estado::find($id);

        return view('estado.show', compact('estado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estado = Estado::find($id);

        return view('estado.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Estado $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        request()->validate(Estado::$rules);

        $estado->update($request->all());

        return redirect()->route('estados.index')
            ->with('success', 'Estado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $estado = Estado::find($id)->delete();

        return redirect()->route('estados.index')
            ->with('success', 'Estado deleted successfully');
    }

    public function reportes()
    {
        return view('estado.reportes');   
    }

    public function reporte_pdf(Request $request)
    {
        $estado = $request->estado;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        //
        $estados = Estado::estados($estado)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($estados);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'estado' => $estado,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('estado.reportepdf', ['datos'=>$datos, 'estados'=>$estados]);
        return $pdf->stream();
    }
}
