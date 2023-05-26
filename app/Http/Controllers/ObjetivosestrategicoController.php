<?php

namespace App\Http\Controllers;

use App\Objetivosestrategico;
use App\Objetivonacionale;
use Illuminate\Http\Request;
use PDF;

/**
 * Class ObjetivosestrategicoController
 * @package App\Http\Controllers
 */
class ObjetivosestrategicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.poa')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$objetivosestrategicos = Objetivosestrategico::paginate();

        $objetivosestrategicos = Objetivosestrategico::query()
        ->when(request('search'), function($query) {
            return $query->where ('objetivo', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('objetivosestrategico.index', compact('objetivosestrategicos'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivosestrategicos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivosestrategico = new Objetivosestrategico();

        $nacionales = Objetivonacionale::pluck('objetivo', 'id');
        return view('objetivosestrategico.create', compact('objetivosestrategico', 'nacionales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivosestrategico::$rules);

        $objetivosestrategico = Objetivosestrategico::create($request->all());

        return redirect()->route('objetivosestrategicos.index')
            ->with('success', 'Objetivo Estrategico creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivosestrategico = Objetivosestrategico::find($id);

        return view('objetivosestrategico.show', compact('objetivosestrategico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivosestrategico = Objetivosestrategico::find($id);

        $nacionales = Objetivonacionale::pluck('objetivo', 'id');

        return view('objetivosestrategico.edit', compact('objetivosestrategico', 'nacionales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivosestrategico $objetivosestrategico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivosestrategico $objetivosestrategico)
    {
        request()->validate(Objetivosestrategico::$rules);

        $objetivosestrategico->update($request->all());

        return redirect()->route('objetivosestrategicos.index')
            ->with('success', 'Objetivosestrategico updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivosestrategico = Objetivosestrategico::find($id)->delete();

        return redirect()->route('objetivosestrategicos.index')
            ->with('success', 'Objetivosestrategico deleted successfully');
    }

    public function reportes()
    {
        $nacionales = Objetivonacionale::orderBy('objetivo', 'ASC')->pluck('objetivo', 'id');
        return view('objetivosestrategico.reportes', compact('nacionales'));   
    }

    public function reporte_pdf(Request $request)
    {
        $objetivo = $request->objetivo;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $nacional = $request->nacional;

        $nombre_nacional = '';
        $rs_nacional = Objetivonacionale::find($nacional);
        if($rs_nacional){
            $nombre_nacional = $rs_nacional->objetivo;
        }
        
        //
        $objetivosestrategicos = Objetivosestrategico::nacional($nacional)->objetivos($objetivo)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($objetivosestrategicos);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'objetivo' => $objetivo,
            'nacional' => $nombre_nacional,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('objetivosestrategico.reportepdf', ['datos'=>$datos, 'objetivosestrategicos'=>$objetivosestrategicos]);
        return $pdf->stream();
    }
}
