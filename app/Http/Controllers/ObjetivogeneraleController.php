<?php

namespace App\Http\Controllers;

use App\Objetivogenerale;
use App\Objetivosestrategico;

use Illuminate\Http\Request;
use PDF;

/**
 * Class ObjetivogeneraleController
 * @package App\Http\Controllers
 */
class ObjetivogeneraleController extends Controller
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
         $objetivogenerales = Objetivogenerale::query()
        ->when(request('search'), function($query) {
            return $query->where ('objetivo', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('objetivogenerale.index', compact('objetivogenerales'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivogenerales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivogenerale = new Objetivogenerale();
        $objetivosestrategico = Objetivosestrategico::pluck('objetivo', 'id'); 
        return view('objetivogenerale.create', compact('objetivogenerale', 'objetivosestrategico'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivogenerale::$rules);

        $objetivogenerale = Objetivogenerale::create($request->all());

        return redirect()->route('objetivogenerales.index')
            ->with('success', 'Objetivogenerale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivogenerale = Objetivogenerale::find($id);

        return view('objetivogenerale.show', compact('objetivogenerale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivogenerale = Objetivogenerale::find($id);
        $objetivosestrategico = Objetivosestrategico::pluck('objetivo', 'id'); 

        return view('objetivogenerale.edit', compact('objetivogenerale', 'objetivosestrategico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivogenerale $objetivogenerale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivogenerale $objetivogenerale)
    {
        request()->validate(Objetivogenerale::$rules);

        $objetivogenerale->update($request->all());

        return redirect()->route('objetivogenerales.index')
            ->with('success', 'Objetivogenerale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivogenerale = Objetivogenerale::find($id)->delete();

        return redirect()->route('objetivogenerales.index')
            ->with('success', 'Objetivogenerale deleted successfully');
    }

    public function reportes()
    {
        $estrategicos = Objetivosestrategico::orderBy('objetivo', 'ASC')->pluck('objetivo', 'id');
        return view('objetivogenerale.reportes', compact('estrategicos'));   
    }

    public function reporte_pdf(Request $request)
    {
        $objetivo = $request->objetivo;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $nacional = $request->estrategico;

        $nombre_nacional = '';
        $rs_nacional = Objetivosestrategico::find($nacional);
        if($rs_nacional){
            $nombre_nacional = $rs_nacional->objetivo;
        }
        
        //
        $objetivogenerales = Objetivogenerale::estrategicos($nacional)->objetivos($objetivo)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($objetivogenerales);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'objetivo' => $objetivo,
            'nacional' => $nombre_nacional,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('objetivogenerale.reportepdf', ['datos'=>$datos, 'objetivogenerales'=>$objetivogenerales]);
        return $pdf->stream();
    }
}
