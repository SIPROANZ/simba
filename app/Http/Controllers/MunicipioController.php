<?php

namespace App\Http\Controllers;

use App\Municipio;
use App\Estado;
use Illuminate\Http\Request;
use PDF;

/**
 * Class MunicipioController
 * @package App\Http\Controllers
 */
class MunicipioController extends Controller
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
       // $municipios = Municipio::paginate();

        $municipios = Municipio::query()
        ->when(request('search'), function($query) {
            return $query->where ('nombre', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('municipio.index', compact('municipios'))
            ->with('i', (request()->input('page', 1) - 1) * $municipios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipio = new Municipio();

        $estados = Estado::pluck('nombre', 'id');

        return view('municipio.create', compact('municipio' , 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Municipio::$rules);

        $municipio = Municipio::create($request->all());

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $municipio = Municipio::find($id);

        return view('municipio.show', compact('municipio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $municipio = Municipio::find($id);

        $estados = Estado::pluck('nombre', 'id');

        return view('municipio.edit', compact('municipio' , 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipio $municipio)
    {
        request()->validate(Municipio::$rules);

        $municipio->update($request->all());

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $municipio = Municipio::find($id)->delete();

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio deleted successfully');
    }


    public function reportes()
    {
        $estados = Estado::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('municipio.reportes', compact('estados'));   
    }

    public function reporte_pdf(Request $request)
    {
        $municipio = $request->municipio;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $estado = $request->estado;

        $nombre_estado = '';
        $rs_estado = Estado::find($estado);
        if($rs_estado){
            $nombre_estado = $rs_estado->nombre;
        }
        
        //
        $municipios = Municipio::estados($estado)->municipios($municipio)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($municipios);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'municipio' => $municipio,
            'estado' => $nombre_estado,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('municipio.reportepdf', ['datos'=>$datos, 'municipios'=>$municipios]);
        return $pdf->stream();
    }

}
