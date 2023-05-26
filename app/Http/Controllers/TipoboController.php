<?php

namespace App\Http\Controllers;

use App\Tipobo;
use Illuminate\Http\Request;

use PDF;

/**
 * Class TipoboController
 * @package App\Http\Controllers
 */
class TipoboController extends Controller
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
       // $tipobos = Tipobo::paginate();

        $tipobos = Tipobo::query()
       ->when(request('search'), function($query){
           return $query->where ('nombre', 'like', '%'.request('search').'%')
                        ->orderBy('nombre', 'ASC');
        },
        function ($query) {
            $query->orderBy('nombre', 'ASC');
        })
       ->paginate(10)
       ->withQueryString();

        return view('tipobo.index', compact('tipobos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipobos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipobo = new Tipobo();
        return view('tipobo.create', compact('tipobo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipobo::$rules);

        $tipobo = Tipobo::create($request->all());

        return redirect()->route('tipobos.index')
            ->with('success', 'Tipo BOS creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipobo = Tipobo::find($id);

        return view('tipobo.show', compact('tipobo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipobo = Tipobo::find($id);

        return view('tipobo.edit', compact('tipobo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipobo $tipobo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipobo $tipobo)
    {
        request()->validate(Tipobo::$rules);

        $tipobo->update($request->all());

        return redirect()->route('tipobos.index')
            ->with('success', 'Tipo BOS actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipobo = Tipobo::find($id)->delete();

        return redirect()->route('tipobos.index')
            ->with('success', 'Tipo BOS eliminado exitosamente');
    }

    public function reportes()
    {

        return view('tipobo.reportes');
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $descripcion = $request->descripcion;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
       

        //
        
        $tipobos = Tipobo::descripcion($descripcion)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total = count($tipobos);
       

        $datos = [
            'total' => $total, 
            'inicio' => $inicio,
            'fin' => $fin,   
            'descripcion' =>$descripcion,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('tipobo.reportepdf', ['datos'=>$datos, 'tipobos'=>$tipobos]);
        return $pdf->stream();
         
    }
}
